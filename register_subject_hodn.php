<?php
session_start();
if (!isset($_SESSION['staff_id']) || $_SESSION['staff_id']=="0") {
    echo "Page Not Found :(<br>";
    include("./logout.php");
    echo "<a href='./logout.php'>Back to Home</a>";
    exit();
  }
  if (!isset($_SESSION['type']) || $_SESSION['type']!="2") {
    echo "Unauthorized Access :((<br>";
    include("./logout.php");
    echo "<a href='./logout.php'>Back to Home</a>";
    exit();
  }
  if (!isset($_SESSION['st_code'])) {
    echo "Class Not Selected :(<br>";
    echo "<a href='./staff_select.php'>Back to Select</a>";
    exit();
  }
include("./Config.php");
$st_code_staff=$_SESSION['st_code'];
 $staff_id=$_SESSION['staff_id'];
$get_staff_id_name=mysql_query("SELECT staff_name FROM table_staff_details WHERE staff_id='$staff_id'");
while($row=mysql_fetch_array($get_staff_id_name))
{
	$staff_id_name=$row['staff_name'];
}

	  $echo_user="Hi ".$staff_id_name."...";
  
  $echo_stc=$echo_sub="";
  include("./headerselection.php");
  ?>
  <?php
												


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
<!DOCTYPE html>
<html>
    <head>
        <title>Student Registration Portal</title>
        <script type="application/x-javascript">
            addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }
        </script>
        <!-- Custom Theme files -->
        <link href="css/style_ha.css" rel="stylesheet" type="text/css" media="all" />
        <script src='js/dropdown_codes.js' type='text/javascript'></script>
        <link href="css/font-awesome.css" rel="stylesheet">     <!-- font-awesome icons -->
        <!-- //Custom Theme files -->
        <!-- web font -->
        <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'><!--web font-->
        <!-- //web font -->
    </head>
    <body>
        <!-- main -->
        <div class="main-agileits">
            <h1>Student Registration</h1>
            <div class="mainw3-agileinfo">
                <?php echo "<p style='font-size: 1em;
    color: #fff;'>".$echo_user."<p>"; ?>
                <!-- login form -->
                <div class="login-form">  
                    <div class="login-agileits-top">
                    	<center>
