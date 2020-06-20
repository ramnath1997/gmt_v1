
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
    $staff_dept=$_SESSION['dept'];
    
    /*while ( $i<= 10) {
        echo '<input type="text" name="n'.$i.'" value="" > ';
        $i=$i+1;
    }*/
    include("./Config.php");
    $get_staff_id_name=mysql_query("SELECT staff_name,staff_dept FROM table_staff_details WHERE staff_id='$staff_id'");
while($row=mysql_fetch_array($get_staff_id_name))
{
    $staff_id_name=$row['staff_name'];
    
}

    $echo_user="Hi ".$staff_id_name."...<br>";

    ?><?php
$tz_object = new DateTimeZone('Asia/Kolkata');
    //date_default_timezone_set('Brazil/East');

    $datetime = new DateTime();
    $datetime->setTimezone($tz_object);
    $year_get=$datetime->format('Y\-m\-d\ h:i:s');
    $year=substr($year_get, 0,4);
    $month=substr($year_get, 5,2);
    $gmt_date=substr($year_get, 0,10);
    $reg_year=substr($year_get, 2,2);
    
    ?>
    <?php
    $br_group="";$counti='0';$i='0';
    $br_query=mysql_query("SELECT id_group,id_course FROM table_branch WHERE id_branch='$staff_dept'");
                                            
                                                while($row=mysql_fetch_array($br_query))
                                                {
                                                    $br_group=$row['id_group']; $cr_group=$row['id_course'];
                                                    if($cr_group==1){
                                                    $degree_query=mysql_query("SELECT id_course, value_course FROM table_course WHERE id_course=1 OR id_course=3 ORDER BY id_course");
                                                    while($row1=mysql_fetch_array($degree_query))
                                                    {
                                                    $course_c_id=$row1['id_course'];
                                                    $degree_c_id="";
                                                    $deg_name=mysql_query("SELECT `id_degree` FROM `table_course` WHERE `id_course`= '$course_c_id'");
                                                    while($row2=mysql_fetch_array($deg_name))
                                                    {
                                                           $degree_c_id=$row2['id_degree'];
                                                     }
                                                     $ag="D".$degree_c_id."C".$course_c_id."B";
                                                    $sql="SELECT code_branch, value_branch FROM table_branch WHERE id_course = {$course_c_id} AND id_group = {$br_group}   ";
                                                    $result = mysql_query($sql);

                                                    while($row3 = mysql_fetch_array($result)) {  
                                                     $branch_c_id=$row3['code_branch'];
                                                    $ag=$ag.$branch_c_id;
                                                    $temp=$reg_year-4;
                                                    while($reg_year>$temp){
                                                    $srb=$reg_year.$ag;
                                                    $sql="SELECT DISTINCT st_code FROM `table_student_details` WHERE st_code LIKE '{$srb}%'";
                                                    $reg_year;
                                                    $result = mysql_query($sql);

                                                    while($row4 = mysql_fetch_array($result)) {
                                                    
                                                    if($row4['st_code']!=""){
                                                    $st_c_id[$i]=$row4['st_code'];
                                                    $reg_yr[$i]=substr($st_c_id[$i], 0,2);
                                                    $d=substr($st_c_id[$i], 3,1);
                                                    $c=substr($st_c_id[$i], 5,1);
                                                    $b=substr($st_c_id[$i], 7,3);
                                                    $s[$i]=substr($st_c_id[$i], 10,1);
                                                    $sem=substr($st_c_id[$i], 12,1);


                                                    $d_query=mysql_query("SELECT value_degree FROM table_degree WHERE id_degree='$d'");
                                                    while($row=mysql_fetch_array($d_query))
                                                    {
                                                        $echo_stc=$row['value_degree']." | ";
                                                        $d_n[$i]=$row['value_degree']; 
                                                    }
                                                    $c_query=mysql_query("SELECT value_course FROM table_course WHERE id_course='$c'");
                                                    while($row=mysql_fetch_array($c_query))
                                                    {
                                                        $echo_stc=$echo_stc.$row['value_course']." | ";
                                                        $c_n[$i]=$row['value_course'];
                                                    }
                                                    $b_query=mysql_query("SELECT value_branch FROM table_branch WHERE code_branch='$b'");
                                                    while($row=mysql_fetch_array($b_query))
                                                    {
                                                        $echo_stc=$echo_stc.$row['value_branch']." | ";
                                                        $b_n[$i]=$row['value_branch']; 
                                                    }
                                                    $b_query=mysql_query("SELECT value_year, id_sem FROM table_semester WHERE id_sem='$sem'");
                                                    while($row=mysql_fetch_array($b_query))
                                                    {
                                                        $echo_stc=$echo_stc.$row['value_year']." | SEM:" .$row['id_sem'];
                                                        $y_n[$i]=$row['value_year'];  $s_n[$i]=$row['id_sem'];
                                                    }
                                                     $echo_sta[$i]=$echo_stc." | Sec: ".$s[$i];



                                                    $counti++;
                                                    $i++;
                                                    }
                                                    }
                                                    $reg_year--;
                                                    }
                                                    $reg_year=$reg_year+4;
                                                    
                                                    }
                                            } }

                                            if($cr_group==2){
                                                $degree_query=mysql_query("SELECT id_course, value_course FROM table_course WHERE id_course=2 OR id_course=3 ORDER BY id_course");
                                                    while($row1=mysql_fetch_array($degree_query))
                                                    {
                                                    $course_c_id=$row1['id_course'];
                                                    $degree_c_id="";
                                                    $deg_name=mysql_query("SELECT `id_degree` FROM `table_course` WHERE `id_course`= '$course_c_id'");
                                                    while($row2=mysql_fetch_array($deg_name))
                                                    {
                                                           $degree_c_id=$row2['id_degree'];
                                                     }
                                                     $ag="D".$degree_c_id."C".$course_c_id."B";
                                                    $sql="SELECT code_branch, value_branch FROM table_branch WHERE id_course = {$course_c_id} AND id_group = {$br_group}   ";
                                                    $result = mysql_query($sql);

                                                    while($row3 = mysql_fetch_array($result)) {  
                                                     $branch_c_id=$row3['code_branch'];
                                                    $ag=$ag.$branch_c_id;
                                                    $temp=$reg_year-4;
                                                    while($reg_year>$temp){
                                                    $srb=$reg_year.$ag;
                                                    $sql="SELECT DISTINCT st_code FROM `table_student_details` WHERE st_code LIKE '{$srb}%'";
                                                    $reg_year;
                                                    $result = mysql_query($sql);

                                                    while($row4 = mysql_fetch_array($result)) {
                                                    
                                                    if($row4['st_code']!=""){
                                                     $st_c_id[$i]=$row4['st_code'];
                                                    $reg_yr[$i]=substr($st_c_id[$i], 0,2);
                                                    $d=substr($st_c_id[$i], 3,1);
                                                    $c=substr($st_c_id[$i], 5,1);
                                                    $b=substr($st_c_id[$i], 7,3);
                                                    $s[$i]=substr($st_c_id[$i], 10,1);
                                                    $sem=substr($st_c_id[$i], 12,1);


                                                    $d_query=mysql_query("SELECT value_degree FROM table_degree WHERE id_degree='$d'");
                                                    while($row=mysql_fetch_array($d_query))
                                                    {
                                                        $echo_stc=$row['value_degree']." | ";
                                                        $d_n[$i]=$row['value_degree']; 
                                                    }
                                                    $c_query=mysql_query("SELECT value_course FROM table_course WHERE id_course='$c'");
                                                    while($row=mysql_fetch_array($c_query))
                                                    {
                                                        $echo_stc=$echo_stc.$row['value_course']." | ";
                                                        $c_n[$i]=$row['value_course'];
                                                    }
                                                    $b_query=mysql_query("SELECT value_branch FROM table_branch WHERE code_branch='$b'");
                                                    while($row=mysql_fetch_array($b_query))
                                                    {
                                                        $echo_stc=$echo_stc.$row['value_branch']." | ";
                                                        $b_n[$i]=$row['value_branch']; 
                                                    }
                                                    $b_query=mysql_query("SELECT value_year, id_sem FROM table_semester WHERE id_sem='$sem'");
                                                    while($row=mysql_fetch_array($b_query))
                                                    {
                                                        $echo_stc=$echo_stc.$row['value_year']." | SEM:" .$row['id_sem'];
                                                        $y_n[$i]=$row['value_year'];  $s_n[$i]=$row['id_sem'];
                                                    }
                                                     $echo_sta[$i]=$echo_stc." | Sec: ".$s;




                                                    $counti++;
                                                    $i++;
                                                    }
                                                    }
                                                    $reg_year--;
                                                    }
                                                    $reg_year=$reg_year+4;
                                                     "<br>";
                                                    }
                                            } 
                                                }
                                        }
                                                
                                                ?>
                                                <?php
                                            
                                            
                                                ?>
                                                <?php
                                                //$j=0;
                                                //while($j<$count){
                                                //echo $st_c_id[$j];
                                                //$j++;
                                                //}?>

    <!DOCTYPE html>
