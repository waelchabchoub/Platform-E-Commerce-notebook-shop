<?php
$dbhost = "maracasevent.mysql.database.azure.com:3306";
$dbuser = "bloodstike@maracasevent";
$dbpass = "WAELwael1998@";
$dbname = "noto";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
	
	die("failed to connect!");
}


?>