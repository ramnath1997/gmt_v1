<?php
if (!isset($_GET['q'])) {
        echo "Unauthorized Access :(<br>";
        echo "<a href='./logout.php'>Back to Home</a>";
        exit();
    }
$staff_dept = $_GET['q'];

session_start();
if (!isset($_SESSION['staff_id']) || $_SESSION['staff_id']=="0") {
        echo "Page Not Found :(<br>";
        include("./logout.php");
        echo "<a href='./logout.php'>Back to Home</a>";
        exit();
    }
    
    if (isset($_SESSION['st_code_staff'])) {
        unset($_SESSION['st_code_staff']);
    }
    $hod_id=$_SESSION['staff_id'];
    
    /*while ( $i<= 10) {
        echo '<input type="text" name="n'.$i.'" value="" > ';
        $i=$i+1;
    }*/
    include("./Config.php");
  
$sem_query=mysql_query("SELECT id_sem, value_sem FROM table_semester ORDER BY id_sem");

$br_query=mysql_query("SELECT id_group,id_course FROM table_branch WHERE id_branch='{$staff_dept}' ");
while($row = mysql_fetch_array($br_query)) {
  $id_group=$row['id_group'];
  $q=$row['id_course'];
}
echo "
<option value='0' selected>Semester</option>";
if( $staff_dept==11){
	echo"<option value='1'>One</option>";
	echo"<option value='2'>Two</option>";
}
else
	{if($q!=3){
			while($row = mysql_fetch_array($sem_query)) {
				if($row['id_sem']<3){
					continue;
				}
	   echo"<option value='".$row['id_sem']."'>".$row['value_sem']."</option>";
	}
	}
	if($q==3){
		$i=0;
			while($row = mysql_fetch_array($sem_query)) {
				if($i>3){
					break;
				}
				else{
		echo"<option value='".$row['id_sem']."'>".$row['value_sem']."</option>";
		$i++;
	}
		}
	}}


?>

											