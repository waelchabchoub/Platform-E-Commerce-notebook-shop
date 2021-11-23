<?php

function check_login($con)
{
	if(isset($_SESSION['name']))  // array used to set and get session variable value
	{
		$nom = $_SESSION['name'];
		$query = "select * from users where name = '$nom' limit 1";
		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result)>0)
		{
			$user_data = mysqli_fetch_assoc($result);  //The mysqli_fetch_assoc() function is used to return an associative array representing the next row in the result set for the result represented by the result parameter, where each key in the array represents the name of one of the result set's columns.
			return $user_data;
		}
	}
	//redirect to login
	echo "<script>window.location.href='signin.php';</script>";
    die; //PHP die() La fonction die() est une fonction intégrée en PHP qui est utilisé pour afficher le message et quitter le script PHP actuel
	
}


function check_admin_login($con)
{
	if(isset($_SESSION['admin']))  // array used to set and get session variable value
	{
		$nom = $_SESSION['admin'];
		$query = "select * from admin where name = '$nom' limit 1";
		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result)>0)
		{
			$admin_data = mysqli_fetch_assoc($result);
			return $admin_data;
		}
	}
	//redirect to login
	echo "<script>window.location.href='adminlogin.php';</script>";
    die; //PHP die() La fonction die() est une fonction intégrée en PHP qui est utilisé pour afficher le message et quitter le script PHP actuel
	
}

?>