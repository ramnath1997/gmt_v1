<html><head><title>View Mark Portal</title></head><body>
  <script type="text/javascript" src="./js/format+en,default+en,ui+en,browserchart+en,columnchart+en_US.I.js"></script>
  <script type="text/javascript">

    window.ready=dfunction;

       function dfunction() {

    //getting data from our table
    var data_type = 'data:application/vnd.ms-excel';
    var table_div = document.getElementById('table_wrapper');
    var table_html = table_div.outerHTML.replace(/ /g, '%20');

    var a = document.createElement('a');
    a.href = data_type + ', ' + table_html;
    a.download = 'exported_table_' + Math.floor((Math.random() * 9999999) + 1000000) + '.xls';
    a.click();
  
};
    </script>
<?php
  session_start();
  if (!isset($_SESSION['staff_id']) || $_SESSION['staff_id']=="0") {
    echo "Page Not Found :(<br>";
    include("./logout.php");
    echo "<a href='./logout.php'>Back to Home</a>";
    exit();
  }if (!isset($_SESSION['st_code'])) {
    echo "Class Not Selected :(<br>";
    echo "<a href='./princi_det_index.php'>Back to Select</a>";
    exit();
  }
  if (!isset($_SESSION['gmt_no'])) {
    echo "GMT No. is not Entered :(<br>";
    echo "<a href='princi_det_index.php'>Back to Previous Page</a>";
    exit();
  }
  if (!isset($_SESSION['type']) || $_SESSION['type']!="3") {
        echo "Unauthorized Access :(<br>";
        echo "<a href='./logout.php'>Back to Home</a>";
        exit();
    }
  /*if (!isset($_SESSION['student_subject'])) {
    echo "Subject Not Selected :(<br>";
    echo "<a href='princi_det_index.php'>Back to Previous Page</a>";
    exit();
  }*/
  $st_code_staff=$_SESSION['st_code'];
  $staff_id=$_SESSION['staff_id'];
   $gmt_no=$_SESSION['gmt_no'];

  include("./Config.php");
  

                        $subject_query=mysql_query("SELECT id_subject, subject_title FROM table_subject WHERE st_code='{$st_code_staff}' AND subject_code!='' ORDER BY id_subject");
                         $sub_count=mysql_num_rows($subject_query);
                        
                        
  $get_staff_id_name=mysql_query("SELECT staff_name FROM table_staff_details WHERE staff_id='$staff_id'");
  while($row=mysql_fetch_array($get_staff_id_name))
  {
    $staff_id_name=$row['staff_name'];
  }

   echo "<center><img src='./images/logo.png'";
    echo "<br><br>Hi ".$staff_id_name."...";
  echo "  <br><br>";
 include("./headerselection.php");
  echo $echo_stc;
  echo "</center>";
