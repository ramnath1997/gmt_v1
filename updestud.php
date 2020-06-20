<?php
session_start();
if (!isset($_SESSION['staff_id']) || $_SESSION['staff_id']=="0") {
        echo "Page Not Found :(<br>";
        include("./logout.php");
        echo "<a href='./logout.php'>Back to Home</a>";
        exit();
    }
    if (!isset($_SESSION['type']) || $_SESSION['type']!="2") {
        echo "Unauthorized Access :(<br>";
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
    
    $get_staff_id_name=mysql_query("SELECT staff_name,staff_dept FROM table_staff_details WHERE staff_id='$hod_id'");
while($row=mysql_fetch_array($get_staff_id_name))
{
    $staff_id_name=$row['staff_name'];
    $staff_dept=$row['staff_dept'];
}
    $_SESSION['staff_dept']=$staff_dept;

    $echo_user="Hi ".$staff_id_name."...<br>";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Student Updation Portal</title>
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
            <h1>Update Semester of the Students</h1>
            <div class="mainw3-agileinfo">
                <?php echo "<p style='font-size: 1em;
    color: #fff;'>".$echo_user."<p>"; ?>
                <!-- login form -->
                <div class="login-form">  
                    <div class="login-agileits-top">

<form name="student_update" method="POST">

<?php
$tz_object = new DateTimeZone('Asia/Kolkata');
    //date_default_timezone_set('Brazil/East');

    $datetime = new DateTime();
    $datetime->setTimezone($tz_object);
    $year_get=$datetime->format('Y\-m\-d\ h:i:s');
    $year=substr($year_get, 0,4);
    ?>
<p><Current<p>
				<input type="hidden" name="student_update"   value="yes" />
				<p>Select Batch<p>
										<input type="number" name="student_year" min="2010" max="2099" step="1" value="<?php echo $year; ?>" />
									
				<p>Student Degree<p>
										
										<select name="student_degree" onchange="getCourse_update(this.value) ">
											<option value="0">Select Degree</option>
											<?php

												$degree_query=mysql_query("SELECT id_degree, value_degree FROM table_degree ORDER BY id_degree");
												while($row=mysql_fetch_array($degree_query))
												{
													echo"<option value='".$row['id_degree']."'>".$row['value_degree']."</option>";
												}
												?>
										</select>
										
									<p>Student Course<p>
										
										<select id="Course_update" name='student_course' onchange='getBranch_update(this.value)' required>
											<option selected>Course</option>
										</select>
										 
									<p>Student Dept<p>
										
										<select id="Branch_update" name='student_dept'  required>
											<option selected>Branch</option>
										</select>
									<p>Student Section<p>
										<select name="s_section" style="width:100%; min-height:40px">
											<option value="A">-</option>
											<option value="A">A</option>
											<option value="B">B</option>
											<option value="C">C</option>
											<option value="D">D</option>
											<option value="E">E</option>
											<option value="F">F</option>
											<option value="G">G</option>
											<option value="H">H</option>
											<option value="I">I</option>
											<option value="J">J</option>
											<option value="K">K</option>
											<option value="L">L</option>
											<option value="M">M</option>
											<option value="N">N</option>
											<option value="O">O</option>
											
										</select>
									<p>Change Semester:<p>
									<p>From<p>
										
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
										
									<p>T0<p>
										
										<select name="to_sem" ">
											<option value="0">Select Semester</option>
											<?php

												$sem_query=mysql_query("SELECT id_sem, value_sem FROM table_semester ORDER BY id_sem");
												while($row=mysql_fetch_array($sem_query))
												{
													echo"<option value='".$row['id_sem']."'>".$row['value_sem']."</option>";
												}
												?>
										</select>
									 <input input type="submit" value="Enter"></center>
									</form>
									<a href="registerportal.php"><button style="width:70px ">Back</button></a>

<a href="logout.php"><button style="width:100px ">Logout</button></a>
<?php
include("./Config.php");
if ($_SERVER["REQUEST_METHOD"] == "POST" )
	{
		if(isset($_POST['student_update']))
		{
			if(trim($_POST['student_update'])=="yes")
			{
				
				//
				if( isset($_POST['student_year']) AND isset($_POST['student_degree']) AND isset($_POST['student_course']) AND isset($_POST['student_dept']) AND isset($_POST['student_sem']) ){
								if( trim($_POST['student_year']) AND trim($_POST['student_degree']) AND trim($_POST['student_course']) AND trim($_POST['student_dept']) AND trim($_POST['student_sem']) ){
									$s_year=$_POST['student_year'];
									$s_year=substr($s_year, 2);
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
									$s_section=$_POST['s_section'];
									$to_sem=$_POST['to_sem'];
									if(isset($s_deg) AND isset($s_cou) AND isset ($s_dep) AND isset($s_sem) AND isset($to_sem) AND $s_dep_code!="" AND isset($s_section) AND isset($s_year))
								{	
									
									$st_code=$s_year."D".$s_deg."C".$s_cou."B".$s_dep_code.$s_section."S".$s_sem;
									$to_st_code=$s_year."D".$s_deg."C".$s_cou."B".$s_dep_code.$s_section."S".$to_sem;

									mysql_query("UPDATE table_student_details SET st_code='{$to_st_code}' WHERE st_code='".$st_code."'");
									mysql_query("UPDATE class_advisor SET st_code='{$to_st_code}' WHERE st_code='".$st_code."'");
								}
				
								
								
							}
						}
					$_POST['student_regno']=$_POST['student_name']=$_POST['student_degree']=$_POST['student_course']=$_POST['student_dept']=$_POST['student_sem']=$_POST['student_password']=$w=$student_reg_c="";
				}
			}
		}
			
?>