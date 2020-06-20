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
    $get_staff_id_name=mysql_query("SELECT staff_dept FROM table_staff_details WHERE staff_id='$hod_id'");
while($row=mysql_fetch_array($get_staff_id_name))
{
    $staff_dept=$row['staff_dept'];
}
    $_SESSION['staff_dept']=$staff_dept;
$br_query=mysql_query("SELECT id_group,id_course FROM table_branch WHERE id_branch='$staff_dept'");
												while($row=mysql_fetch_array($br_query))
												{
													$br_group=$row['id_group'];
												}
												
    
$q = $_GET['q'];
include("Config.php");
$sql="SELECT id_branch, value_branch FROM table_branch WHERE id_course = {$q} AND id_group = {$br_group}   ";
$result = mysql_query($sql);

while($row = mysql_fetch_array($result)) {
    echo "<option value='".$row['id_branch']."'>".$row['value_branch']."</option>";
}
?>