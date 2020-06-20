<?php
$q = $_GET['q'];
include("Config.php");
$sql="SELECT id_course, value_course FROM table_course WHERE id_degree = '".$q."'";
$result = mysql_query($sql);

echo "<option value='0' selected>Course</option>";
while($row = mysql_fetch_array($result)) {
    echo "<option value='".$row['id_course']."'>".$row['value_course']."</option>";
}
?>