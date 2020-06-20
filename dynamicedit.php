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
    if (!isset($_SESSION['st_code'])) {
        echo "<a href='./logout.php'>Back to Previous Page</a>";
    }
    $hod_id=$_SESSION['staff_id'];
    echo $st_code=$_SESSION['st_code'];
    
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
?>

<?php
$reg_nos_query=mysql_query("SELECT student_name, student_regno, dh FROM table_student_details WHERE st_code='$st_code' AND access='' ORDER BY student_regno");

$conc=0;
$score=0;
if($_SERVER["REQUEST_METHOD"] == "POST" )
    {
        if(isset($_POST['click']))
        { 
          $z=0;

 while ($row=mysql_fetch_array($reg_nos_query))
         {
           if(!isset($_POST['student_regno'.$z.'']) OR $_POST['student_regno'.$z.'']=='')
           {
              $z++;
              continue;
           }
           else{
          $w=$_POST['student_regno'.$z.''];
          $rtmp=$_POST['student_regnotmp'.$z.''];
          $l=strlen($w);
          if($l!="12"){
            $z++;
              continue;
           }
           else{

            $student_reg_c=substr($w, 4, 12);
            $sql="SELECT student_regno FROM table_student_details WHERE student_regno='$rtmp'";
            $result=mysql_query($sql) or die (mysql_error());
            $count=mysql_num_rows($result);
            if($count>=1)
            {
              

      
                if(isset($_POST['student_regno'.$z.'']) AND isset($_POST['student_name'.$z.''])){
                  if(trim($_POST['student_regno'.$z.'']) AND trim($_POST['student_name'.$z.''])){
                    mysql_query("UPDATE table_student_details SET student_regno='{$student_reg_c}' WHERE student_regno='{$rtmp}' ");        
                  if(isset($_POST['student_name'.$z.''])){
                    mysql_query("UPDATE table_student_details SET student_name='{$_POST['student_name'.$z.'']}' WHERE student_regno='".$student_reg_c."' ");
                    mysql_query("UPDATE table_student_details SET st_code='{$st_code}' WHERE student_regno='".$student_reg_c."'");
                    $conc++;
                  }
                  if(isset($_POST['student_dh'.$z.''])){
                    if(trim($_POST['student_dh'.$z.''])=='1'){
                    mysql_query("UPDATE table_student_details SET dh='1' WHERE student_regno='".$student_reg_c."' ");
                  }
                  if(trim($_POST['student_dh'.$z.''])=='0'){
                    mysql_query("UPDATE table_student_details SET dh='0' WHERE student_regno='".$student_reg_c."' ");
                  }
                  }
                $z++;
               }
              }
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
        <title>Student Registration Portal</title>
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
            <h1>Student Registration</h1>
            <div class="mainw3-agileinforegister">
                <?php echo "<p style='font-size: 1em;
    color: #fff;'>".$echo_user."<p>"; ?>
                <!-- login form -->
                <div class="login-form">  
                    <div class="login-agileits-top">

<form  method="POST">
<?php
$z=0;
$reg_no_query=mysql_query("SELECT student_name, student_regno, dh FROM table_student_details WHERE st_code='$st_code' AND access='' ORDER BY student_regno");

 while ($row=mysql_fetch_array($reg_no_query))
  { ?>
<table><tr><td>
  <p>Sl.No:<?php echo $z+'1'; ?></p></td>
  </tr><tr><td>
  <p>Name</p></td><td>
  <input type="text" name="<?php echo 'student_name'.$z; ?>" value="<?php echo $row['student_name']?>"/></td><td>
  <p>Regno</p></td><td>
  <input type="text" name="<?php echo 'student_regno'.$z; ?>" value="<?php echo '6213'.$row['student_regno']?>"/></td><td>
<input type="hidden" name="<?php echo 'student_regnotmp'.$z; ?>" value="<?php echo $row['student_regno']?>"/>

  
    <?php if($row['dh']=='0'){
      ?>
      <p>D</p></td><td>
      <input type="radio" name="<?php echo 'student_dh'.$z; ?>" value="0" checked/></td><td>
  <p>H</p></td><td>
  <input type="radio" name="<?php echo 'student_dh'.$z; ?>" value="1"/></td></tr></table>
<?php 
    }else
    if($row['dh']=='1'){
      ?>
      <p>D</p></td><td>
      <input type="radio" name="<?php echo 'student_dh'.$z; ?>" value="0" /></td><td>
  <p>H</p></td><td>
  <input type="radio" name="<?php echo 'student_dh'.$z; ?>" value="1" checked/></td></tr></table>


  
  <?php
}
  $z++;
}
?>
   <input type="submit" value=Submit name="click">
</form>
<a href="dataedit.php"><button style="width:70px ">Back</button></a>

<a href="logout.php"><button style="width:100px ">Logout</button></a>

