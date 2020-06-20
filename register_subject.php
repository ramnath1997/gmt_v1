<?php
session_start();

include("./Config.php");
$st_code_staff=$_SESSION['st_code_staff'];
 $staff_id=$_SESSION['staff_id'];
$get_staff_id_name=mysql_query("SELECT staff_name FROM table_staff_details WHERE staff_id='$staff_id'");
while($row=mysql_fetch_array($get_staff_id_name))
{
	$staff_id_name=$row['staff_name'];
}

	echo "Hi ".$staff_id_name."...<br>";

echo "  ";
$d=substr($st_code_staff, 1,1);
$c=substr($st_code_staff, 3,1);
$b=substr($st_code_staff, 5,3);
$s=substr($st_code_staff, 9,1);

$d_query=mysql_query("SELECT value_degree FROM table_degree WHERE id_degree='$d'");
while($row=mysql_fetch_array($d_query))
{
	echo $row['value_degree']." | ";
}
$c_query=mysql_query("SELECT value_course FROM table_course WHERE id_course='$c'");
while($row=mysql_fetch_array($c_query))
{
	echo $row['value_course']." | ";
}
$b_query=mysql_query("SELECT value_branch FROM table_branch WHERE code_branch='$b'");
while($row=mysql_fetch_array($b_query))
{
	echo $row['value_branch']." | ";
}
$b_query=mysql_query("SELECT value_year, id_sem FROM table_semester WHERE id_sem='$s'");
while($row=mysql_fetch_array($b_query))
{
	echo $row['value_year']." | SEM:" .$row['id_sem'];
}

												


$subject_code1_y=$subject_name1_y=$subject_code2_y=$subject_name2_y=$subject_code3_y=$subject_name3_y=$subject_code4_y=$subject_name4_y=$subject_code5_y=$subject_name5_y=$subject_code6_y=$subject_name6_y='';

$subject_code1_z=mysql_query("SELECT `subject_code` FROM `table_subject` WHERE `st_code` = '$st_code_staff' AND id_subject='1'");
$count1=mysql_num_rows($subject_code1_z);

$subject_code2_z=mysql_query("SELECT `subject_code` FROM `table_subject` WHERE `st_code` = '$st_code_staff' AND id_subject='2'");
$count2=mysql_num_rows($subject_code2_z);

$subject_code3_z=mysql_query("SELECT `subject_code` FROM `table_subject` WHERE `st_code` = '$st_code_staff' AND id_subject='3'");
$count3=mysql_num_rows($subject_code3_z);

$subject_code4_z=mysql_query("SELECT `subject_code` FROM `table_subject` WHERE `st_code` = '$st_code_staff' AND id_subject='4'");
$count4=mysql_num_rows($subject_code4_z);

$subject_code5_z=mysql_query("SELECT `subject_code` FROM `table_subject` WHERE `st_code` = '$st_code_staff' AND id_subject='5'");
$count5=mysql_num_rows($subject_code5_z);

