
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
     include("./Config.php");
    $staff_id=$_SESSION['staff_id'];
    $s_id=$_SESSION['s_id'];
    //$s_id='srimathiec';
    $get_maam_id_name=mysql_query("SELECT staff_name, staff_dept FROM table_staff_details WHERE staff_id='$s_id'");
    while($row=mysql_fetch_array($get_maam_id_name))
    {
        $teacher_name=$row['staff_name'];
        $teacher_dept_id=$row['staff_dept'];
        $get_teacher_dept=mysql_query("SELECT id_branch, value_branch FROM table_branch WHERE id_group='$teacher_dept_id' and (id_course=1 or id_course=2) ");
        while($row=mysql_fetch_array($get_teacher_dept))
        {
            $teacher_dept=$row['value_branch'];
        }

    }
    $staff_dept=0;
    /*while ( $i<= 10) {
        echo '<input type="text" name="n'.$i.'" value="" > ';
        $i=$i+1;
    }*/
   
    $get_staff_id_name=mysql_query("SELECT staff_name,staff_dept FROM table_staff_details WHERE staff_id='$staff_id'");
    while($row=mysql_fetch_array($get_staff_id_name))
    {
        $staff_id_name=$row['staff_name'];
    }
    $_SESSION['staff_dept']=$staff_dept;
    $echo_user="Hi ".$staff_id_name."...<br>";
?>


<?php
    $count_st_code='1';
    $get_staff_classes=mysql_query("SELECT distinct st_code FROM table_staff_access WHERE staff_id='$s_id'");
    $count_get_staff_classes=mysql_num_rows($get_staff_classes);
    for($count_st_code=1; $count_st_code <= $count_get_staff_classes; $count_st_code++ )
    {
        while($row=mysql_fetch_array($get_staff_classes))
        {
            $st_code[$count_st_code]=$row['st_code'];
        }
    }
   
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
                <!-- login form -->
                <div class="login-form" style="background: black;opacity:0.8;">  
                    <div class="login-agileits-top"  style="opacity:1;">
                    <p><?php echo "Staff Name: ".$teacher_name; ?><p>
                    <p><?php echo "Staff ID: ".$s_id; ?><p>
                    <p><?php echo "Staff Department: ".$teacher_dept; ?><p>
                    <p><?php echo "Number of Classes Handling: ".$count_get_staff_classes; ?><p>
                    <?php
                    $gmt_tmp="";
                        $notice=0;
                        $subno=1;
                        
                        for($count_st_code=1; $count_st_code <= $count_get_staff_classes; $count_st_code++ )
                        {
                             $st_code_staff=$st_code[$count_st_code];
                            include("./headerselection.php");
                            echo "<p style='color: yellow;'>Staff Class ".$count_st_code.": ".$echo_stc."<p>";
                            echo "<p style='color: yellow;' >List of Students (if marks are not updated): <p>";

                            $access_query=mysql_query("SELECT sub_acc FROM table_staff_access WHERE st_code='{$st_code_staff}' AND staff_id='{$s_id}'");
                            while($row=mysql_fetch_array($access_query))
                            {
                                $sub_id=$row['sub_acc'];
                                $subject_query=mysql_query("SELECT id_subject, subject_title FROM table_subject WHERE st_code='{$st_code_staff}' AND id_subject='{$sub_id}' AND subject_code!='' ORDER BY id_subject");
                                while($rowi=mysql_fetch_array($subject_query))
                                {
                                    echo"<p style='color: #dd99ff;' >".$subno.". ".$rowi['subject_title']."<p>";
                                    $student_subject=$rowi['id_subject'];

                                    $sub_name="";
                                    $sub_query=mysql_query("SELECT subject_code, subject_title FROM table_subject WHERE id_subject='$student_subject' AND st_code='$st_code_staff'");
                                    while($row=mysql_fetch_array($sub_query))
                                    {
                                        $echo_sub=" SUBJECT CODE: ".$sub_name=$row['subject_code']." | TITLE: ".$row['subject_title']."<br>GMT Review";
                                    }
                                    $reg_no="";
                                    $reg_no_query=mysql_query("SELECT student_name, student_regno FROM table_student_details WHERE st_code='$st_code_staff' AND access='' ORDER BY student_regno");
                                    $c_code='6213';
                                    $no_of_gmt_query=mysql_query("SELECT DISTINCT gmt_no FROM table_gmt_marks WHERE st_code='$st_code_staff'  GROUP BY gmt_no");
                                    $noofst=mysql_num_rows($reg_no_query);
                                    if($noofst==0)
                                    {
                                      echo "<p> No Students <p>";                                       
                                    }
                                    else
                                    {
                                        $no_of_gmt_query=mysql_query("SELECT DISTINCT gmt_no FROM table_gmt_marks WHERE st_code='$st_code_staff'  GROUP BY gmt_no");
                                        while($row_in_2=mysql_fetch_array($no_of_gmt_query))
                                        {
                                            while($row=mysql_fetch_array($reg_no_query))
                                            {
                                                $check_avail_query=mysql_query("SELECT subject_{$student_subject}, subject_{$student_subject}_st, subject{$student_subject}_cb, gmt_no FROM table_gmt_marks WHERE st_code='$st_code_staff' AND student_regno='{$row['student_regno']}' GROUP BY gmt_no");
                                                $count=mysql_num_rows($check_avail_query);
                                                if($count>=1)
                                                {
                                                    while($row_in=mysql_fetch_array($check_avail_query))
                                                    {   
                                                        if($row_in['subject_'.$student_subject.'_st']==0 and $row_in['subject'.$student_subject.'_cb']==0)
                                                        {   
                                                        	$g_no=$row_in['gmt_no'];

                                                        	if($gmt_tmp!=$g_no){
                                                        		echo "<p> GMT ".$g_no." "; 
                                                        		$gmt_tmp=$g_no;
                                                        	}
                                                                                                                
                                                            echo "<p>".$row['student_name']." ".$c_code.$row['student_regno']." <p>";
                                                            $notice++;
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    if ($notice==0)
                                    {
                                        echo "<br><p style='color: LawnGreen;' >Staff Filled All the Entries<p>";
                                    }
                                    else
                                    {
                                        echo "<br><p style='color: #ffcccc;' >Students Count (Marks Not Updated): ".$notice."<p>"; 
                                    }
                                    $subno++;
                                }
                            }
                        }
                    ?>
                    <a href='staff_report.php'><button>Back</button></a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>