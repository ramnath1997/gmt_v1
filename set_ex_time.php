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
$count="";$hjk=0;
if ($_SERVER["REQUEST_METHOD"] == "POST" )
	{

		if(isset($_POST['staff_reg']))
		{
			if(trim($_POST['staff_reg'])=="yes")
			{
				if(isset($_POST['ex_hr'])){
							if(trim($_POST['ex_hr']!=0)){
								if(isset($_POST['ex_min'])){
									if(isset($_POST['exh_hr'])){
							if(trim($_POST['exh_hr']!=0)){
								if(isset($_POST['exh_min'])){
									 if(strlen($_POST['ex_min'])==1){
                        				$_POST['ex_min']="0".$_POST['ex_min'];
                      				}
                      				 if(strlen($_POST['exh_min'])==1){
                        				$_POST['exh_min']="0".$_POST['exh_min'];
                      				}
									
									echo $mnv=$_POST['ex_hr'].$_POST['ex_min'];
									echo $mxv=$_POST['exh_hr'].$_POST['exh_min'];
									if($mnv>$mxv){
										echo $hjk=1;
									}
									}
								}
							}
						}
					}
				}

									if($hjk==0){
					
						if(isset($_POST['ex_hr'])){
							if(trim($_POST['ex_hr']!=0)){
								
							 	mysql_query("UPDATE ac_time SET ac_hr='{$_POST['ex_hr']}' WHERE ddffcc='345'");
								$t='1';
							}
						}
						if(isset($_POST['ex_min'])){
							
							 	mysql_query("UPDATE ac_time SET ac_mn='{$_POST['ex_min']}' WHERE ddffcc='345'");
								$t='1';
						}
						if(isset($_POST['exh_hr'])){
							if(trim($_POST['exh_hr']!=0)){
								
							 	mysql_query("UPDATE ac_time SET ac_hrh='{$_POST['exh_hr']}' WHERE ddffcc='345'");
								$t='1';
							}
						}
						if(isset($_POST['exh_min'])){
							
								
							 	mysql_query("UPDATE ac_time SET ac_mnh='{$_POST['exh_min']}' WHERE ddffcc='345'");
								$t='1';
							
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

<?php
$staff_ex_dt=mysql_query("SELECT * FROM ac_time WHERE ddffcc='345' ");
	
											while($result=mysql_fetch_array($staff_ex_dt))
											{
												 $hr=$result['ac_hr']; $mn=$result['ac_mn'];
												 $hrh=$result['ac_hrh']; $mnh=$result['ac_mnh'];
											}
?>

<center>
<table >
								<p>From</p>
								<tr>
								<td>
									</td>
									<td>
										<b><p>Hour</p>				
											</b>
										
									</td>
									
									<td>
											<input type="number" name="ex_hr" max="9" min="1"  value="<?php echo $hr; ?>" placeholder="HH" style="width:100%; min-height:40px"/>
										<input type="hidden" name="staff_reg"   value="yes" />
									</td>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
									<td>
										<b><p>Minute</p>				
											</b>
										
									</td>
									
									<td>
											<input type="number" name="ex_min" max="60" min="0"  value="<?php echo $mn; ?>" placeholder="MM" style="width:100%; min-height:40px"/>
									
									</td>
									</tr>
								</table><table>
									<p>TO</p>
									<tr>
								<td>
									</td>
									<td>
										<b><p>Hour</p>				
											</b>
										
									</td>
									
									<td>
											<input type="number" name="exh_hr" max="9" min="1"  value="<?php echo $hrh; ?>" placeholder="HH" style="width:100%; min-height:40px"/>
										<input type="hidden" name="staff_reg"   value="yes" />
									</td>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
									<td>
										<b><p>Minute</p>				
											</b>
										
									</td>
									
									<td>
											<input type="number" name="exh_min" max="60" min="0"  value="<?php echo $mnh; ?>" placeholder="MM" style="width:100%; min-height:40px"/>
									
									</td>
									</tr>

									
									</table></center>
									<center><input type="submit" value="Enter"></center>
									</form>
									<a href="princi_date_pending.php"><button style="width:70px ">Back</button></a>

<a href="logout.php"><button style="width:100px ">Logout</button></a>
<?php
if($hjk=='1')
	echo "<p>Check The Time<p>";
if($count==1)
				{
					echo "<p>ID already Used<p>";
				}
?>