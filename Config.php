<?php
date_default_timezone_set('Asia/Kolkata');
$mysql_hostname = "localhost";//host name
$mysql_user = "root";//user name
$mysql_password = "";//pass word
$mysql_database = "gmt";//database name
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password);

if ( !$bd )
{
echo "Error connecting to database.\n";//This is check whether to db connect or not
}
else
{
//echo " succesfully connnected" ;
}
mysql_select_db($mysql_database, $bd);
?>