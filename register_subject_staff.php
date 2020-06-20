<?php
session_start();
if (!isset($_SESSION['staff_id']) || $_SESSION['staff_id']=="0") {
    echo "Page Not Found :(<br>";
    include("./logout.php");
    echo "<a href='./logout.php'>Back to Home</a>";
    exit();
  }
  /*if (!isset($_SESSION['type']) || $_SESSION['staff_id']!="1") {
    echo "Access Restricted :(<br>";
    echo "<a href='./logout.php'>Back to Home</a>";
    exit();
  }*/
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
  $d=substr($st_code_staff, 1,1);
  $c=substr($st_code_staff, 3,1);
  $b=substr($st_code_staff, 5,3);
  $s=substr($st_code_staff, 9,1);
  $d_n=$c_n=$b_n=$y_n=$s_n="";
  $d_query=mysql_query("SELECT value_degree FROM table_degree WHERE id_degree='$d'");
  while($row=mysql_fetch_array($d_query))
  {
      $d_n=$row['value_degree']; 
  }
  $c_query=mysql_query("SELECT value_course FROM table_course WHERE id_course='$c'");
  while($row=mysql_fetch_array($c_query))
  {
     $c_n=$row['value_course'];
  }
  $b_query=mysql_query("SELECT value_branch FROM table_branch WHERE code_branch='$b'");
  while($row=mysql_fetch_array($b_query))
  {
     $b_n=$row['value_branch']; 
  }
  $b_query=mysql_query("SELECT value_year, id_sem FROM table_semester WHERE id_sem='$s'");
  while($row=mysql_fetch_array($b_query))
  {
     $y_n=$row['value_year']; $s_n=$row['id_sem'];
  }

  $d_query=mysql_query("SELECT value_degree FROM table_degree WHERE id_degree='$d'");
  while($row=mysql_fetch_array($d_query))
  {
    $echo_stc=$row['value_degree']." | ";
  }
  $c_query=mysql_query("SELECT value_course FROM table_course WHERE id_course='$c'");
  while($row=mysql_fetch_array($c_query))
  {
    $echo_stc=$echo_stc.$row['value_course']." | ";
  }
  $b_query=mysql_query("SELECT value_branch FROM table_branch WHERE code_branch='$b'");
  while($row=mysql_fetch_array($b_query))
  {
    $echo_stc=$echo_stc.$row['value_branch']." | ";
  }
  $b_query=mysql_query("SELECT value_year, id_sem FROM table_semester WHERE id_sem='$s'");
  while($row=mysql_fetch_array($b_query))
  {
    $echo_stc=$echo_stc.$row['value_year']." | SEM:" .$row['id_sem'];
  }?>
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
<html >
<head>
  <meta charset="UTF-8">
  <title>Login/Logout animation concept</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
  
  <!--<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans'>-->

<script src='js/dropdown_codes.js' type='text/javascript'></script>
      <link rel="stylesheet" href="css/style.css">
     <!-- <link rel="stylesheet" href="scss/style.scss">-->

  
</head>
<body>
  <div class="cont">
  <div class="demo">
  <div class="login__check_user" > <?php echo "<p x='0' y='-1'>".$echo_user." ".$echo_stc."<p>"; ?></div>  
     
    <div class="login">
<div class="login__check_user" > <?php echo "<p x='0' y='-1'>".$echo_user." ".$echo_stc."<p>"; ?></div>  
     
   
    
    <div class="login__form_select">
<form name="staff_reg" method="POST" >

								<input type="hidden" name="subject_reg"   value="yes" />
<div id="container">  
    <div id="scrollbox"  >  
        <div id="content" id="style-6" >
	<table style="background: transparent;" border="0"><tr  style="background: transparent; height: 2em"><td  style="background: transparent; height: 2em">
	<div class="login__row_title_sub">	
<svg >
<text x="0" y="5" style="font-size: 13px" text-anchor="start" alignment-baseline="start" fill="white">Subject Code</text>
</svg>

