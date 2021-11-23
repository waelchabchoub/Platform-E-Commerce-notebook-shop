<?php

if(isset($_SESSION['admin']))  // array used to set and get session variable value
	{
		unset($_SESSION['admin']);
		
	}
	
echo "<script>window.location.href='adminlogin.php';</script>";
die;

?>