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
	if (isset($_SESSION['st_code_staff'])) {
		unset($_SESSION['st_code_staff']);
	}
	$staff_id=$_SESSION['staff_id'];
	
	/*while ( $i<= 10) {
		echo '<input type="text" name="n'.$i.'" value="" > ';
		$i=$i+1;
	}*/
	include("./Config.php");
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
						if( isset($_POST['student_course']) AND isset($_POST['student_dept']) AND isset($_POST['student_sem']) ){
								if( trim($_POST['student_course'])!="0" AND trim($_POST['student_dept'])!="0" AND trim($_POST['student_sem'])!="0" ){
								include("./st_code_generator.php");
									
									if(isset($s_deg) AND isset($s_cou) AND isset ($s_dep) AND isset($s_sem) AND $s_dep_code!="" AND isset($s_section) AND isset($s_year))
								{	
									
									echo $st_code=$s_year."D".$s_deg."C".$s_cou."B".$s_dep_code.$s_section."S".$s_sem;
									$_SESSION['st_code']=$st_code;

									 header("location: ho_index.php");
								}}}
			}
		}
	}
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
    color: #fff;'>".$echo_user."<p>"; ?>
                <!-- login form -->
                <div class="login-form">  
                    <div class="login-agileits-top">
<form method="post">

										<input type="hidden" name="staff_select" value='1'>
										
									<p>Student Course<p>
										<select id="Course_staff_select" name='student_course' onchange='getBranchBG_s(this.value), getSem_staff_select(this.value)' required>
											<option selected>Select Course</option>
											<?php
											if($cr_group==1){
												$degree_query=mysql_query("SELECT id_course, value_course FROM table_course WHERE id_course=1 OR id_course=3 ORDER BY id_course");
												while($row=mysql_fetch_array($degree_query))
												{
													echo"<option value='".$row['id_course']."'>".$row['value_course']."</option>";
												}
											}
											if($cr_group==2){
												$degree_query=mysql_query("SELECT id_course, value_course FROM table_course WHERE id_course=2 OR id_course=3 ORDER BY id_course");
												while($row=mysql_fetch_array($degree_query))
												{
													echo"<option value='".$row['id_course']."'>".$row['value_course']."</option>";
												}
											}
												?>
										</select>
										 
									<p>Student Dept<p>
										
										<select id="BranchBG_s" name='student_dept'  required>
											<option selected>Branch</option>
										</select>
										
									<p>Student Sem<p>
										
										<select id="sem_staff_select" name="student_sem" ">
											<option Selected>Semester</option>
											
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
										<p>Select Batch (If Required)<p>
										<input type="number" name="student_year" min="2010" max="2099" step="1" value="" placeholder="Eg. 2014" />
										
									 <input input type="submit" value="Enter"></center>
									</form>
									<a href="hp_select.php"><button style="width:70px ">Back</button></a>

<a href="logout.php"><button style="width:100px ">Logout</button></a>