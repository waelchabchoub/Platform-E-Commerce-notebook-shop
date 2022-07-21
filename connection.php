<?php
$dbhost = "localhost:3306";
$dbuser = "root";
$dbpass = "root";
$dbname = "noto";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
	
	die("failed to connect!");
}


?>
