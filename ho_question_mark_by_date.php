
<script type="text/javascript" src="./js/jquery-latest.min.js"></script>
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
    <html><head><title>View By Date Portal</title></head><body>
<?php
  session_start();
  if (!isset($_SESSION['staff_id']) || $_SESSION['staff_id']=="0") {
    echo "Page Not Found :(<br>";
    include("./logout.php");
    echo "<a href='./logout.php'>Back to Home</a>";
    exit();
  }
   $_SESSION['st_code'];
  if (!isset($_SESSION['st_code'])) {
    echo "Class Not Selected :(<br>";
    echo "<a href='./staff_select.php'>Back to Select</a>";
    exit();
  }
  if (!isset($_SESSION['type']) || $_SESSION['type']!="2") {
        echo "Unauthorized Access :(<br>";
        echo "<a href='./logout.php'>Back to Home</a>";
        exit();
    }
  if (!isset($_SESSION['gmt_date'])) {
    echo "GMT Date. is not Selected :(<br>";
    echo "<a href='ho_index.php'>Back to Previous Page</a>";
    exit();
  }
  $st_code_staff=$_SESSION['st_code'];
  $staff_id=$_SESSION['staff_id'];
   $gmt_date=$_SESSION['gmt_date'];

  include("./Config.php");
  $get_access_code=mysql_query("SELECT access FROM table_staff_details WHERE staff_id='$staff_id'");
                        while($row=mysql_fetch_array($get_access_code))
                        {
                            $access=$row['access'];
                            if ($access!='0') {
                                echo "Unauthorized Access :(<br>";
        echo "<a href='./logout.php'>Back to Home</a>";
        exit();
                            }
                        }
  $get_staff_id_name=mysql_query("SELECT staff_name FROM table_staff_details WHERE staff_id='$staff_id'");
  while($row=mysql_fetch_array($get_staff_id_name))
  {
    $staff_id_name=$row['staff_name'];
  }
    echo "<center><img src='./images/logo.png'";
    echo "<br><br>Hi ".$staff_id_name."...<br>";
 include("./headerselection.php");
 echo "</center>";
?>
<center>
<?php
$asd="";
			
              ?>
              <?php
              $student_subject="";
              $id_query=mysql_query("SELECT id_subject,gmt_no,act_td FROM table_question WHERE gmt_date='$gmt_date' AND st_code='$st_code_staff'");
              while($row=mysql_fetch_array($id_query))
              {
                  $student_subject=$row['id_subject']; $gmt_no=$row['gmt_no']; $act_td_qsn=$row['act_td'];
              }
              if($student_subject==""){
                echo "<br><H1>No Data has Been Recorded</H1>";
                echo "<a href='ho_index.php'><button>Back</button></a>";

                exit();
              }

  $sub_name="";
              $sub_query=mysql_query("SELECT subject_code, subject_title FROM table_subject WHERE id_subject='$student_subject' AND st_code='$st_code_staff'");
              while($row=mysql_fetch_array($sub_query))
              {
                 echo "<br><center> SUBJECT CODE:".$sub_name=$row['subject_code']; echo "|TITLE: ".$row['subject_title'];echo "<br>GMT NO.:".$gmt_no."</center>";
              }
              $reg_no="";
              $reg_no_query=mysql_query("SELECT student_name, student_regno FROM table_student_details WHERE st_code='$st_code_staff' AND access='' ORDER BY student_regno");
              
$c_code='6213';
$question_pre_query=mysql_query("SELECT question FROM table_question WHERE id_subject='$student_subject' AND st_code='$st_code_staff' AND gmt_no='$gmt_no' ");
              while($row=mysql_fetch_array($question_pre_query))
              {
                 $question_pre=$row['question'];
              }
 ?>
 <H4>Question</H4><?php echo "Updated Time:".$act_td_qsn; ?>
<br> <textarea  rows="7" cols="103" readonly><?php echo $question_pre; ?></textarea> <br>
<?php
  
              $location = "./doc_dir/".$d_n."/".$c_n."/".$b_n."/".$y_n."/".$s_n."/".$student_subject."/";
              $sub_name="";
              $sub_query=mysql_query("SELECT subject_code FROM table_subject WHERE id_subject='$student_subject' AND st_code='$st_code_staff'");
              while($row=mysql_fetch_array($sub_query))
              {
                 $sub_name=$row['subject_code'];
              }
              $gz=$dz='';
              if($gmt_no<'10')
              {
                $gz='0';
              }
              if(date('n')<'10')
              {
                $dz='0';
              }
              $f_name = $sub_name."GMT".$gz.$gmt_no."KeSiG".date('Y');

              $data=$f_name;
              if(is_dir($location)){
              $dirHandle = opendir($location);
                  while ($file = readdir($dirHandle)) {
                    $f_reduced=substr($file, 0,20);
                   if($f_reduced==$data) {
                      echo "Attachments:<br>";
                      echo "<a href='".$location.$file."' name='".$f_name."'>".$f_reduced."</a>";
                    }
                  }
              }
    
  ?>
 <H4>Marks</H4><button onclick="dfunction();">Export to xls</button>
 <div id="table_wrapper">