$subject_code6_z=mysql_query("SELECT `subject_code` FROM `table_subject` WHERE `st_code` = '$st_code_staff' AND id_subject='6'");
$count6=mysql_num_rows($subject_code6_z);
?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" )
	{
		if(isset($_POST['subject_reg']))
		{
			if(trim($_POST['subject_reg'])=="yes")
			{			

				;
						
						if(isset($_POST['subject_code1']) && isset($_POST['subject_name1']) ){
							if($count1==""){
							mysql_query("INSERT INTO table_subject(st_code, subject_code, subject_title, id_subject) VALUES('$st_code_staff','".$_POST['subject_code1']."','".$_POST['subject_name1']."','1' ) ");
							
						}
						else
						{	
							if(trim($_POST['subject_code1'])!=""){
							mysql_query("UPDATE table_subject SET subject_code='{$_POST['subject_code1']}' WHERE id_subject='1' AND st_code='$st_code_staff' ");
							}
							if (trim($_POST['subject_name1'])!="") {
								mysql_query("UPDATE table_subject SET subject_title='{$_POST['subject_name1']}' WHERE id_subject='1' AND st_code='$st_code_staff' ");
							}
						
						}
						}

						
						if(isset($_POST['subject_code2']) && isset($_POST['subject_name2']) ){
							if($count2==""){
							mysql_query("INSERT INTO table_subject(st_code, subject_code, subject_title, id_subject) VALUES('$st_code_staff','".$_POST['subject_code2']."','".$_POST['subject_name2']."','2' ) ");
							
						}
						else
						{
							if (trim($_POST['subject_code2'])!=""){
								mysql_query("UPDATE table_subject SET subject_code='{$_POST['subject_code2']}' WHERE id_subject='2' AND st_code='$st_code_staff' ");
							}
							if (trim($_POST['subject_name2'])!=""){
								mysql_query("UPDATE table_subject SET subject_title='{$_POST['subject_name2']}' WHERE id_subject='2' AND st_code='$st_code_staff' ");
							}

						}
						}

						if(isset($_POST['subject_code3']) && isset($_POST['subject_name3']) ){
							if($count3==""){
							mysql_query("INSERT INTO table_subject(st_code, subject_code, subject_title, id_subject) VALUES('$st_code_staff','".$_POST['subject_code3']."','".$_POST['subject_name3']."','3' ) ");
							
						}
						else
						{
							if (trim($_POST['subject_code3'])!=""){
								mysql_query("UPDATE table_subject SET subject_code='{$_POST['subject_code3']}' WHERE id_subject='3' AND st_code='$st_code_staff' ");
							}
							if (trim($_POST['subject_name3'])!=""){
								mysql_query("UPDATE table_subject SET subject_title='{$_POST['subject_name3']}' WHERE id_subject='3' AND st_code='$st_code_staff' ");
							}

						}
						}

						if(isset($_POST['subject_code4']) && isset($_POST['subject_name4']) ){
							if($count4==""){
							mysql_query("INSERT INTO table_subject(st_code, subject_code, subject_title, id_subject) VALUES('$st_code_staff','".$_POST['subject_code4']."','".$_POST['subject_name4']."','4' ) ");
							
						}
						else
						{
							if (trim($_POST['subject_code4'])!=""){
								mysql_query("UPDATE table_subject SET subject_code='{$_POST['subject_code4']}' WHERE id_subject='4' AND st_code='$st_code_staff' ");
							}
							if (trim($_POST['subject_name4'])!=""){
								mysql_query("UPDATE table_subject SET subject_title='{$_POST['subject_name4']}' WHERE id_subject='4' AND st_code='$st_code_staff' ");
							}
							if (trim($_POST['subject_code4'])=="0"){
								mysql_query("UPDATE table_subject SET subject_code='' WHERE id_subject='4' AND st_code='$st_code_staff' ");
							}
							if (trim($_POST['subject_name4'])=="0"){
								mysql_query("UPDATE table_subject SET subject_title='' WHERE id_subject='4' AND st_code='$st_code_staff' ");
							}
						}
						}

						if(isset($_POST['subject_code5']) && isset($_POST['subject_name5']) ){
							if($count5==""){
							mysql_query("INSERT INTO table_subject(st_code, subject_code, subject_title, id_subject) VALUES('$st_code_staff','".$_POST['subject_code5']."','".$_POST['subject_name5']."','5' ) ");
							
						}
						else
						{
							if (trim($_POST['subject_code5'])!=""){
								mysql_query("UPDATE table_subject SET subject_code='{$_POST['subject_code5']}' WHERE id_subject='5' AND st_code='$st_code_staff' ");
							}
							if (trim($_POST['subject_name5'])!=""){
								mysql_query("UPDATE table_subject SET subject_title='{$_POST['subject_name5']}' WHERE id_subject='5' AND st_code='$st_code_staff' ");
							}
							if (trim($_POST['subject_code5'])=="0"){
								mysql_query("UPDATE table_subject SET subject_code='' WHERE id_subject='5' AND st_code='$st_code_staff' ");
							}
							if (trim($_POST['subject_name5'])=="0"){
								mysql_query("UPDATE table_subject SET subject_title='' WHERE id_subject='5' AND st_code='$st_code_staff' ");
							}
						}
						}

						if(isset($_POST['subject_code6']) && isset($_POST['subject_name6']) ){
							if($count6==""){
							mysql_query("INSERT INTO table_subject(st_code, subject_code, subject_title, id_subject) VALUES('$st_code_staff','".$_POST['subject_code6']."','".$_POST['subject_name6']."','6' ) ");
							
						}
						else
						{

							if (trim($_POST['subject_code6'])!=""){
								mysql_query("UPDATE table_subject SET subject_code='{$_POST['subject_code6']}' WHERE id_subject='6' AND st_code='$st_code_staff' ");
							}
							if (trim($_POST['subject_name6'])!=""){
								mysql_query("UPDATE table_subject SET subject_title='{$_POST['subject_name6']}' WHERE id_subject='6' AND st_code='$st_code_staff' ");
							}
							if (trim($_POST['subject_code6'])=="0"){
								mysql_query("UPDATE table_subject SET subject_code='' WHERE id_subject='6' AND st_code='$st_code_staff' ");
							}
							if (trim($_POST['subject_name6'])=="0"){
								mysql_query("UPDATE table_subject SET subject_title='' WHERE id_subject='6' AND st_code='$st_code_staff' ");
							}
						}
						}
					}
				
			}
		}
	
