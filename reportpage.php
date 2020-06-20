<html><head><title>Student Report Portal</title></head><body>
<?php
  
  session_start();
  if (!isset($_SESSION['staff_id']) || $_SESSION['staff_id']=="0") {
    echo "Page Not Found :(<br>";
    include("./logout.php");
    echo "<a href='./logout.php'>Back to Home</a>";
    exit();
   }
     if (!isset($_SESSION['type']) || $_SESSION['type']!="3") {
        echo "Unauthorized Access :(<br>";
        echo "<a href='./logout.php'>Back to Home</a>";
        exit();
    }
	if (!isset($_SESSION['student_regno'])) 
	{
		echo "Page Not Found :(<br>";
		include("./logout.php");
		echo "<a href='./logout.php'>Back to Home</a>";
		exit();
	}
	$staff_id=$_SESSION['staff_id'];
	include("./Config.php");
	$student_regno=$_SESSION['student_regno'];
	$student_id_name=$st_code="";
	$get_student_id_name=mysql_query("SELECT student_name, st_code FROM table_student_details WHERE student_regno='$student_regno'");
	while($row=mysql_fetch_array($get_student_id_name))
	{
		$student_id_name=$row['student_name'];
		$st_code=$row['st_code'];
	}
	$get_staff_id_name=mysql_query("SELECT staff_name FROM table_staff_details WHERE staff_id='$staff_id'");
  while($row=mysql_fetch_array($get_staff_id_name))
  {
    $staff_id_name=$row['staff_name'];
  }
   echo "<center><img src='./images/logo.png'";
    echo "<br><br>Hi ".$staff_id_name."...";
 	echo "<br>";
	$echo_user= "Student Name: ".$student_id_name."<br>";
	$c_code='6213';
	echo "<br>";
	echo $echo_user;
	echo "<br>Register Number: ";
	echo "6213".$student_regno;
?>
</center>
<br>
<center>
<form method="post">

	<table border="1">


	<?php 
		$student_subject='1';
		$student_subject_of_gmt_query=mysql_query("SELECT DISTINCT gmt_no FROM table_gmt_marks WHERE student_regno='$student_regno'  ORDER BY gmt_no");
	    $count=mysql_num_rows($student_subject_of_gmt_query);
	    if($count=='0')
	    {
	    	echo "<br>No Records Found";
	    }
	    else
	    {
	    	$n=1;
	    	echo "<tr><th>Name</th>";
			while($row=mysql_fetch_array($student_subject_of_gmt_query))
			{
				echo "<th>GMT ".$row['gmt_no']."</th><th>ST".$row['gmt_no']."</th>";
			}
			echo "</tr>";
			$check_avail_subject=mysql_query("SELECT subject_code, subject_title, id_subject FROM table_subject WHERE st_code='$st_code' AND subject_code!='' ORDER BY id_subject");
            $count_s=mysql_num_rows($check_avail_subject);
			if ($count_s == 0)
			{
				echo "No Subjects are Registered";
			}
			else
			{	
				while($row=mysql_fetch_array($check_avail_subject))
            	{ $s_s=1;
            		echo "<tr><td>".$row['subject_title']."</td>";
            		$student_subject_mark=mysql_query("SELECT subject_{$row['id_subject']}, subject_{$row['id_subject']}_st, subject{$row['id_subject']}_cb FROM table_gmt_marks WHERE student_regno='$student_regno' AND st_code='$st_code' ORDER BY gmt_no");
            		
            		$i= $row['id_subject'];
            		
            		while($row1=mysql_fetch_array($student_subject_mark))
					{	if($row1['subject_'.$i.'']=='150'){$row1['subject_'.$i.'']="AB";}
				if($row1['subject_'.$i.'_st']=="0"){
                    $row1['subject_'.$i.'_st']=" ";
                   }
						echo "<td ><input type='text' id='mark".$n."' value='".$row1['subject_'.$i.'']."' style='width: 50px' readonly><input type='hidden' id='chk".$n."' value='{$row1['subject'.$i.'_cb']}' ></td><td>".$row1['subject_'.$i.'_st']."</td>";
						$n++;
					}
					echo "</tr>";
					$s_s++;
            	}
            }
	    }	
	?>

	</table>
</form>
</center>
<br>
<center>
<a href="i_report.php"><button>Back</button></a>
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