<center><table id="list" border="1"><th>Sl.No</th><th>Register Number</th><th>Name</th><th>GMT <?php echo $gmt_no; ?></th><th>SLOW TRACK<?php echo $gmt_no; ?></th>
<?php $n='1'; $sl='1';
      $absnt='0';
      $pass='0';
      $fail='0';
      $tnst='0';

			while($row=mysql_fetch_array($reg_no_query))
              {
              	$check_avail_query=mysql_query("SELECT subject_{$student_subject}, subject_{$student_subject}_st,act_td{$student_subject}, subject{$student_subject}_cb FROM table_gmt_marks WHERE st_code='$st_code_staff' AND gmt_no='$gmt_no' AND student_regno='{$row['student_regno']}' ORDER BY student_regno");
              	 $count=mysql_num_rows($check_avail_query);
				if($count==1)
				{
              	while($row_in=mysql_fetch_array($check_avail_query))
              {
                //total calculation starts
                   $tnst=mysql_num_rows($reg_no_query);
                   if($row_in['subject_'.$student_subject.'_st']=="0"){
                    $row_in['subject_'.$student_subject.'_st']=" ";
                   }
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
                 if($row_in['subject_'.$student_subject.'']=='150'){$row_in['subject_'.$student_subject.'']="AB";}
                 echo "<tr><td>".$sl."</td><td>".$c_code.$row['student_regno']."</td><td>".$row['student_name']."</td><td><input type='text' value='{$row_in['subject_'.$student_subject.'']} 'readonly id='mark".$n."'></td><td><input type='text' value='{$row_in['subject_'.$student_subject.'_st']}' readonly>
                 <input type='hidden' id='chk".$n."' value='{$row_in['subject'.$student_subject.'_cb']}'></td></tr>";
                 $n=$n+'1';
                 $sl=$sl+'1';
              }
          }
          else{
             if($row_in['subject_'.$student_subject.'']=='150'){$row_in['subject_'.$student_subject.'']="AB";}
          	
                 echo "<tr><td>".$sl."</td><td>".$c_code.$row['student_regno']."</td><td>".$row['student_name']."</td><td><input type='text' name='r".$n."' value='' readonly id='mark".$n."' > </td><td><input type='text' name='r2".$n."' value='' readonly>
                 <input type='hidden' id='chk".$n."' value='{$row_in['subject'.$student_subject.'_cb']}'></td></tr>";
                 $n=$n+'1';
                $sl=$sl+'1';
              
          }
          }
          $td_query=mysql_query("SELECT DISTINCT staff_id,act_td{$student_subject} FROM table_gmt_marks WHERE st_code='$st_code_staff' AND gmt_no='$gmt_no' ORDER BY student_regno");
          while ($r=mysql_fetch_array($td_query)) {
            echo "Last Updated on ".$r['act_td'.$student_subject.''];
          }
   ?>
</table>
   <br>

      <?php    
          echo "No. of Students:".$tnst."<br>";
          echo "No. of Pass:".$pass."<br>";
          echo "No. of Fail:".$fail."<br>";
          echo "No. of Absent:".$absnt."<br>";
      ?>
<br>
</center>
</table></center></div>

    <?php
             //Column_Chart Line Starts
         $rating_data = array( array('Employee', 'Students'), array('Pass', $pass), array('Fail', $fail), array('Absent', $absnt) );
        //Column_Chart Line Ends
          $passf=$tnstf=$failf=$absntf=$cdb='0';
          ?>
          <!--Column chart Starts-->
<?php
 $encoded_data = json_encode($rating_data);
?>

<script type="text/javascript" src="./js/jsapi_bar.js"></script>

    <script type="text/javascript">
      google.load("visualization", "1", {packages:["columnchart"]});
      google.setOnLoadCallback(drawChart);
function drawChart() 
{
 var data = google.visualization.arrayToDataTable(
 <?php  echo $encoded_data; ?>
 );
 var options = {
  title: "Total Department Graphical Analysis"
 };
 var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, {width: 400, height: 240, is3D: true, title: 'Students Performance'});
      }
    </script>
<style>
body
{
 margin: auto;
 padding:0px;
 text-align:center;
 width:100%;
 font-family: "Myriad Pro","Helvetica Neue",Helvetica,Arial,Sans-Serif;
 background-color:#FAFAFA;
}
#wrapper
{
 margin: auto;
 padding:0px;
 text-align:center;
 width:995px;
}
#wrapper h1
{
 margin-top:50px;
 font-size:45px;
 color:#585858;
}
#wrapper h1 p
{
 font-size:18px;
}
#chart_div
{
 padding:0px;
 width:200px;
 height:400px;
 margin-left:auto;
}
</style>

 <div id="chart_div" style="display: block;
    margin: auto; align-content: center;
    width: 100%; height: 50%;"></div>

<!--Column chart Ends-->
<br>
<center>
    <center><table><tr><td>Class Advisor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Co-Ordinator&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td> <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HOD&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Principal</td></tr></table></center>
  <br><br>
<a href="ho_index.php"><button>Back</button></a>
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
if(x<14 || x=="AB" || x=="150" || x=="NULL"){
	document.getElementById(d).style.backgroundColor="red";

      document.getElementById(d).style.color="white";
}
   if(x>14 && x<=20){
      document.getElementById(d).style.backgroundColor="white";

      document.getElementById(d).style.color="black";
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