</div>
<div class="login__row_sub">		
															
									
									<?php 
											$subject_code1_z=mysql_query("SELECT `subject_code` FROM `table_subject` WHERE `st_code` = '$st_code_staff' AND id_subject='1'");

											while($result=mysql_fetch_array($subject_code1_z))
											$subject_code1_y= $result['subject_code'];

										if($subject_code1_y!="")
											{
												?>
										<input type="text" class="login__input listsub " name="subject_code1" value="<?php echo $subject_code1_y ?>" value=""  />
										<?php
											}
											else{
												?>
										<input type="text" class="login__input listsub " name="subject_code1"  placeholder="Subject Code" value="" />
										<?php } ?>
										
									</div>
									</td><td  style="background: transparent;">
<div class="login__row_title_sub" >	
<svg >
<text x="0" y="5" style="font-size: 13px" text-anchor="start" alignment-baseline="start" fill="white">Subject Name</text>
</svg>
</div>						
			<div class="login__row_sub">							
									<?php 
											
											$subject_name1_z=mysql_query("SELECT `subject_title` FROM `table_subject` WHERE `st_code` = '$st_code_staff' AND id_subject='1'");
											while($result=mysql_fetch_array($subject_name1_z))
											$subject_name1_y= $result['subject_title'];

										if($subject_name1_y!="")
											{
												?>
										<input type="text" class="login__input listsub " name="subject_name1" value="<?php echo $subject_name1_y ?>" value=""  />
										<?php
											}
											else{
												?>
										<input class="login__input listsub " type="text" name="subject_name1"  placeholder="Subject Name" value="" />
										<?php } ?>
									</div></td></tr>
									<tr class='text-leftopsub' style="background: transparent;"><td  style="background: transparent;">
	<div class="login__row_title_sub">	
<svg >
<text x="0" y="5" style="font-size: 13px" text-anchor="start" alignment-baseline="start" fill="white">Subject Code</text>
</svg>

</div>
<div class="login__row_sub">
									<?php 
											
											$subject_code2_z=mysql_query("SELECT `subject_code` FROM `table_subject` WHERE `st_code` = '$st_code_staff' AND id_subject='2'");

											while($result=mysql_fetch_array($subject_code2_z))
											$subject_code2_y= $result['subject_code'];

										if($subject_code2_y!="")
											{
												?>
										<input class="login__input listsub " type="text" name="subject_code2" value="<?php echo $subject_code2_y ?>" value=""  />
										<?php
											}
											else{
												?>
										<input class="login__input listsub " type="text" name="subject_code2"  placeholder="Subject Code" value="" />
										<?php } ?>
			</div>
									</td><td class='text-left' style="background: transparent;">
<div class="login__row_title_sub" >	
<svg >
<text x="0" y="5" style="font-size: 13px" text-anchor="start" alignment-baseline="start" fill="white">Subject Name</text>
</svg>
</div>						
			<div class="login__row_sub">							
									
									<?php 
											$subject_name2_z=mysql_query("SELECT `subject_title` FROM `table_subject` WHERE `st_code` = '$st_code_staff' AND id_subject='2'");
											while($result=mysql_fetch_array($subject_name2_z))
											$subject_name2_y= $result['subject_title'];

										if($subject_name2_y!="")
											{
												?>
										<input type="text" class="login__input listsub name="subject_name2" value="<?php echo $subject_name2_y ?>" value=""  />
										<?php
											}
											else{
												?>
										<input type="text" class="login__input listsub name="subject_name2"  placeholder="Subject Name" value="" />
										<?php } ?>
									</div></td></tr>
									<tr style="background: transparent;"><td class='text-leftop' style="background: transparent;">
	<div class="login__row_title_sub">	
<svg >
<text x="0" y="5" style="font-size: 13px" text-anchor="start" alignment-baseline="start" fill="white">Subject Code</text>
</svg>

