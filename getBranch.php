<?php
$q = $_GET['q'];
include("Config.php");
$sql="SELECT id_branch, value_branch FROM table_branch WHERE id_course = {$q} ";
$result = mysql_query($sql);

echo "
<option value='0' selected>Branch</option>";
while($row = mysql_fetch_array($result)) {
    echo "<option value='".$row['id_branch']."'>".$row['value_branch']."</option>";
}
?>