<html><head><title>View Mark Portal</title></head><body>
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
    echo "<a href='./staff_select.php'>Back to Select</a>";
    exit();
  }
  if (!isset($_SESSION['type']) || $_SESSION['type']!="3") {
        echo "Unauthorized Access :(<br>";
        echo "<a href='./logout.php'>Back to Home</a>";
        exit();
    }

  /*if (!isset($_SESSION['gmt_no'])) {
    echo "GMT No. is not Entered :(<br>";
    echo "<a href='student_display_select.php'>Back to Previous Page</a>";
    exit();
  }*/
  if (!isset($_SESSION['student_subject'])) {
    echo "Subject Not Selected :(<br>";
    echo "<a href='student_display_select.php'>Back to Previous Page</a>";
    exit();
  }
  $st_code_staff=$_SESSION['st_code'];
  $staff_id=$_SESSION['staff_id'];
  //$gmt_no=$_SESSION['gmt_no'];
  $student_subject=$_SESSION['student_subject'];
  include("./Config.php");
  $get_staff_id_name=mysql_query("SELECT staff_name FROM table_staff_details WHERE staff_id='$staff_id'");
  while($row=mysql_fetch_array($get_staff_id_name))
  {
    $staff_id_name=$row['staff_name'];
  }
echo "<center><img src='./images/logo.png'";
    echo "<b><br>Hi ".$staff_id_name."...<br>";
  echo "  <br>";
  include("./headerselection.php");
  echo $echo_stc;
?>
</center>


              <?php
              $sub_name="";
              $sub_query=mysql_query("SELECT subject_code, subject_title FROM table_subject WHERE id_subject='$student_subject' AND st_code='$st_code_staff'");
              while($row=mysql_fetch_array($sub_query))
              {
                 echo "<br><center> SUBJECT CODE:".$sub_name=$row['subject_code']; echo "|TITLE: ".$row['subject_title'];echo "</center>";
              }
              $reg_no="";
              $reg_no_query=mysql_query("SELECT student_name, student_regno FROM table_student_details WHERE st_code='$st_code_staff' AND access='' ORDER BY student_regno");
              
$c_code='6213';
 ?>
<br>
 <form method="post">
 <?php 
 $no_of_gmt_query=mysql_query("SELECT DISTINCT gmt_no FROM table_gmt_marks WHERE st_code='$st_code_staff'  ORDER BY gmt_no");
 ?>
<center><H4>Marks</H4>
 <div id="table_wrapper">
<table id="list" border="1"><tr><th>Sl.No</th><th>Register Number</th><th>Name</th>
<?php 
while($row=mysql_fetch_array($no_of_gmt_query)){
echo "<th>GMT ".$row['gmt_no']."</th><th>ST".$row['gmt_no']."</th>";
}
echo "</tr>";
?>
<?php $n='1';$sl='1';
			 $no_of_gmt_query=mysql_query("SELECT DISTINCT gmt_no FROM table_gmt_marks WHERE st_code='$st_code_staff'  ORDER BY gmt_no");
       $count=mysql_num_rows($no_of_gmt_query);
       if($count=='0')
       {
        echo "No Records Found";
        
       }
       else{
				while($row_in_2=mysql_fetch_array($no_of_gmt_query)){
			while($row=mysql_fetch_array($reg_no_query))
              {
              	$check_avail_query=mysql_query("SELECT subject_{$student_subject}, subject_{$student_subject}_st, subject{$student_subject}_cb, gmt_no FROM table_gmt_marks WHERE st_code='$st_code_staff' AND student_regno='{$row['student_regno']}' ORDER BY gmt_no");
              	 $count=mysql_num_rows($check_avail_query);
				if($count>=1)
				{
					echo "<tr><td>".$sl."</td><td>".$c_code.$row['student_regno']."</td><td style='width: 100px' >".$row['student_name']."</td>";
                  $sl=$sl+1;
                	
              	while($row_in=mysql_fetch_array($check_avail_query))
              {
                if($row_in['subject_'.$student_subject.'_st']=="0"){
                    $row_in['subject_'.$student_subject.'_st']=" ";
                   }
                if($row_in['subject_'.$student_subject.'']=='150'){$row_in['subject_'.$student_subject.'']="AB";}
					    echo "<td><input type='text' style='width: 50px' value='{$row_in['subject_'.$student_subject.'']}' id='mark".$n."' readonly ></td>
                 <td><input type='text' style='width: 50px' value='{$row_in['subject_'.$student_subject.'_st']}' id='mark".$n."' readonly ><input type='hidden' id='chk".$n."' value='{$row_in['subject'.$student_subject.'_cb']}'></td>";
                  $n=$n+1;
             }
             echo "</tr>";
            
              }
              else{
            
                  echo "<tr><td>".$sl."</td><td>".$c_code.$row['student_regno']."</td><td>".$row['student_name']."</td><td><input type='text' name='r".$n."' value='' ></td><td><input type='text' name='r2".$n."' value='' ></td></tr>";
                 $n=$n+'1';
                $sl=$sl+'1';
              
          }
          }
          
          
      }
    }
   ?>
</table>
</form>
</center>
<br>
<center>
  <center><table><tr><td>Class Advisor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Co-Ordinator&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td> <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HOD&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Principal</td></tr></table></center>
  <br><br>
<a href="princi_det_index.php"><button>Back</button></a>
<button onclick="dfunction();">Export to xls</button>
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