?>
<form name="staff_reg" method="POST" >
<center>
<table >
								<tr>
									<td>
										<b>Subject Entry:			
											</b>
										
									</td>
									</tr>
									<tr>
									<td>
										<input type="hidden" name="subject_reg"   value="yes" />
									</td>
									
									<td>
										<b>Subject Code						
											</b>
										
									</td>
									<td>
									<?php 
											$subject_code1_z=mysql_query("SELECT `subject_code` FROM `table_subject` WHERE `st_code` = '$st_code_staff' AND id_subject='1'");

											while($result=mysql_fetch_array($subject_code1_z))
											$subject_code1_y= $result['subject_code'];

										if($subject_code1_y!="")
											{
												?>
										<input type="text" name="subject_code1" placeholder="<?php echo $subject_code1_y ?>" value=""  />
										<?php
											}
											else{
												?>
										<input type="text" name="subject_code1"  placeholder="Subject Code" value="" />
										<?php } ?>
									</td>
								
								<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td>
										<b>Subject Name						
											</b>
									</td>
									<td>
									<?php 
											
											$subject_name1_z=mysql_query("SELECT `subject_title` FROM `table_subject` WHERE `st_code` = '$st_code_staff' AND id_subject='1'");
											while($result=mysql_fetch_array($subject_name1_z))
											$subject_name1_y= $result['subject_title'];

										if($subject_name1_y!="")
											{
												?>
										<input type="text" name="subject_name1" placeholder="<?php echo $subject_name1_y ?>" value=""  />
										<?php
											}
											else{
												?>
										<input type="text" name="subject_name1"  placeholder="Subject Name" value="" />
										<?php } ?>
									</td>
									</tr>
									<tr>
									<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
									<td>
										<b>Subject Code						
											</b>
										
									</td>
									<td>
									<?php 
											
											$subject_code2_z=mysql_query("SELECT `subject_code` FROM `table_subject` WHERE `st_code` = '$st_code_staff' AND id_subject='2'");

											while($result=mysql_fetch_array($subject_code2_z))
											$subject_code2_y= $result['subject_code'];

										if($subject_code2_y!="")
											{
												?>
										<input type="text" name="subject_code2" placeholder="<?php echo $subject_code2_y ?>" value=""  />
										<?php
											}
											else{
												?>
										<input type="text" name="subject_code2"  placeholder="Subject Code" value="" />
										<?php } ?>
									</td>
								
								<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td>
										<b>Subject Name						
											</b>
									</td>
									<td>
									<?php 
											$subject_name2_z=mysql_query("SELECT `subject_title` FROM `table_subject` WHERE `st_code` = '$st_code_staff' AND id_subject='2'");
											while($result=mysql_fetch_array($subject_name2_z))
											$subject_name2_y= $result['subject_title'];

										if($subject_name2_y!="")
											{
												?>
										<input type="text" name="subject_name2" placeholder="<?php echo $subject_name2_y ?>" value=""  />
										<?php
											}
											else{
												?>
										<input type="text" name="subject_name2"  placeholder="Subject Name" value="" />
										<?php } ?>
									</td>
									</tr>
									<tr>
									<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
									<td>
										<b>Subject Code						
											</b>
										
									</td>
									<td>
									<?php 
											$subject_code3_z=mysql_query("SELECT `subject_code` FROM `table_subject` WHERE `st_code` = '$st_code_staff' AND id_subject='3'");
											while($result=mysql_fetch_array($subject_code3_z))
											$subject_code3_y= $result['subject_code'];

										if($subject_code3_y!="")
											{
												?>
										<input type="text" name="subject_code3" placeholder="<?php echo $subject_code3_y ?>" value=""  />
										<?php
											}
											else{
												?>
										<input type="text" name="subject_code3"  placeholder="Subject Code" value="" />
										<?php } ?>
									</td>
								
								<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td>
										<b>Subject Name						
											</b>
									</td>
									<td>
									<?php 
											
											$subject_name3_z=mysql_query("SELECT `subject_title` FROM `table_subject` WHERE `st_code` = '$st_code_staff' AND id_subject='3'");
											while($result=mysql_fetch_array($subject_name3_z))
											$subject_name3_y= $result['subject_title'];

										if($subject_name3_y!="")
											{
												?>
										<input type="text" name="subject_name3" placeholder="<?php echo $subject_name3_y ?>" value=""  />
										<?php
											}
											else{
												?>
										<input type="text" name="subject_name3"  placeholder="Subject Name" value="" />
										<?php } ?>
									</td>
									</tr>

									<!-- next three -->
									<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
									<td>
										<b>Subject Code						
											</b>
										
									</td>
									<td>
									<?php 
											$subject_code4_z=mysql_query("SELECT `subject_code` FROM `table_subject` WHERE `st_code` = '$st_code_staff' AND id_subject='4'");

											while($result=mysql_fetch_array($subject_code4_z))
											$subject_code4_y= $result['subject_code'];

										if($subject_code4_y!="")
											{
												?>
										<input type="text" name="subject_code4" placeholder="<?php echo $subject_code4_y ?>" value=""  />
										<?php
											}
											else{
												?>
										<input type="text" name="subject_code4"  placeholder="Subject Code" value="" />
										<?php } ?>
									</td>
								
								<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td>
										<b>Subject Name						
											</b>
									</td>
									<td>
									<?php 
											
											$subject_name4_z=mysql_query("SELECT `subject_title` FROM `table_subject` WHERE `st_code` = '$st_code_staff' AND id_subject='4'");
											while($result=mysql_fetch_array($subject_name4_z))
											$subject_name4_y= $result['subject_title'];

										if($subject_name4_y!="")
											{
												?>
										<input type="text" name="subject_name4" placeholder="<?php echo $subject_name4_y ?>" value=""  />
										<?php
											}
											else{
												?>
										<input type="text" name="subject_name4"  placeholder="Subject Name" value="" />
										<?php } ?>
									</td>
									</tr>
									<tr>
									<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
									<td>
										<b>Subject Code						
											</b>
										
									</td>
									<td>
									<?php 
											
											$subject_code5_z=mysql_query("SELECT `subject_code` FROM `table_subject` WHERE `st_code` = '$st_code_staff' AND id_subject='5'");
											while($result=mysql_fetch_array($subject_code5_z))
											$subject_code5_y= $result['subject_code'];

										if($subject_code5_y!="")
											{
												?>
										<input type="text" name="subject_code5" placeholder="<?php echo $subject_code5_y ?>" value=""  />
										<?php
											}
											else{
												?>
										<input type="text" name="subject_code5"  placeholder="Subject Code" value="" />
										<?php } ?>
									</td>
								
								<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td>
										<b>Subject Name						
											</b>
									</td>
									<td>
									<?php 
											$subject_name5_z=mysql_query("SELECT `subject_title` FROM `table_subject` WHERE `st_code` = '$st_code_staff' AND id_subject='5'");
											while($result=mysql_fetch_array($subject_name5_z))
											$subject_name5_y= $result['subject_title'];

										if($subject_name5_y!="")
											{
												?>
										<input type="text" name="subject_name5" placeholder="<?php echo $subject_name5_y ?>" value=""  />
										<?php
											}
											else{
												?>
										<input type="text" name="subject_name5"  placeholder="Subject Name" value="" />
										<?php } ?>
									</td>
									</tr>
									<tr>
									<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
									<td>
										<b>Subject Code						
											</b>
										
									</td>
									<td>
									<?php 
											$subject_code6_z=mysql_query("SELECT `subject_code` FROM `table_subject` WHERE `st_code` = '$st_code_staff' AND id_subject='6'");
											while($result=mysql_fetch_array($subject_code6_z))
											$subject_code6_y= $result['subject_code'];

										if($subject_code6_y!="")
											{
												?>
										<input type="text" name="subject_code6" placeholder="<?php echo $subject_code6_y ?>" value=""  />
										<?php
											}
											else{
												?>
										<input type="text" name="subject_code6"  placeholder="Subject Code" value="" />
										<?php } ?>
									</td>
								
								<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td>
										<b>Subject Name						
											</b>
									</td>
									<td>
									<?php 
											
											$subject_name6_z=mysql_query("SELECT `subject_title` FROM `table_subject` WHERE `st_code` = '$st_code_staff' AND id_subject='6'");
											while($result=mysql_fetch_array($subject_name6_z))
											$subject_name6_y= $result['subject_title'];

										if($subject_name6_y!="")
											{
												?>
										<input type="text" name="subject_name6" placeholder="<?php echo $subject_name6_y ?>" value=""  />
										<?php
											}
											else{
												?>
										<input type="text" name="subject_name6"  placeholder="Subject Name" value="" />
										<?php } ?>
									</td>
									</tr>
									
									
									</table></center>
									<center><input style="display: block;
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

<a href="index3.php"><button>Back</button></a>
