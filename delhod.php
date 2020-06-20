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
$degree_query=mysql_query("SELECT  value_branch FROM table_branch ");
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

		if(isset($_POST['staff_reg']))
		{
			if(trim($_POST['staff_reg'])=="yes")
			{
				if(isset($_POST['staff_id'])){
				$w=$_POST['staff_id'];
				$sql="SELECT staff_id FROM table_staff_details WHERE staff_id='$w' AND type='2'";
				$result=mysql_query($sql) or die (mysql_error());
				 $count=mysql_num_rows($result);
				if($count==1)
				{
					$c='1';
					mysql_query("DELETE  FROM `table_staff_details` WHERE staff_id='$w'  AND type='2'");

				}
					}
				$_POST['staff_id']=$_POST['staff_id']=$_POST['staff_dept']=$_POST['staff_password']="";
			}
			}
		}
	
?>
<!DOCTYPE html>
<html>
    <head>
        <title>HOD Removal Portal</title>
        <script type="application/x-javascript">
            addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }
        </script>
        <!-- Custom Theme files -->
        <link href="css/style_ha.css" rel="stylesheet" type="text/css" media="all" />
        <link href="css/font-awesome.css" rel="stylesheet">     <!-- font-awesome icons -->
        <!-- //Custom Theme files -->
        <!-- web font -->
        <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'><!--web font-->
        <!-- //web font -->
    </head>
    <body>
        <!-- main -->
        <div class="main-agileits">
            <h1>HOD Removal Form</h1>
            <div class="mainw3-agileinfo">
                <?php echo "<p style='font-size: 1em;
    color: #fff;'>".$echo_user."<p>"; ?>
                <!-- login form -->
                <div class="login-form">  
                    <div class="login-agileits-top"> 
<form name="staff_reg" method="POST">



										<input type="hidden" name="staff_reg"   value="yes" />
									<p>HOD ID						
											<p>
									
										<input type="text" name="staff_id"  placeholder="Enter HOD ID" value="" />
									
									<input  type="submit" value="Remove">
									</form>
									<a href="hodacc.php"><button style="width:70px ">Back</button></a>

<a href="logout.php"><button style="width:100px ">Logout</button></a>
<?php
if($count=='0')
	echo "<p>No Records<p>";
if($c=='1')
				{
					echo "<p>Removed Successfully<p>";
					
				}
?>