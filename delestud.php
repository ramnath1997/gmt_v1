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

    $staff_dept=$_SESSION['staff_dept'];
$degree_query=mysql_query("SELECT  value_branch FROM table_branch WHERE id_branch='$staff_dept' ");
while($row=mysql_fetch_array($degree_query))
{
$dept=$row['value_branch'];
}

$c='0';
?>
<?php
$count="";
if ($_SERVER["REQUEST_METHOD"] == "POST" )
	{

		if(isset($_POST['revoke']))
		{
			if(trim($_POST['revoke'])=="Revoke")
			{
				if(isset($_POST['student_regno'])){
				$w=$_POST['student_regno'];
                $w=substr($w, 4, 12);
				$sql="SELECT student_regno FROM table_student_details WHERE student_regno='$w' ";
				$result=mysql_query($sql) or die (mysql_error());
				 $count=mysql_num_rows($result);
				if($count==1)
				{
					$c='1';
                    mysql_query("UPDATE table_student_details SET access='1' WHERE student_regno='$w'");

				}
					}
				$_POST['student_regno']=$_POST['student_regno']="";
			}
			}
		
        if(isset($_POST['recall']))
        {
            if(trim($_POST['recall'])=="Recall")
            {
                if(isset($_POST['student_regno'])){
                $w=$_POST['student_regno'];
                $w=substr($w, 4, 12);
                 $sql="SELECT student_regno FROM table_student_details WHERE student_regno='$w' AND dept='$dept' ";
                $result=mysql_query($sql) or die (mysql_error());
                 $count=mysql_num_rows($result);
                if($count==1)
                {
                    $c='2';
                    mysql_query("UPDATE table_student_details SET access='0' WHERE student_regno='$w' AND dept='$dept'");

                }
                    }
                $_POST['student_regno']=$_POST['student_regno']="";
            }
            }
        if(isset($_POST['delete']))
        {
            if(trim($_POST['delete'])=="Delete Student Permanently")
            {
                if(isset($_POST['student_regno'])){
                $w=$_POST['student_regno'];
                $w=substr($w, 4, 12);
                 $sql="SELECT student_regno FROM table_student_details WHERE student_regno='$w' AND dept='$dept' ";
                $result=mysql_query($sql) or die (mysql_error());
                 $count=mysql_num_rows($result);
                if($count==1)
                {
                    $c='3';
                    mysql_query("DELETE FROM table_student_details WHERE student_regno='$w' AND dept='$dept'");

                }
                    }
                $_POST['student_regno']=$_POST['student_regno']="";
            }
            }
        }
	
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Staff Removal Portal</title>
        <script type="application/x-javascript">
            addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }
        </script>
        <!-- Custom Theme files -->
        <link href="css/style_ha.css" rel="stylesheet" type="text/css" media="all" />
        <link href="css/font-awesome.css" rel="stylesheet">     <!-- font-awesome icons -->
        <!-- //Custom Theme files -->
        <!-- web font -->
       <!-- //web font -->
    </head>
    <body>
        <!-- main -->
        <div class="main-agileits">
            <h1>Student Removal Form</h1>
            <div class="mainw3-agileinfo">
                <?php echo "<p style='font-size: 1em;
    color: #fff;'>".$echo_user."<p>"; ?>
                <!-- login form -->
                <div class="login-form">  
                    <div class="login-agileits-top"> 
<form name="staff_reg" method="POST">



<p>Department	:<p>
										<input type="text"  value="<?php echo $dept; ?>" readonly/>
										<input type="hidden" name="staff_reg"   value="yes" />
									<p>Student Reg.No.						
											<p>
									
										<input type="text" name="student_regno"  placeholder="Student Register No." value="" />
									
									<input  type="submit" name="revoke" style="width:49% " value="Revoke">
                                    <input  type="submit" name="recall" style="width:49% " value="Recall">
                                    <input  type="submit" name="delete" style="width:100% " value="Delete Student Permanently">
									</form>
									<a href="registerportal.php"><button style="width:70px ">Back</button></a>

<a href="logout.php"><button style="width:100px ">Logout</button></a>
<?php
if($count=='0')
	echo "<p><br>No Records<p>";
if($c=='1')
				{
					echo "<p><br>Student Disabled Successfully<p>";
					
				}
if($c=='2')
                {
                    echo "<p><br>Student Enabled Successfully<p>";
                    
                }
                if($c=='3')
                {
                    echo "<p><br>Student Deleted Successfully<p>";
                    
                }
?>