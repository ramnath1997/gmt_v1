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
$staff_id=$_SESSION['staff_id'];
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
echo $st_code_staff=$_SESSION['st_code'];
$get_staff_id_name=mysql_query("SELECT staff_name,staff_dept FROM table_staff_details WHERE staff_id='$staff_id'");
while($row=mysql_fetch_array($get_staff_id_name))
{
	$staff_id_name=$row['staff_name'];
	$staff_dept=$row['staff_dept'];
}

	  $echo_user="Hi ".$staff_id_name."...";
  
  $echo_stc=$echo_sub="";
  include("./headerselection.php");
  $staff_reg_id=$_SESSION['staff_reg_id'];
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
$subject_no=mysql_query("SELECT `subject_title` FROM `table_subject` WHERE `st_code` = '$st_code_staff'");
											echo $cn=mysql_num_rows($subject_no);	
if ($_SERVER["REQUEST_METHOD"] == "POST" )
	{
		if(isset($_POST['mark_entry']))
		{
					$j=1;
				while($j<=$cn){
					if(isset($_POST['sub'.$j.''])){
						$s1=mysql_query("SELECT * FROM table_staff_access WHERE staff_id='$staff_reg_id' AND st_code='$st_code_staff' AND sub_acc='".$_POST['sub'.$j.'']."' ");		
						$ss=mysql_num_rows($s1);
										if($ss!=1){
						mysql_query("INSERT INTO table_staff_access(staff_id, st_code, sub_acc) VALUES('".$staff_reg_id."','$st_code_staff','".$_POST['sub'.$j.'']."' ) ");	
						}	
					}
					if(!isset($_POST['sub'.$j.''])){
						$s1=mysql_query("SELECT * FROM table_staff_access WHERE staff_id='$staff_reg_id' AND st_code='$st_code_staff' AND sub_acc='".$j."' ");		
						$ss=mysql_num_rows($s1);
										if($ss==1){
						mysql_query("DELETE FROM table_staff_access WHERE staff_id='{$staff_reg_id}' AND st_code='{$st_code_staff}' AND sub_acc='".$j."' ");	
						}	
					}
					$j++;
					
				}
						
					
		}
	}
	
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Staff - Subject Allocation Portal</title>
        <script type="application/x-javascript">
            addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }
        </script>
        <!-- Custom Theme files -->
        <link href="css/style_ha.css" rel="stylesheet" type="text/css" media="all" />
        <script src='js/dropdown_codes.js' type='text/javascript'></script>
        <link href="css/font-awesome.css" rel="stylesheet">     <!-- font-awesome icons -->
        <!-- //Custom Theme files -->
        <!-- web font -->
       <!-- //web font -->
    </head>
    <body>
        <!-- main -->
        <div class="main-agileits">
            <h1>Staff - Subject Allocation</h1>
            <div class="mainw3-agileinfo">
                <?php echo "<p style='font-size: 1em;
    color: #fff;'>".$echo_user."<p>"; ?>
                <!-- login form -->
                <div class="login-form">  
                    <div class="login-agileits-top">
                    	<center>
                    		<form method="POST">

<table><tr>
	<td ><p >Staff ID:
		<?php
											echo $staff_reg_id;
									
?>

	</p>	</td></tr><tr>
	<td ><p > </p></td></tr>
	<?php 
	$i=1;
	while ( $i<= $cn) {
	?>			
									<tr><td>
										<?php 
											
											$subject_name_chk=mysql_query("SELECT * FROM `table_staff_access` WHERE staff_id='$staff_reg_id' AND `st_code` = '$st_code_staff' AND sub_acc='$i'");
											 $sp=mysql_num_rows($subject_name_chk);
										if($sp==1){
										  ?>
										
									<p><input type="checkbox" name="sub<?php echo $i; ?>" value="<?php echo $i; ?>" checked>
										<?php }
										else { ?>
											<p><input type="checkbox" name="sub<?php echo $i; ?>" value="<?php echo $i; ?>" >
									<?php 
											}
											$subject_name1_z=mysql_query("SELECT `subject_title` FROM `table_subject` WHERE `st_code` = '$st_code_staff' AND id_subject='$i'");
											while($result=mysql_fetch_array($subject_name1_z)){
											$subject_name1_y= $result['subject_title'];
												 echo $subject_name1_y;
										
										 }  ?></p>
									</td></tr>
									<?php
									$i++;

									 } ?>

									</table></center>
<input class="login__submit_qsn_mark" type="submit" name="mark_entry" >
</form>
<a href="sub_staff.php"><button style="width:70px ">Back</button></a>
	<a href="hp_select.php"><button style="width:100px ">Home</button></a>

<a href="logout.php"><button style="width:100px ">Logout</button></a>