</div>
<div class="login__row_sub">
									<?php 
											$subject_code3_z=mysql_query("SELECT `subject_code` FROM `table_subject` WHERE `st_code` = '$st_code_staff' AND id_subject='3'");
											while($result=mysql_fetch_array($subject_code3_z))
											$subject_code3_y= $result['subject_code'];

										if($subject_code3_y!="")
											{
												?>
										<input type="text" class="login__input listsub " name="subject_code3" value="<?php echo $subject_code3_y ?>" value=""  />
										<?php
											}
											else{
												?>
										<input type="text" class="login__input listsub " name="subject_code3"  placeholder="Subject Code" value="" />
										<?php } ?>
									</div>
									</td><td class='text-left' style="background: transparent;">
<div class="login__row_title_sub" >	
<svg >
<text x="0" y="5" style="font-size: 13px" text-anchor="start" alignment-baseline="start" fill="white">Subject Name</text>
</svg>
</div>						
			<div class="login__row_sub">
									<?php 
											
											$subject_name3_z=mysql_query("SELECT `subject_title` FROM `table_subject` WHERE `st_code` = '$st_code_staff' AND id_subject='3'");
											while($result=mysql_fetch_array($subject_name3_z))
											$subject_name3_y= $result['subject_title'];

										if($subject_name3_y!="")
											{
												?>
										<input type="text" class="login__input listsub " name="subject_name3" value="<?php echo $subject_name3_y ?>" value=""  />
										<?php
											}
											else{
												?>
										<input type="text" class="login__input listsub " name="subject_name3"  placeholder="Subject Name" value="" />
										<?php } ?>
									</div></td></tr>
									<tr style="background: transparent;"><td class='text-leftop' style="background: transparent;">
	<div class="login__row_title_sub">	
<svg >
<text x="0" y="5" style="font-size: 13px" text-anchor="start" alignment-baseline="start" fill="white">Subject Code</text>
</svg>

</div>
<div class="login__row_sub">
									<?php 
											$subject_code4_z=mysql_query("SELECT `subject_code` FROM `table_subject` WHERE `st_code` = '$st_code_staff' AND id_subject='4'");

											while($result=mysql_fetch_array($subject_code4_z))
											$subject_code4_y= $result['subject_code'];

										if($subject_code4_y!="")
											{
												?>
										<input type="text" class="login__input listsub " name="subject_code4" value="<?php echo $subject_code4_y ?>" value=""  />
										<?php
											}
											else{
												?>
										<input type="text" class="login__input listsub " name="subject_code4"  placeholder="Subject Code" value="" />
										<?php } ?>
									</div>
									</td><td class='text-left' style="background: transparent;">
<div class="login__row_title_sub" >	
<svg >
<text x="0" y="5" style="font-size: 13px" text-anchor="start" alignment-baseline="start" fill="white">Subject Name</text>
</svg>
</div>						
			<div class="login__row_sub">
									<?php 
											
											$subject_name4_z=mysql_query("SELECT `subject_title` FROM `table_subject` WHERE `st_code` = '$st_code_staff' AND id_subject='4'");
											while($result=mysql_fetch_array($subject_name4_z))
											$subject_name4_y= $result['subject_title'];

										if($subject_name4_y!="")
											{
												?>
										<input type="text" class="login__input listsub " name="subject_name4" value="<?php echo $subject_name4_y ?>" value=""  />
										<?php
											}
											else{
												?>
										<input type="text" class="login__input listsub " name="subject_name4"  placeholder="Subject Name" value="" />
										<?php } ?>
									</div></td></tr>
									<tr style="background: transparent;"><td class='text-leftop' style="background: transparent;">
	<div class="login__row_title_sub">	
<svg >
<text x="0" y="5" style="font-size: 13px" text-anchor="start" alignment-baseline="start" fill="white">Subject Code</text>
</svg>

