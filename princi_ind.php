
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
    $staff_id=$_SESSION['staff_id'];
    
    /*while ( $i<= 10) {
        echo '<input type="text" name="n'.$i.'" value="" > ';
        $i=$i+1;
    }*/
    include("./Config.php");
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
    $_SESSION['staff_dept']=$staff_dept;

    $echo_user="Hi ".$staff_id_name."...<br>";

    ?>
    <!DOCTYPE html>
<html>
    <head>
        <title>Official Portal</title>
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
            <h1>Official Portal</h1>
            <div class="mainw3-agileinfo">
                <?php echo "<p style='font-size: 1em;
    color: #fff;'>".$echo_user."<p>"; ?>
                <!-- login form -->
                <div class="login-form">  
                    <div class="login-agileits-top">    
<a href="./i_report.php"><button>Student Report</button></a>
<a href="./staff_report.php"><button>Staff Report</button></a>
<a href="./princi_select.php"><button style="width:70px ">Back</button></a>

<a href="./logout.php"><button style="width:100px ">Logout</button></a>