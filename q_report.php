<?php
include("./Config.php");
?>
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
	if (isset($_SESSION['st_code_staff'])) {
		unset($_SESSION['st_code_staff']);
	}
	$staff_id=$_SESSION['staff_id'];
	
	/*while ( $i<= 10) {
		echo '<input type="text" name="n'.$i.'" value="" > ';
		$i=$i+1;
	}*/
	include("./Config.php");
	$get_staff_id_name=mysql_query("SELECT staff_name,staff_dept FROM table_staff_details WHERE staff_id='$staff_id'");
while($row=mysql_fetch_array($get_staff_id_name))
{
	$staff_id_name=$row['staff_name'];
	$staff_dept=$row['staff_dept'];
}
?>
<?php
$tz_object = new DateTimeZone('Asia/Kolkata');
    //date_default_timezone_set('Brazil/East');

    $datetime = new DateTime();
    $datetime->setTimezone($tz_object);
    $year_get=$datetime->format('Y\-m\-d\ h:i:s');
    $year=substr($year_get, 0,4);
    $month=substr($year_get, 5,2);
    ?>
    <?php
    $br_group="";
    $br_query=mysql_query("SELECT id_group,id_course FROM table_branch WHERE id_branch='$staff_dept'");
												while($row=mysql_fetch_array($br_query))
												{
													$br_group=$row['id_group']; $cr_group=$row['id_course'];
												}
												?>
<?php

	$echo_user="Hi ".$staff_id_name."...";
if ($_SERVER["REQUEST_METHOD"] == "POST" )
	{
		if(isset($_POST['staff_select']))
		{
			if(trim($_POST['staff_select'])=="1")
			{						
						if( isset($_POST['dept']) ){
								if( trim($_POST['dept'])!="0" ){
									if(isset($_POST['date']))
        {
            if(trim($_POST['date'])!='')
        { 
            $_SESSION['gmt_date']=$_POST['date'];
								
									echo $_SESSION['dept']=$_POST['dept'];

									 header("location: princi_q_view_b.php");
									}}
								}
							}
			}
		}
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>GMT Bulk Report Questions Portal</title>
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
            <h1>GMT Bulk Report Questions Form</h1>
            <div class="mainw3-agileinfo">
                <?php echo "<p style='font-size: 1em;
    color: #fff;'>".$echo_user."<p>"; ?>
                <!-- login form -->
                <div class="login-form">  
                    <div class="login-agileits-top">
<form method="post">

										<input type="hidden" name="staff_select" value='1'>
										<p>Select Date<p>
                                        <input type="date" name="date"  value=""  />
									<p>Department<p>
										<select name='dept' required>
											<option selected>Select Dept</option>
											<?php
											
												$sql="SELECT id_branch, value_branch FROM table_branch WHERE id_course = '1' OR id_course = '2' ";
												$result = mysql_query($sql);
												while($row = mysql_fetch_array($result)) {
    												echo "<option value='".$row['id_branch']."'>".$row['value_branch']."</option>";
												}
											
												?>
										</select>
										 	
									 <input input type="submit" value="Enter"></center>
									</form>
									<a href="princi_gmt.php"><button style="width:70px ">Back</button></a>

<a href="logout.php"><button style="width:100px ">Logout</button></a>