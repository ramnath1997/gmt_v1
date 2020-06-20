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

  if (!isset($_SESSION['st_code'])) {
    echo "Class Not Selected :(<br>";
    echo "<a href='./staff_select.php'>Back to Select</a>";
    exit();
  }
    
    $hod_id=$_SESSION['staff_id'];
    $st_code_staff=$_SESSION['st_code'];
    
    /*while ( $i<= 10) {
        echo '<input type="text" name="n'.$i.'" value="" > ';
        $i=$i+1;
    }*/
    include("./Config.php");
    $get_staff_id_name=mysql_query("SELECT staff_name,staff_dept FROM table_staff_details WHERE staff_id='$hod_id'");
while($row=mysql_fetch_array($get_staff_id_name))
{
    $staff_id_name=$row['staff_name'];
    $staff_dept=$row['staff_dept'];
}
    $_SESSION['staff_dept']=$staff_dept;

    $echo_user="Hi ".$staff_id_name."... ";

	$echo_stc=$echo_sub="";
  include("./headerselection.php");
  ?>

<!DOCTYPE html>
<html>
    <head>
        <title>GMT Status Portal</title>
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
            <h1>GMT Status Form</h1>
            <div class="mainw3-agileinfo">
                <?php echo "<p style='font-size: 1em;
    color: #fff;'>".$echo_user."  ".$echo_stc."<p>"; ?>
                <!-- login form -->
                <div class="login-form">  
                    <div class="login-agileits-top">
	<form method="post" name="select_a_s">
	<p>View By Date:<p><input type="date" name="gmt_date" value="">
	<input type="submit" name="view_by_date" value='View By Date'>
	
										
										
										<select name="student_subject" >
											<option value="0">Select Subject</option>
											<?php

												$subject_query=mysql_query("SELECT id_subject, subject_title FROM table_subject WHERE st_code='{$st_code_staff}' AND subject_code!='' ORDER BY id_subject");
												while($row=mysql_fetch_array($subject_query))
												{
													echo"<option value='".$row['id_subject']."'>".$row['subject_title']."</option>";
												}
												?>
										</select>
										
									</tr>
	</td></table>

	<input type="submit" name="view_marks" value='View Overall Marks'>
	<p>GMT NO:<p><input type="text" name="gmt_no" value="">
	<input type="submit" name="view_qus" value='View Question'>
	<input type="submit" name="view_by_gmt" value='View By GMT'>
	<input type="submit" name="view_by_gmt_dm" value='View Subjects By GMT'>

<br>

	</form>
	<a href="princi_status.php"><button style="width:70px ">Back</button></a>
	<a href="princi_select.php"><button style="width:100px ">Home</button></a>

<a href="logout.php"><button style="width:100px ">Logout</button></a>



<?php 
	if ($_SERVER["REQUEST_METHOD"] == "POST" )
	{
		
		if(isset($_POST['view_by_date']))
		{	
			if(isset($_POST['gmt_date']))
			{
				if(trim($_POST['gmt_date'])!="")
				{
					$_SESSION['gmt_date']=$_POST['gmt_date'];
					header('location: princi_question_mark_by_date.php');
				}
			}
		}
		if(isset($_POST['view_qus']))
		{	
			if(isset($_POST['gmt_no']) && isset($_POST['student_subject']))
			{
				if(trim($_POST['gmt_no'])!="" && trim($_POST['student_subject'])!='0')
				{
					$_SESSION['gmt_no']=$_POST['gmt_no'];
					$_SESSION['student_subject']=$_POST['student_subject'];
					header('location: princi_questionget.php');
				}
			}
		}
		if(isset($_POST['view_marks']))
		{	
			if(isset($_POST['gmt_no']) && isset($_POST['student_subject']))
			{
				if(trim($_POST['student_subject'])!='0')
				{
					unset($_POST['gmt_no']);
					unset($_SESSION['gmt_no']);
					$_SESSION['student_subject']=$_POST['student_subject'];
					header('location: princi_mark_view.php');
				}
			}
		}
		if(isset($_POST['view_by_gmt']))
		{	
			if(isset($_POST['gmt_no']) && isset($_POST['student_subject']))
			{
				if(trim($_POST['gmt_no'])!="" && trim($_POST['student_subject'])!='0')
				{
					$_SESSION['gmt_no']=$_POST['gmt_no'];
					$_SESSION['student_subject']=$_POST['student_subject'];
					header('location: princi_mark_view_gmt.php');
				}
			}
			
		}
		if(isset($_POST['view_by_gmt_dm']))
		{	
			if(isset($_POST['gmt_no']))
			{
				if(trim($_POST['gmt_no'])!="" )
				{
					$_SESSION['gmt_no']=$_POST['gmt_no'];
					//$_SESSION['student_subject']=$_POST['student_subject'];
					header('location: princi_gmt_number_report.php');
				}
			}
			
		}
	}
	?>
		