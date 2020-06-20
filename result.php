<?php
session_start();
if (!isset($_SESSION['type']) || $_SESSION['type']!="20") {
        echo "Unauthorized Access :(<br>";
        echo "<a href='./logout.php'>Back to Home</a>";
        exit();
    }
    if (!isset($_GET['q']) || $_GET['q']==""){exit();}
$q = $_GET['q'];
if($q=="help"){
	echo "This Page Is owned By admin ;)";
	exit();
}
if($q=="KeSiG"){
	echo "Welcome To Admin Page ;)";
	exit();
}
 include("Config.php");
 $sql=$q;
//$result = mysql_query($sql);
//echo mysql_fetch_array($result);
$response = mysql_query($sql);
echo "<table border='1'>";
if(mysql_error()){exit();}
while($result = mysql_fetch_assoc($response))
{	
	echo "<tr>";
    foreach($result as $key => $value)
    {
        echo "<td><h5>".$key.'</h5></td><td>'.$value."</td> ";
    }
    echo "</tr>";
}
echo "</table>";
?>