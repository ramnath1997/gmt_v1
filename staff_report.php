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
    $maamnotify=0;
    $staff_id=$_SESSION['staff_id'];
    
    /*while ( $i<= 10) {
        echo '<input type="text" name="n'.$i.'" value="" > ';
        $i=$i+1;
    }*/
    include("./Config.php");
    $get_staff_id_name=mysql_query("SELECT staff_name,staff_dept FROM table_staff_details WHERE staff_id='$staff_id'");
while($row=mysql_fetch_array($get_staff_id_name))
{
    $staff_id_name=$row['staff_name'];
    $staff_dept=$row['staff_dept'];
}
    $_SESSION['staff_dept']=$staff_dept;

    $echo_user="Hi ".$staff_id_name."...<br>";

    ?>
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" )
    {

            if(isset($_POST['date']))
        {
            if(trim($_POST['date'])!='')
        {   
            $s_id=$_POST['date'];
            $get_maam_id_name=mysql_query("SELECT staff_name, staff_dept FROM table_staff_details WHERE staff_id='$s_id'");
            $ismaamexist=mysql_num_rows($get_maam_id_name);
            if($ismaamexist=="")
            {
                $maamnotify=1;
                
            }else
            {
            $_SESSION['s_id']=$_POST['date'];

            header('location: staff_report_panel.php');
        }}}}?>

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

                
     
                <!-- login form -->
                <div class="login-form" style="background: black;opacity:0.8;">  
                    <div class="login-agileits-top"  style="opacity:1;">
                    <form method="POST">
<p>Enter Staff ID<p>
                                        <input type="text" name="date"  value=""  />
                                        
                                     <input input type="submit" name="mark" value="Generate Report">
                                    <?php 

                                        if ($maamnotify==1) {
                                            
                                        echo "<p>Staff id is Incorrect..<p>";
                                        } ?>
                                    </form>

                    </div><a href="princi_ind.php"><button style="width:70px ">Back</button></a>

<a href="logout.php"><button style="width:100px ">Logout</button></a></div>
                    </div>
                    </div></body></html>