?>
<?php $i=1;
              while($i<=$sub_count){
                $student_subject=$i;

?>

              <?php

  $sub_name="";
              $sub_query=mysql_query("SELECT subject_code, subject_title FROM table_subject WHERE id_subject='$student_subject' AND st_code='$st_code_staff'");
              while($row=mysql_fetch_array($sub_query))
              {
                 echo "<br><center> SUBJECT CODE:".$sub_name=$row['subject_code']; echo "|TITLE: ".$row['subject_title'];echo "<br><br>GMT NO.:".$gmt_no."</center><br>";
              }
              $reg_no="";
              $reg_no_query=mysql_query("SELECT student_name, student_regno FROM table_student_details WHERE st_code='$st_code_staff' AND access='' ORDER BY student_regno");
              
$c_code='6213';
 ?>
<center>
 <form method="post"><H4>Marks</H4><button onclick="dfunction();">Export to xls</button>
 <div id="table_wrapper">
<table id="list" border="1"><th>Sl.No</th><th>Register Number</th><th>Name</th><th>GMT <?php echo $gmt_no; ?></th><th>SLOW TRACK<?php echo $gmt_no; ?></th>
<?php $n='1'; $sl='1';
      $absnt='0';
      $pass='0';
      $fail='0';
      $tnst='0';

      while($row=mysql_fetch_array($reg_no_query))
              {
                $check_avail_query=mysql_query("SELECT subject_{$student_subject}, subject_{$student_subject}_st, subject{$student_subject}_cb FROM table_gmt_marks WHERE st_code='$st_code_staff' AND gmt_no='$gmt_no' AND student_regno='{$row['student_regno']}' ORDER BY student_regno");
                 $count=mysql_num_rows($check_avail_query);
        if($count==1)
        {
                while($row_in=mysql_fetch_array($check_avail_query))
              {
                //total calculation starts
                   $tnst=mysql_num_rows($reg_no_query);
                  if($row_in['subject'.$student_subject.'_cb']==0 && $row_in['subject_'.$student_subject.'']=='150')
                        { 
                            $absnt++;
                        }
                        elseif($row_in['subject'.$student_subject.'_cb']==0 )
                        { 
                            $fail++;
                        }
                        else
                        {
                            $pass++;
                        }
                 //Total calculation ends
                if($row_in['subject_'.$student_subject.'_st']=="0"){
                    $row_in['subject_'.$student_subject.'_st']=" ";
                   }
                 if($row_in['subject_'.$student_subject.'']=='150'){$row_in['subject_'.$student_subject.'']="AB";}
                 echo "<tr><td>".$sl."</td><td>".$c_code.$row['student_regno']."</td><td>".$row['student_name']."</td><td><input type='text' value='{$row_in['subject_'.$student_subject.'']} 'readonly id='mark".$n."'></td><td><input type='text' value='{$row_in['subject_'.$student_subject.'_st']}' readonly>
                 <input type='hidden' id='chk".$n."' value='{$row_in['subject'.$student_subject.'_cb']}'></td></tr>";
                 $n=$n+'1';$sl=$sl+'1';
              }
          }
          else{
             if($row_in['subject_'.$student_subject.'']=='150'){$row_in['subject_'.$student_subject.'']="AB";}
            
                 echo "<tr><td>".$sl."</td><td>".$c_code.$row['student_regno']."</td><td>".$row['student_name']."</td><td><input type='text' name='r".$n."' value='' readonly></td><td><input type='text' name='r2".$n."' value='' readonly  id='mark".$n."'>
                 <input type='hidden' id='chk".$n."' value='{$row_in['subject'.$student_subject.'_cb']}'></td></tr>";
                 $n=$n+'1';
                 $sl=$sl+'1';
              
          }
          }
         

   ?>

</table>
</form>

<br>
<?php    
          echo "No. of Students:".$tnst."<br>";
          echo "No. of Pass:".$pass."<br>";
          echo "No. of Fail:".$fail."<br>";
          echo "No. of Absent:".$absnt."<br>";
?>


</center>
</body>
</html>
<script>
      window.onload = myFunction;
       var n=<?php echo $n; ?>;
       var i=1;

       function myFunction() {
     while(i<n){
var d="mark"+i; 
var c="chk"+i;  
   
    
    var x = document.getElementById(d).value;
    var y = document.getElementById(c).value;

    switch(x)
    {
      case "NULL":
      document.getElementById(d).style.backgroundColor="red";

      document.getElementById(d).style.color="white";
      break;

      case "0":
      document.getElementById(d).style.backgroundColor="red";

      document.getElementById(d).style.color="white";
      break;
      case "1":
      
      document.getElementById(d).style.backgroundColor="red";
      document.getElementById(d).style.color="white";
      break;
      case "2":
      document.getElementById(d).style.backgroundColor="red";
      document.getElementById(d).style.color="white";
      break;
      case "3":

      document.getElementById(d).style.backgroundColor="red";

      document.getElementById(d).style.color="white";
      break;
      case "4":
      
      document.getElementById(d).style.backgroundColor="red";

      document.getElementById(d).style.color="white";
      break;
      case "5":
      
      document.getElementById(d).style.backgroundColor="red";

      document.getElementById(d).style.color="white";
      break;
      case "6":
      
      document.getElementById(d).style.backgroundColor="red";

      document.getElementById(d).style.color="white";
      break;
      case "7":
      
      document.getElementById(d).style.backgroundColor="red";

      document.getElementById(d).style.color="white";
      break;
      case "8":
      
      document.getElementById(d).style.backgroundColor="red";

      document.getElementById(d).style.color="white";
      break;
      case "9":
      
      document.getElementById(d).style.backgroundColor="red";

      document.getElementById(d).style.color="white";
      break;
      case "10":
      
      document.getElementById(d).style.backgroundColor="red";

      document.getElementById(d).style.color="white";
      break;
      case "11":
      
      document.getElementById(d).style.backgroundColor="red";

      document.getElementById(d).style.color="white";
      break;
      case "12":
      
      document.getElementById(d).style.backgroundColor="red";

      document.getElementById(d).style.color="white";
      break;
      case "13":
      
      document.getElementById(d).style.backgroundColor="red";

      document.getElementById(d).style.color="white";
      break;
      case "14":
      document.getElementById(d).style.backgroundColor="white";

      document.getElementById(d).style.color="black";
      break;
      case "15":
      document.getElementById(d).style.backgroundColor="white";

      document.getElementById(d).style.color="black";
      break;
      case "16":
      
      document.getElementById(d).style.backgroundColor="white";

      document.getElementById(d).style.color="black";

    break;
      case "17":
      
      document.getElementById(d).style.backgroundColor="white";

      document.getElementById(d).style.color="black";
      break;
      case "18":
      
      document.getElementById(d).style.backgroundColor="white";

      document.getElementById(d).style.color="black";
      break;
      case "19":
      
      document.getElementById(d).style.backgroundColor="white";

      document.getElementById(d).style.color="black";
      break;
      case "20":
      
      document.getElementById(d).style.backgroundColor="white";

      document.getElementById(d).style.color="black";
      break;
      case "AB":
      
      document.getElementById(d).style.backgroundColor="red";

      document.getElementById(d).style.color="white";
      break;
      case "150":
      
      document.getElementById(d).style.backgroundColor="red";

      document.getElementById(d).style.color="white";
      break;
      default:
      
      document.getElementById(d).style.backgroundColor="white";

      document.getElementById(d).style.color="black";
      break;
      }

if(y=="0")
{
  document.getElementById(d).style.backgroundColor="red";

      document.getElementById(d).style.color="white";
}


      i++;

          }
          i=1;
          }
          </script>
          <?php
          $i++;
        } ?>
<a href="princi_det_index.php"><button>Back</button></a>