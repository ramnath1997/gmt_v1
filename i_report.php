<?php
include("./Config.php");
?>
<?php
	session_start();
	if (!isset($_SESSION['staff_id']) || $_SESSION['staff_id']=="0") 
	{
		echo "Page Not Found :(<br>";
		include("./logout.php");
		echo "<a href='./logout.php'>Back to Home</a>";
		exit();
	}
	if (isset($_SESSION['st_code_staff'])) 
	{
		unset($_SESSION['st_code_staff']);
	}
	$staff_id=$_SESSION['staff_id'];
	include("./Config.php");
	$get_staff_id_name=mysql_query("SELECT staff_name FROM table_staff_details WHERE staff_id='$staff_id'");
	while($row=mysql_fetch_array($get_staff_id_name))
	{
		$staff_id_name=$row['staff_name'];
	}

	$echo_user="Hi ".$staff_id_name."...";
	if ($_SERVER["REQUEST_METHOD"] == "POST" )
    {


        if(isset($_POST['report']))
        {
        	if(trim($_POST['report'])=="1")
            {
            	$w=$_POST['id'];
            	echo $student_regno=substr($w, 4);
                $sql="SELECT student_regno FROM table_student_details WHERE student_regno='$student_regno'";
                $result=mysql_query($sql) or die (mysql_error());
                $count=mysql_num_rows($result);
                if($count=='0' or $count>'1')
                {
                    echo "<p>Invalid Username or Password<p>";
                }
                elseif($count == '1')
                {
                    while($row=mysql_fetch_array($result))
                    {
                        $student_regno =	addslashes($row['student_regno']);
                        $_SESSION['student_regno']=$student_regno;
                        header("location: reportpage.php");
                    }
            	}
            }
       	}
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Individual Report Portal</title>
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
            <h1>Individual Report Form</h1>
            <div class="mainw3-agileinfo">
                <?php echo "<p style='font-size: 1em;
    color: #fff;'>".$echo_user."<p>"; ?>
                <!-- login form -->
                <div class="login-form">  
                    <div class="login-agileits-top">
<form method="post">

										<input type="hidden" name="report" value='1'>
										<p>Enter Student Register Number<p>
									<p><input type="text" class="login__input name" placeholder="Student Register Number" name="id" pattern="[0-9]+" required/><p>
									 <input input type="submit" value="Get Report"></center>
									</form>
									<a href="princi_ind.php"><button style="width:70px ">Back</button></a>

<a href="logout.php"><button style="width:100px ">Logout</button></a>