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

<center>

										<input type="hidden" name="student_reg"   value="yes" />
										<p>Student Name<p>
										<input type="text" name="student_name"  placeholder="Student Name" value="" />
									<p>Student Regno<p>
									
										<input type="text" name="student_regno"  placeholder="Student Regno" value="" />
									<p>Student Degree<p>
										
										<select name="student_degree" onchange="getCourse(this.value)"" style="width:100%; min-height:40px">
											<option value="0">Select Degree</option>
											<?php

												$degree_query=mysql_query("SELECT id_degree, value_degree FROM table_degree ORDER BY id_degree");
												while($row=mysql_fetch_array($degree_query))
												{
													echo"<option value='".$row['id_degree']."'>".$row['value_degree']."</option>";
												}
												?>
										</select>
										
									<p>Student Course</p>
										
										<select id="Course" name='student_course' onchange='getBranch(this.value)' style="width:100%; min-height:40px" required>
											<option selected>Course</option>
										</select>
										 
									<p>Student Dept<p>
										
										<select id="Branch" name='student_dept'  style="width:100%; min-height:40px" required>
											<option selected>Branch</option>
										</select>
										
									<p>Student Sem<p>
										<select name="student_sem" style="width:100%; min-height:40px">
											<option value="0">Select Semester</option>
											<?php

												$sem_query=mysql_query("SELECT id_sem, value_sem FROM table_semester ORDER BY id_sem");
												while($row=mysql_fetch_array($sem_query))
												{
													echo"<option value='".$row['id_sem']."'>".$row['value_sem']."</option>";
												}
												?>
										</select>
										<p>Student Section<p>
										<select name="s_section" style="width:100%; min-height:40px">
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
										
									
										<input type="hidden" name="student_password"   value="12345678"/>
									
									<center> <input input type="submit" value="Enter"></center>
									</form>
									<a href="hp_select.php"><button style="width:70px ">Back</button></a>

<a href="logout.php"><button style="width:100px ">Logout</button></a>
<?php
include("./Config.php");
if ($_SERVER["REQUEST_METHOD"] == "POST" )
	{
		if(isset($_POST['student_reg']))
		{
			if(trim($_POST['student_reg'])=="yes")
			{
				$w=$_POST['student_regno'];
				 $l=strlen($w);
				if($l=="12"){
				 	$student_reg_c=substr($w, 4, 12);
					$sql="SELECT student_regno FROM table_student_details WHERE student_regno='$student_reg_c'";
					$result=mysql_query($sql) or die (mysql_error());
					$count=mysql_num_rows($result);
					if($count>=1)
					{
						echo "Regno already Used";
					}
					else {
		
							if(isset($_POST['student_regno']) AND isset($_POST['student_name']) AND isset($_POST['student_degree']) AND isset($_POST['student_course']) AND isset($_POST['student_dept']) AND isset($_POST['student_sem']) ){
								if(trim($_POST['student_regno']) AND trim($_POST['student_name']) AND trim($_POST['student_degree']) AND trim($_POST['student_course']) AND trim($_POST['student_dept']) AND trim($_POST['student_sem']) ){

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
				
								mysql_query("INSERT INTO table_student_details (student_regno) VALUES ({$student_reg_c}) ");		
		
								if(isset($_POST['student_name'])){
									mysql_query("UPDATE table_student_details SET student_name='{$_POST['student_name']}' WHERE student_regno='".$student_reg_c."' ");
								}
								if(isset($_POST['student_degree'])){
									mysql_query("UPDATE table_student_details SET student_degree={$_POST['student_degree']} WHERE student_regno='".$student_reg_c."' ");		
								}
								if(isset($_POST['student_course'])){
									mysql_query("UPDATE table_student_details SET student_course={$_POST['student_course']} WHERE student_regno='".$student_reg_c."' ");		
								}
								if(isset($_POST['student_dept'])){
									mysql_query("UPDATE table_student_details SET student_dept={$_POST['student_dept']} WHERE student_regno='".$student_reg_c."' ");		
								}
								if(isset($_POST['student_sem'])){
									mysql_query("UPDATE table_student_details SET student_sem={$_POST['student_sem']} WHERE student_regno='".$student_reg_c."' ");		
								}
								if(isset($_POST['student_password'])){
									mysql_query("UPDATE table_student_details SET student_password={$_POST['student_password']} WHERE student_regno='".$student_reg_c."' ");
								}
								if(isset($s_deg) AND isset($s_cou) AND isset ($s_dep) AND isset($s_sem) AND $s_dep_code!="" AND isset($s_section))
								{	
									
									$st_code="D".$s_deg."C".$s_cou."B".$s_dep_code."S".$s_sem.$s_section;
									mysql_query("UPDATE table_student_details SET st_code='{$st_code}' WHERE student_regno='".$student_reg_c."'");
									echo "Registered Successfully";
								}
							}
							}
						}
					$_POST['student_regno']=$_POST['student_name']=$_POST['student_degree']=$_POST['student_course']=$_POST['student_dept']=$_POST['student_sem']=$_POST['s_section']=$_POST['student_password']=$w=$student_reg_c="";
				}
			}
		}
	}
?>