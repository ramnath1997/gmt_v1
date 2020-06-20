<?php
$q = $_GET['q'];
session_start();

    include("./Config.php");
    
$sem_query=mysql_query("SELECT id_sem, value_sem FROM table_semester ORDER BY id_sem");

$br_query=mysql_query("SELECT id_group, id_course FROM table_branch WHERE id_branch='{$q}'");
while($row = mysql_fetch_array($br_query)) {
  $id_group=$row['id_group'];
  $id_course=$row['id_course'];
}
echo "
<option value='0' selected>Semester</option>";
if( $q==11){
	echo"<option value='1'>One</option>";
	echo"<option value='2'>Two</option>";
}
else
	{if($id_course!=3){
			while($row = mysql_fetch_array($sem_query)) {
				if($row['id_sem']<3){
					continue;
				}
	   echo"<option value='".$row['id_sem']."'>".$row['value_sem']."</option>";
	}
	}
	if($id_course==3){
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

											