<table><tr>
	<td ><p >Subject Code </p></td><td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td >		<p>Subject Name</p>	</td></tr>
															
									<tr><td>
									<?php 
											$subject_code1_z=mysql_query("SELECT `subject_code` FROM `table_subject` WHERE `st_code` = '$st_code_staff' AND id_subject='1'");

											while($result=mysql_fetch_array($subject_code1_z))
											$subject_code1_y= $result['subject_code'];

										if($subject_code1_y!="")
											{
												?>
										<input type="text"  name="subject_code1" value="<?php echo $subject_code1_y ?>" value=""  />
										<?php
											}
											else{
												?>
										<input type="text" class="login__input listsub " name="subject_code1"  placeholder="Subject Code" value="" />
										<?php } ?>
					</td><td> &nbsp;</td><td>
									<?php 
											
											$subject_name1_z=mysql_query("SELECT `subject_title` FROM `table_subject` WHERE `st_code` = '$st_code_staff' AND id_subject='1'");
											while($result=mysql_fetch_array($subject_name1_z))
											$subject_name1_y= $result['subject_title'];

										if($subject_name1_y!="")
											{
												?>
										<input type="text"  name="subject_name1" value="<?php echo $subject_name1_y ?>" value=""  />
										<?php
											}
											else{
												?>
										<input class="login__input listsub " type="text" name="subject_name1"  placeholder="Subject Name" value="" />
										<?php } ?>
									</td></tr>
									<tr><td>
									<p>Subject Code</p></td><td> &nbsp;</td><td>
									<p>Subject Name</p></td></tr><tr><td>
																	<?php 
											
											$subject_code2_z=mysql_query("SELECT `subject_code` FROM `table_subject` WHERE `st_code` = '$st_code_staff' AND id_subject='2'");

											while($result=mysql_fetch_array($subject_code2_z))
											$subject_code2_y= $result['subject_code'];

										if($subject_code2_y!="")
											{
												?>
										<input  type="text" name="subject_code2" value="<?php echo $subject_code2_y ?>" value=""  />
										<?php
											}
											else{
												?>
										<input type="text" name="subject_code2"  placeholder="Subject Code" value="" />
										<?php } ?>
									</td><td> &nbsp;</td><td>
									<?php 
											$subject_name2_z=mysql_query("SELECT `subject_title` FROM `table_subject` WHERE `st_code` = '$st_code_staff' AND id_subject='2'");
											while($result=mysql_fetch_array($subject_name2_z))
											$subject_name2_y= $result['subject_title'];

										if($subject_name2_y!="")
											{
												?>
										<input type="text"  name="subject_name2" value="<?php echo $subject_name2_y ?>" value=""  />
										<?php
											}
											else{
												?>
										<input type="text"  name="subject_name2"  placeholder="Subject Name" value="" />
										<?php } ?>
										</td></tr>
									<tr><td>
									<p>Subject Code</p></td><td> &nbsp;</td><td>
									<p>Subject Name</p></td></tr><tr><td>
									<?php 
											$subject_code3_z=mysql_query("SELECT `subject_code` FROM `table_subject` WHERE `st_code` = '$st_code_staff' AND id_subject='3'");
											while($result=mysql_fetch_array($subject_code3_z))
											$subject_code3_y= $result['subject_code'];

										if($subject_code3_y!="")
											{
												?>
										<input type="text"  name="subject_code3" value="<?php echo $subject_code3_y ?>" value=""  />
										<?php
											}
											else{
												?>
										<input type="text"  name="subject_code3"  placeholder="Subject Code" value="" />
										<?php } ?>
									</td><td> &nbsp;</td><td>
									<?php 
											
											$subject_name3_z=mysql_query("SELECT `subject_title` FROM `table_subject` WHERE `st_code` = '$st_code_staff' AND id_subject='3'");
											while($result=mysql_fetch_array($subject_name3_z))
											$subject_name3_y= $result['subject_title'];

										if($subject_name3_y!="")
											{
												?>
										<input type="text"  name="subject_name3" value="<?php echo $subject_name3_y ?>" value=""  />
										<?php
											}
											else{
												?>
										<input type="text"  name="subject_name3"  placeholder="Subject Name" value="" />
										<?php } ?>
										</td></tr>
									<tr><td>
									<p>Subject Code</p></td><td> &nbsp;</td><td>
									<p>Subject Name</p></td></tr><tr><td>
									<?php 
											$subject_code4_z=mysql_query("SELECT `subject_code` FROM `table_subject` WHERE `st_code` = '$st_code_staff' AND id_subject='4'");

											while($result=mysql_fetch_array($subject_code4_z))
											$subject_code4_y= $result['subject_code'];

										if($subject_code4_y!="")
											{
												?>
										<input type="text"  name="subject_code4" value="<?php echo $subject_code4_y ?>" value=""  />
										<?php
											}
											else{
												?>
										<input type="text"  name="subject_code4"  placeholder="Subject Code" value="" />
										<?php } ?>
									</td><td> &nbsp;</td><td>
									<?php 
											
											$subject_name4_z=mysql_query("SELECT `subject_title` FROM `table_subject` WHERE `st_code` = '$st_code_staff' AND id_subject='4'");
											while($result=mysql_fetch_array($subject_name4_z))
											$subject_name4_y= $result['subject_title'];

										if($subject_name4_y!="")
											{
												?>
										<input type="text"  name="subject_name4" value="<?php echo $subject_name4_y ?>" value=""  />
										<?php
											}
											else{
												?>
										<input type="text"  name="subject_name4"  placeholder="Subject Name" value="" />
										<?php } ?>
										</td></tr>
									<tr><td>
									<p>Subject Code</p></td><td> &nbsp;</td><td>
									<p>Subject Name</p></td></tr><tr><td>
									<?php 
											
											$subject_code5_z=mysql_query("SELECT `subject_code` FROM `table_subject` WHERE `st_code` = '$st_code_staff' AND id_subject='5'");
											while($result=mysql_fetch_array($subject_code5_z))
											$subject_code5_y= $result['subject_code'];

										if($subject_code5_y!="")
											{
												?>
										<input type="text"  name="subject_code5" value="<?php echo $subject_code5_y ?>" value=""  />
										<?php
											}
											else{
												?>
										<input type="text"  name="subject_code5"  placeholder="Subject Code" value="" />
										<?php } ?>
									</td><td> &nbsp;</td><td>
									<?php 
											$subject_name5_z=mysql_query("SELECT `subject_title` FROM `table_subject` WHERE `st_code` = '$st_code_staff' AND id_subject='5'");
											while($result=mysql_fetch_array($subject_name5_z))
											$subject_name5_y= $result['subject_title'];

										if($subject_name5_y!="")
											{
												?>
										<input type="text" name="subject_name5" value="<?php echo $subject_name5_y ?>" value=""  />
										<?php
											}
											else{
												?>
										<input type="text"  name="subject_name5"  placeholder="Subject Name" value="" />
										<?php } ?>
										</td></tr>
									<tr><td>
									<p>Subject Code</p></td><td> &nbsp;</td><td>
									<p>Subject Name</p></td></tr><tr><td>
									<?php 
											$subject_code6_z=mysql_query("SELECT `subject_code` FROM `table_subject` WHERE `st_code` = '$st_code_staff' AND id_subject='6'");
											while($result=mysql_fetch_array($subject_code6_z))
											$subject_code6_y= $result['subject_code'];

										if($subject_code6_y!="")
											{
												?>
										<input type="text" name="subject_code6" value="<?php echo $subject_code6_y ?>" value=""  />
										<?php
											}
											else{
												?>
										<input type="text"   name="subject_code6"  placeholder="Subject Code" value="" />
										<?php } ?>
									</td><td> &nbsp;</td><td>
									
									<?php 
											
											$subject_name6_z=mysql_query("SELECT `subject_title` FROM `table_subject` WHERE `st_code` = '$st_code_staff' AND id_subject='6'");
											while($result=mysql_fetch_array($subject_name6_z))
											$subject_name6_y= $result['subject_title'];

										if($subject_name6_y!="")
											{
												?>
										<input type="text"  name="subject_name6" value="<?php echo $subject_name6_y ?>" value=""  />
										<?php
											}
											else{
												?>
										<input type="text"  name="subject_name6"  placeholder="Subject Name" value="" />
										<?php } ?></td></tr>
									</table></center>
<input class="login__submit_qsn_mark" type="submit" name="mark_entry">
</form>
<a href="ho_index.php"><button style="width:70px ">Back</button></a>
	<a href="hp_select.php"><button style="width:100px ">Home</button></a>

<a href="logout.php"><button style="width:100px ">Logout</button></a>

