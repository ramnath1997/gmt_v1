<?php

$reg_yr=substr($st_code_staff, 0,2);
$d=substr($st_code_staff, 3,1);
$c=substr($st_code_staff, 5,1);
$b=substr($st_code_staff, 7,3);
$s=substr($st_code_staff, 10,1);
$sem=substr($st_code_staff, 12,1);

	$d_query=mysql_query("SELECT value_degree FROM table_degree WHERE id_degree='$d'");
	while($row=mysql_fetch_array($d_query))
	{
		$echo_stc=$row['value_degree']." | ";
		$d_n=$row['value_degree']; 
	}
	$c_query=mysql_query("SELECT value_course FROM table_course WHERE id_course='$c'");
	while($row=mysql_fetch_array($c_query))
	{
		$echo_stc=$echo_stc.$row['value_course']." | ";
		 $c_n=$row['value_course'];
	}
	$b_query=mysql_query("SELECT value_branch FROM table_branch WHERE code_branch='$b'");
	while($row=mysql_fetch_array($b_query))
	{
		$echo_stc=$echo_stc.$row['value_branch']." | ";
		 $b_n=$row['value_branch']; 
	}
	$b_query=mysql_query("SELECT value_year, id_sem FROM table_semester WHERE id_sem='$sem'");
	while($row=mysql_fetch_array($b_query))
	{
		 $echo_stc=$echo_stc.$row['value_year']." | SEM:" .$row['id_sem'];
		 $y_n=$row['value_year'];  $s_n=$row['id_sem'];
	}
	 $echo_stc=$echo_stc." | Sec: ".$s;
	?>
