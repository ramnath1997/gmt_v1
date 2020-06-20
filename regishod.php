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
				if(isset($_POST['hod_dept'])){
					if(trim($_POST['hod_dept']!=0)){
				if(isset($_POST['staff_id'])){
				$w=$_POST['staff_id'];
				$sql="SELECT staff_id FROM table_staff_details WHERE staff_id='$w'";
				$result=mysql_query($sql) or die (mysql_error());
				 $count=mysql_num_rows($result);
				if($count==1)
				{
					$c='1';
				}
				else {
		
						if(isset($_POST['staff_id'])){
							if(trim($_POST['staff_id'])){
								
							 	mysql_query("INSERT INTO table_staff_details (staff_id) VALUES ('{$_POST['staff_id']}') ");
		
								if(isset($_POST['staff_name'])){
									mysql_query("UPDATE table_staff_details SET staff_name='{$_POST['staff_name']}' WHERE staff_id='".$_POST['staff_id']."' ");
								}
								if(isset($_POST['hod_dept'])){
									mysql_query("UPDATE table_staff_details SET staff_dept={$_POST['hod_dept']} WHERE staff_id='".$_POST['staff_id']."' ");		
								}
								if(isset($_POST['staff_password'])){
									mysql_query("UPDATE table_staff_details SET staff_password={$_POST['staff_password']} WHERE staff_id='".$_POST['staff_id']."' ");
								}
								if(isset($_POST['staff_password'])){
									mysql_query("UPDATE table_staff_details SET type='2' WHERE staff_id='".$_POST['staff_id']."' ");
								}
								$t='1';
							}
						}
					}
				$_POST['staff_id']=$_POST['staff_id']=$_POST['staff_dept']=$_POST['staff_password']="";
			}
		}
		}
			}
		}
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>HOD Registration Portal</title>
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
            <h1>HOD Registration</h1>
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
										<b><p>Department</p>				
											</b>
										
									</td>
									
									<td>
										<select name="hod_dept" style="width:100%; min-height:40px">
											<option value="0">Select Dept</option>
											<?php

												$degree_query=mysql_query("SELECT id_branch, value_branch FROM table_branch ORDER BY id_branch");
												while($row=mysql_fetch_array($degree_query))
												{
													echo"<option value='".$row['id_branch']."'>".$row['value_branch']."</option>";
												}
												?>
										</select>
										<input type="hidden" name="staff_reg"   value="yes" />
									</td>
									</tr>
									<tr>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
									<td>
										<b><p>Staff Name</p>						
											</b>
										
									</td>
									<td>
										<input type="text" name="staff_name"  placeholder="Staff Name" value="" />
									</td>
								</tr>
								<tr>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td>
										<b><p>Staff ID</p>					
											</b>
									</td>
									<td>
									
										<input type="text" name="staff_id"  placeholder="Staff ID" value="" />
									</td>
									</tr>
									<tr>
									<td>
										<b>					
											</b>
									</td>
									<td>
										<input type="hidden" name="staff_password"   value="12345678"/>
									</td>
									</tr>
									</table></center>
									<center><input type="submit" value="Enter"></center>
									</form>
									<a href="hodacc.php"><button style="width:70px ">Back</button></a>

<a href="logout.php"><button style="width:100px ">Logout</button></a>
<?php
if($t=='1')
	echo "<p>Registered Successfully<p>";
if($count==1)
				{
					echo "<p>ID already Used<p>";
				}
?>