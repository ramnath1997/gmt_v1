<script>
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
return true;
}
function isNumberAB(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode !=65 && charCode !=66) {
        return false;
    }
return true;
}

</script>


<?php
if (!isset($_SESSION['staff_id']) || $_SESSION['staff_id']=="0") {
    echo "Page Not Found :(<br>";
    include("./logout.php");
    echo "<a href='./logout.php'>Back to Home</a>";
    exit();
  }if (!isset($_SESSION['st_code_staff'])) {
    echo "Class Not Selected :(<br>";
    echo "<a href='./staff_select.php'>Back to Select</a>";
    exit();
  }
  if (!isset($_SESSION['gmt_no'])) {
    echo "GMT No. is not Entered :(<br>";
    echo "<a href='student_display_select.php'>Back to Previous Page</a>";
    exit();
  }
  if (!isset($_SESSION['student_subject'])) {
    echo "Subject Not Selected :(<br>";
    echo "<a href='student_display_select.php'>Back to Previous Page</a>";
    exit();
  }
  $st_code_staff=$_SESSION['st_code_staff'];
  $staff_id=$_SESSION['staff_id'];
   $gmt_no=$_SESSION['gmt_no'];
   $student_subject=$_SESSION['student_subject'];
  include("../Config.php");
    $get_access_code=mysql_query("SELECT access FROM table_staff_details WHERE staff_id='$staff_id'");
                        while($row=mysql_fetch_array($get_access_code))
                        {
                            $access=$row['access'];
                            if ($access!='0') {
                                echo "Unauthorized Access :(<br>";
        echo "<a href='../logout.php'>Back to Home</a>";
        exit();
                            }
                        }
  $get_staff_id_name=mysql_query("SELECT staff_name FROM table_staff_details WHERE staff_id='$staff_id'");
  while($row=mysql_fetch_array($get_staff_id_name))
  {
    $staff_id_name=$row['staff_name'];
  }

    $echo_user="Hi ".$staff_id_name."...";
  
  $echo_stc=$echo_sub="";
  include("../headerselection.php");
  ?>
   <?php
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" )
	{

				if(isset($_POST['otp']))
		{

			if(isset($_POST['otp_no']))
								{
									if(trim($_POST['otp_no'])!="")
									{
										if(strlen($_POST['otp_no'])==4){
										$_SESSION['otp_no']=$_POST['otp_no'];
										//echo "dfsdf";
										header('location: mark_edit.php');
									}
									}
								}
							}
						}
						?>

<?php
$tz_object = new DateTimeZone('Asia/Kolkata');
    //date_default_timezone_set('Brazil/East');

    $datetime = new DateTime();
    $datetime->setTimezone($tz_object);
    $dt=$datetime->format('Y\-m\-d\ h:i:s');

$gmt_date="";
$gmt_date_query=mysql_query("SELECT gmt_date FROM table_question WHERE id_subject='$student_subject' AND st_code='$st_code_staff' AND gmt_no='$gmt_no' ");
              while($row=mysql_fetch_array($gmt_date_query))
              {
                 $gmt_date=$row['gmt_date'];
              } $gmt_date;
