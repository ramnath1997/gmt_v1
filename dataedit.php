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
													$br_group=$row['id_group'];$cr_group=$row['id_course'];
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
<form name="student_reg" method="POST">

										<input type="hidden" name="student_reg"   value="yes" />
										<p>Select Batch<p>
										<input type="number" name="student_year" min="2010" max="2099" step="1" value="<?php echo $year; ?>" />
									<p>Student Course<p>
										<select id="Course_staff_select" name='student_course' onchange='getBranchBG(this.value), getSem(this.value)' required>
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
										
										<select id="BranchBG" name='student_dept'  style="width:100%; min-height:40px" required>
											<option selected>Branch</option>
										</select>
										
									<p>Student Sem<p>
										<select id="sem" name="student_sem" style="width:100%; min-height:40px">
											<option selected>Semester</option>
											
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

										
									<input type="submit" name="asd" value="Enter"/>
									
									</form>
									<a href="registerportal.php"><button style="width:70px ">Back</button></a>

<a href="logout.php"><button style="width:100px ">Logout</button></a>
<?php
include("./Config.php");
if ($_SERVER["REQUEST_METHOD"] == "POST" )
	{
		if(isset($_POST['student_reg']))
		{
			if(trim($_POST['student_reg'])=="yes")
			{

							if( isset($_POST['student_year'])  AND isset($_POST['student_course']) AND isset($_POST['student_dept']) AND isset($_POST['student_sem']) ){
								if( trim($_POST['student_year'])!=""  AND trim($_POST['student_course'])!="0" AND trim($_POST['student_dept'])!="0" AND trim($_POST['student_sem'])!="0" ){
									$s_year=$_POST['student_year'];
									$s_year=substr($s_year, 2);
									$s_deg="";
									$s_cou=$_POST['student_course'];
									$s_dep=$_POST['student_dept'];
									$s_dep_code="";
									$dep_name=mysql_query("SELECT `code_branch` FROM `table_branch` WHERE `id_branch`= '$s_dep'");
									while($row=mysql_fetch_array($dep_name))
									{
		 								$s_dep_code=$row['code_branch'];
									}
									$deg_name=mysql_query("SELECT `id_degree` FROM `table_course` WHERE `id_course`= '$s_cou'");
									while($row=mysql_fetch_array($deg_name))
									{
		 								$s_deg=$row['id_degree'];
									}
									$s_sem=$_POST['student_sem'];
									$s_section=$_POST['s_section'];
									$reg_yr='';

									if($s_sem==1){
										$reg_yr=$year;
									}
									if($s_sem==3){
										$reg_yr=$year-1;
									}
									if($s_sem==5){
										$reg_yr=$year-2;
									}
									if($s_sem==7){
										$reg_yr=$year-3;
									}
									if($s_sem==2){
									if($month>7){
										$reg_yr=$year;
									}
									else {
										$reg_yr=$year-1;
									}
									}
									if($s_sem==4){
									if($month>7){
										$reg_yr=$year-1;
									}
									else {
										$reg_yr=$year-2;
									}
									}
									if($s_sem==6){
									if($month>7){
										$reg_yr=$year-2;
									}
									else {
										$reg_yr=$year-3;
									}
									}
									if($s_sem==8){
									if($month>7){
										$reg_yr=$year-3;
									}
									else {
										$reg_yr=$year-4;
									}
									}
									echo $reg_yr;
									$reg_yr=substr($reg_yr, 2);
									if($reg_yr!=$s_year){
										echo "Check Year and Semester";
									}else{

								if(isset($s_deg) AND isset($s_cou) AND isset ($s_dep) AND isset($s_sem) AND $s_dep_code!="" AND isset($s_section) AND isset($s_year))
								{	
									
									echo $st_code=$s_year."D".$s_deg."C".$s_cou."B".$s_dep_code.$s_section."S".$s_sem;
									$_SESSION['st_code']=$st_code;
									
									header("location: dynamicedit.php");
									
								}
							}
							
							
						
					
				}
			}
		}
	}
}
?>