</div>
<div class="login__row_sub">
									<?php 
											
											$subject_code5_z=mysql_query("SELECT `subject_code` FROM `table_subject` WHERE `st_code` = '$st_code_staff' AND id_subject='5'");
											while($result=mysql_fetch_array($subject_code5_z))
											$subject_code5_y= $result['subject_code'];

										if($subject_code5_y!="")
											{
												?>
										<input type="text" class="login__input listsub " name="subject_code5" value="<?php echo $subject_code5_y ?>" value=""  />
										<?php
											}
											else{
												?>
										<input type="text" class="login__input listsub " name="subject_code5"  placeholder="Subject Code" value="" />
										<?php } ?>
									</div>
									</td><td class='text-left' style="background: transparent;">
<div class="login__row_title_sub" >	
<svg >
<text x="0" y="5" style="font-size: 13px" text-anchor="start" alignment-baseline="start" fill="white">Subject Name</text>
</svg>
</div>
			<div class="login__row_sub">
									<?php 
											$subject_name5_z=mysql_query("SELECT `subject_title` FROM `table_subject` WHERE `st_code` = '$st_code_staff' AND id_subject='5'");
											while($result=mysql_fetch_array($subject_name5_z))
											$subject_name5_y= $result['subject_title'];

										if($subject_name5_y!="")
											{
												?>
										<input type="text" class="login__input listsub " name="subject_name5" value="<?php echo $subject_name5_y ?>" value=""  />
										<?php
											}
											else{
												?>
										<input type="text" class="login__input listsub " name="subject_name5"  placeholder="Subject Name" value="" />
										<?php } ?>
									</div></td></tr>
									<tr style="background: transparent;"><td class='text-leftop' style="background: transparent;">
	<div class="login__row_title_sub">	
<svg >
<text x="0" y="5" style="font-size: 13px" text-anchor="start" alignment-baseline="start" fill="white">Subject Code</text>
</svg>

</div>
<div class="login__row_sub">
									<?php 
											$subject_code6_z=mysql_query("SELECT `subject_code` FROM `table_subject` WHERE `st_code` = '$st_code_staff' AND id_subject='6'");
											while($result=mysql_fetch_array($subject_code6_z))
											$subject_code6_y= $result['subject_code'];

										if($subject_code6_y!="")
											{
												?>
										<input type="text" class="login__input listsub " name="subject_code6" value="<?php echo $subject_code6_y ?>" value=""  />
										<?php
											}
											else{
												?>
										<input type="text" class="login__input listsub "  name="subject_code6"  placeholder="Subject Code" value="" />
										<?php } ?>
									</div>
									</td><td class='text-left' style="background: transparent;">
<div class="login__row_title_sub" >	
<svg >
<text x="0" y="5" style="font-size: 13px" text-anchor="start" alignment-baseline="start" fill="white">Subject Name</text>
</svg>
</div>						
			<div class="login__row_sub">
									<?php 
											
											$subject_name6_z=mysql_query("SELECT `subject_title` FROM `table_subject` WHERE `st_code` = '$st_code_staff' AND id_subject='6'");
											while($result=mysql_fetch_array($subject_name6_z))
											$subject_name6_y= $result['subject_title'];

										if($subject_name6_y!="")
											{
												?>
										<input type="text" class="login__input listsub " name="subject_name6" value="<?php echo $subject_name6_y ?>" value=""  />
										<?php
											}
											else{
												?>
										<input type="text" class="login__input listsub " name="subject_name6"  placeholder="Subject Name" value="" />
										<?php } ?>
									</div></td></tr>
									
									
									</table></div></div></div>
									 
<input class="login__submit_qsn_mark" type="submit" name="mark_entry">
</form>
</div><a href="index3.php"><button class="login__submit_back" >Back</button></a>

<a href="logout.php"><button class="app__logout">
<svg class="app__logout-icon svg-icon" viewBox="0 0 20 20">
          <path d="M6,3 a8,8 0 1,0 8,0 M10,0 10,12"/>
        </svg>
        </button></a>