$asd="";$sub_code=$sub_title="";
$subject_n_q=mysql_query("SELECT subject_code, subject_title FROM table_subject WHERE id_subject='$student_subject' AND st_code='$st_code_staff'");
              while($row=mysql_fetch_array($subject_n_q))
              {
                 $sub_code=$row['subject_code'];
                 $sub_title=$row['subject_title'];
              } 

			if ($_SERVER["REQUEST_METHOD"] == "POST" )
	{
    
		if(isset($_POST['mark_entry']) &&  $gmt_date!="" )
		{
$n='1';$s="";
$reg_no_query=mysql_query("SELECT student_name, student_regno FROM table_student_details WHERE st_code='$st_code_staff' AND access='' ORDER BY student_regno");
      $log="Dept:".$echo_stc.PHP_EOL."Staff_Name:".$staff_id_name.PHP_EOL."Staff_ID:".$staff_id.PHP_EOL."Subject Edited:".$sub_code." - ".$sub_title.PHP_EOL."Time :".$dt.PHP_EOL."................................................".PHP_EOL;
      file_put_contents('./log_files/KeSiG_'.$st_code_staff.'.txt', $log, FILE_APPEND);
			while($row=mysql_fetch_array($reg_no_query))
              {
              	$check_avail_query="SELECT gmt_no FROM table_gmt_marks WHERE st_code='$st_code_staff' AND gmt_no='$gmt_no' AND student_regno='{$row['student_regno']}' ORDER BY student_regno";
              	$result=mysql_query($check_avail_query) or die (mysql_error());
				 $count=mysql_num_rows($result);
				 if(isset($_POST['ra'.$n.'']) && isset($_POST['r2'.$n.''])){
          if($_POST['ra'.$n.'']=="AB" || $_POST['ra'.$n.'']=="ab"){
                          $_POST['ra'.$n.'']='150';
                          
                         }

           $cb='';
           if(isset($_POST['cb'.$n.''])){
           if($_POST['ra'.$n.'']<14){
            $cb=$_POST['cb'.$n.'']=0;
           }
           if($_POST['ra'.$n.'']>=14 &&  $_POST['cb'.$n.'']=='1'){
            $cb=$_POST['cb'.$n.'']=1;
           }
         }
				if($count==1)
				{
					  $apply_query=" UPDATE table_gmt_marks SET subject_{$student_subject}='{$_POST['ra'.$n.'']}', subject{$student_subject}_cb='{$cb}', subject_{$student_subject}_st='{$_POST['r2'.$n.'']}', gmt_date='$gmt_date', act_td{$student_subject}='$dt', st_code='$st_code_staff' WHERE gmt_no='$gmt_no' AND student_regno='{$row['student_regno']}' ORDER BY student_regno";
                 $n=$n+'1';
                 $asd=mysql_query($apply_query);
				}
				else{
					 $apply_query=" INSERT INTO table_gmt_marks (student_regno, gmt_no, st_code, subject_{$student_subject}, subject{$student_subject}_cb, subject_{$student_subject}_st, gmt_date, act_td{$student_subject}) VALUES ('{$row['student_regno']}', '$gmt_no', '$st_code_staff', '".$_POST['ra'.$n.'']."','".$cb."', '".$_POST['r2'.$n.'']."', '$gmt_date', '$dt' );";
                 	$n=$n+'1';
                 	$asd=mysql_query($apply_query);
             	}
             }
            }
          }
      }
              ?>
          <?php
              $sub_name="";
              $sub_query=mysql_query("SELECT subject_code, subject_title FROM table_subject WHERE id_subject='$student_subject' AND st_code='$st_code_staff'");
              while($row=mysql_fetch_array($sub_query))
              {
                 $echo_sub=" SUBJECT CODE: ".$sub_name=$row['subject_code']." | TITLE: ".$row['subject_title']."<br>GMT NO.:".$gmt_no;
              }
              $reg_no="";
              $reg_no_query=mysql_query("SELECT student_name, student_regno FROM table_student_details WHERE st_code='$st_code_staff' AND access='' ORDER BY student_regno");
              $c_code='6213';
           ?>

<html >
<head>
  <meta charset="UTF-8">
  <title>Mark Editing Portal</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
  
  <!--<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans'>-->

<script src='js/dropdown_codes.js' type='text/javascript'></script>
      <link rel="stylesheet" href="../css/style.css">
     <!-- <link rel="stylesheet" href="scss/style.scss">-->

  
</head>

<body>
  <div class="cont">
  <div class="demo">
  <div class="login__check_user" > <?php echo "<p x='0' y='-1'>".$echo_user." ".$echo_stc."<p>"; ?></div>  
     
    <div class="login">
<div class="login__check_user" > <?php echo "<p x='0' y='-1'>".$echo_user." ".$echo_stc."<p>"; ?></div>  
     
   
    <form method="POST">
    <div class="login__form_select_qsn">
 <div class="app__hello" > <?php echo "<p x='0' y='-1'>".$echo_sub."<p>"; ?></div> 
 <p class='login__signup' style=' color:red;'> You are Out of time.. Refer Your HOD<p>
 	<p class='login__signup' style=' color:white;'>----OR----<p>

<div class="login__row_title">	
<h6 style="font-size: 13px; color: white;" text-anchor="start"  >Enter OTP </h6>	
</div>
<div class="login__row">								
	<input class="login__input lists" type="text" name="otp_no" value=""></div>
<input class="login__submit_qsn_mark" type="submit" name="otp" value='Proceed'>
	</div></form></div>
	<a href="index3.php"><button class="app__logout_back" >Back</button></a>

<a href="../logout.php"><button class="app__logout">
<svg class="app__logout-icon svg-icon" viewBox="0 0 20 20">
          <path d="M6,3 a8,8 0 1,0 8,0 M10,0 10,12"/>
        </svg>
        </button></a>
	


 