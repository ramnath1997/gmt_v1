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
    $otp="";
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

$t=$c='0';
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
				$sql="SELECT staff_id FROM table_staff_details WHERE staff_id='$w'";
				$result=mysql_query($sql) or die (mysql_error());
				 $count=mysql_num_rows($result);
				if($count==1)
				{
					$c='1';
				
		
						if(isset($_POST['staff_id'])){
							if(trim($_POST['staff_id'])){
											
								$w=$_POST['staff_id'];
								$sql="SELECT staff_id FROM table_staff_details WHERE staff_id='$w' AND staff_dept='$staff_dept' AND type='1'";
								$result=mysql_query($sql) or die (mysql_error());
				 				$count=mysql_num_rows($result);
				 				 $rnd=round(microtime(true));
				 				$otp=substr($rnd, 6);
								
                    				mysql_query("UPDATE table_staff_details SET `key`='$otp' WHERE staff_id='$w'");

					
	
							}
						}
					}
				$_POST['staff_id']=$_POST['staff_id']=$_POST['staff_dept']=$_POST['staff_password']="";
			}
			}
		}
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Staff Registration Portal</title>
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
            <h1>Staff Registration</h1>
            <div class="mainw3-agileinfo">
                <?php echo "<p style='font-size: 1em;
    color: #fff;'>".$echo_user."<p>"; ?>
                <!-- login form -->
                <div class="login-form">  
                    <div class="login-agileits-top">    
<form name="staff_reg" method="POST">
<center>


<table >
								<tr>
								<td>
									</td>
									<td>
										<b><p>Department	:</p>				
											</b>
										
									</td>
									
									<td>
										<input type="text"  value="<?php echo $dept; ?>" readonly/>
										<input type="hidden" name="staff_reg"   value="yes" />
									</td>
									</tr>
									<tr>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
									<td>
										<b><p>Staff Name :</p>						
											</b>
										
									</td>
									<td>
										<select  name='staff_id' required>
											<option selected>Select Staff</option>
		<?php
											$staff_list_q=mysql_query("SELECT staff_name,staff_id FROM table_staff_details WHERE staff_dept='$staff_dept' AND type='1'");
	
											while($result=mysql_fetch_array($staff_list_q))
											{
												echo"<option value='".$result['staff_id']."'>".$result['staff_name']."</option>";
											}
?>
									</td>

								</tr>
								<tr>
									<td>

								<tr>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
									</tr>
									</table></center>
									<center><input type="submit" value="Generate OTP"></center>
									</form><br>
									<center><p>OTP : <?php echo $otp;?> </p></center>
									<a href="hp_select.php"><button style="width:70px ">Back</button></a>

<a href="logout.php"><button style="width:100px ">Logout</button></a>