<html>
    <head>
        <title>Questions from Deparment</title>
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
            <h1>Questions from Deparment</h1>
            <?php  $date=date_create($gmt_date);
date_sub($date,date_interval_create_from_date_string("0 days"));
 $gmt_date= $_SESSION['gmt_date'];
                                                $j=0;
                                                while($j<$counti){?>
            <div class="mainw3-agileinfo">
                <?php echo "<p style='font-size: 1em;
    color: #fff;'>".$echo_sta[$j]." ".$gmt_date."</p>"; ?>
     
                <!-- login form -->
                <div class="login-form" style="background: black;opacity:0.8;">  
                    <div class="login-agileits-top" style="opacity:1;">

<?php
$asd="";
            
              ?>
              <?php
              $student_subject="";
              
              $id_query=mysql_query("SELECT id_subject,gmt_no,act_td FROM table_question WHERE gmt_date='$gmt_date' AND st_code='$st_c_id[$j]'");
              while($row=mysql_fetch_array($id_query))
              {
                  $student_subject=$row['id_subject']; $gmt_no=$row['gmt_no']; $act_td_qsn=$row['act_td'];
              }
              if($student_subject==""){
                echo "<br><H1>No Data has Been Recorded</H1>";
                echo "</div></div></div>";
                $j++;
                continue;
              }

  $sub_name="";
              $sub_query=mysql_query("SELECT subject_code, subject_title FROM table_subject WHERE id_subject='$student_subject' AND st_code='$st_c_id[$j]'");
              while($row=mysql_fetch_array($sub_query))
              {
                 echo "<br><center><p style='color: yellow; '> SUBJECT CODE:".$sub_name=$row['subject_code']; echo "|TITLE: ".$row['subject_title'];echo "<br>GMT NO.:".$gmt_no."</p></center>";
              }
              $reg_no="";
              $reg_no_query=mysql_query("SELECT student_name, student_regno FROM table_student_details WHERE st_code='$st_c_id[$j]' ORDER BY student_regno");
              
$c_code='6213';
$question_pre_query=mysql_query("SELECT question FROM table_question WHERE id_subject='$student_subject' AND st_code='$st_c_id[$j]' AND gmt_no='$gmt_no' ");
              while($row=mysql_fetch_array($question_pre_query))
              {
                 $question_pre=$row['question'];
              }
 ?>
 <H4><p>Question</p></H4><?php echo "<p>Updated Time:".$act_td_qsn."</p>"; ?>
<br> <textarea  rows="7" cols="103" readonly><?php echo $question_pre; ?></textarea> <br>
<?php
  
              $location = "./doc_dir/".$reg_yr[$j]."/".$d_n[$j]."/".$c_n[$j]."/".$b_n[$j]."/".$s[$j]."/".$y_n[$j]."/".$s_n[$j]."/".$student_subject."/";
              $sub_name="";
              $sub_query=mysql_query("SELECT subject_code FROM table_subject WHERE id_subject='$student_subject' AND st_code='$st_c_id[$j]'");
              while($row=mysql_fetch_array($sub_query))
              {
                 $sub_name[$j]=$row['subject_code'];
              }
              $gz=$dz='';
              if($gmt_no<'10')
              {
                $gz='0';
              }
              if(date('n')<'10')
              {
                $dz='0';
              }
              $f_name = $sub_name[$j]."GMT".$gz.$gmt_no."KeSiG".date('Y').$s[$j];

              $data=$f_name;
              if(is_dir($location)){
              $dirHandle = opendir($location);
                  while ($file = readdir($dirHandle)) {
                    $f_reduced=substr($file, 0,21);
                   if($f_reduced==$data) {
                      echo "<p>Attachments:</p><br>";
                      echo "<a href='".$location.$file."' name='".$f_name."'><button>".$f_reduced."</button></a>";
                    }
                  }
              }
    
  ?>






                    </div></div>
                    </div>
                    <?php
                    $j++;
                    }?>
                    <a href='q_report.php'><button>Back</button></a></div></body></html>