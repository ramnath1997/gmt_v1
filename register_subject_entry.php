<?php
include("./Config.php");
?>
<script src='js/dropdown_codes.js' type='text/javascript'></script>
<form method="post">
<table><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								
<td><b>Student Degree</b></td>
									<td>

										<input type="hidden" name="staff_select" value='1'>
										<select name="student_degree" onchange="getCourse_staff_selectsub(this.value) ">
											<option value="0">Select Degree</option>
											<?php

												$degree_query=mysql_query("SELECT id_degree, value_degree FROM table_degree ORDER BY id_degree");
												while($row=mysql_fetch_array($degree_query))
												{
													echo"<option value='".$row['id_degree']."'>".$row['value_degree']."</option>";
												}
												?>
										</select>
										
									</tr>
								<tr>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								
									<td><b>Student Course</b></td>
									<td>
										
										<select id="Course_staff_selectsub" name='student_course' onchange='getBranch_staff_selectsub(this.value)' required>
											<option selected>Course</option>
										</select>
										 
									</td>
									</tr>
								<tr>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
									<td><b>Student Dept</b></td>
									<td>
										
										<select id="Branch_staff_selectsub" name='student_dept'  required>
											<option selected>Branch</option>
										</select>
										
									</td>
								<tr>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td><b>Student Sem</b></td>
									<td>
										
										<select name="student_sem" ">
											<option value="0">Select Semester</option>
											<?php

												$sem_query=mysql_query("SELECT id_sem, value_sem FROM table_semester ORDER BY id_sem");
												while($row=mysql_fetch_array($sem_query))
												{
													echo"<option value='".$row['id_sem']."'>".$row['value_sem']."</option>";
												}
												?>
										</select>
										
									</tr>
									</table></center>
									<center> <input input style="display: block;
    margin-top: 2.5em;
    padding: 1.5em;
    width: 100%;
    border: none;
    background: #e75854;
    color: #f9f6e5;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 800;
    font-size: 1.25em;" type="submit" value="Enter"></center>
									</form>
<?php
	include("./Config.php");
	session_start();
	$staff_id=$_SESSION['staff_id'];
	$i=0;
	
	while ( $i<= 10) {
		echo '<input type="text" name="n'.$i.'" value="" > ';
		$i=$i+1;
	}
		# code...
	
	echo "welcome".$staff_id;
if ($_SERVER["REQUEST_METHOD"] == "POST" )
	{
		if(isset($_POST['staff_select']))
		{
			if(trim($_POST['staff_select'])=="1")
			{
									$s_deg=$_POST['student_degree'];
									$s_cou=$_POST['student_course'];
									$s_dep=$_POST['student_dept'];
									$s_dep_code="";
									$dep_name=mysql_query("SELECT `code_branch` FROM `table_branch` WHERE `id_branch`= '$s_dep'");
									while($row=mysql_fetch_array($dep_name))
									{
		 								$s_dep_code=$row['code_branch'];
									}
									$s_sem=$_POST['student_sem'];
									if(isset($s_deg) AND isset($s_cou) AND isset ($s_dep) AND isset($s_sem) AND $s_dep_code!="")
								{	
									
									$st_code_staff="D".$s_deg."C".$s_cou."B".$s_dep_code."S".$s_sem;
									$_SESSION['st_code_staff']=$st_code_staff;
									header('Location: register_subject.php');
								}
			}
		}
	}