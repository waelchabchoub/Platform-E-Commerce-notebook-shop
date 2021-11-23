<?php
session_start();

include("connection.php");
include("functions.php");
if($_SERVER['REQUEST_METHOD']=="POST")         //$_SERVER variable predefini
{
	$nom = $_POST['name'];
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	$re_pass = $_POST['re_pass'];
	if(!empty($nom) && !empty($email) && !empty($pass)){
		if($pass == $re_pass)
		{
				$query = "select * from users where name = '$nom' ";
				$result = mysqli_query($con,$query);
				if($result)
				{
				  if($result && mysqli_num_rows($result)>0)
				{ echo "user name exist!";}
					
				
				else{
				$query = "insert into users (name,email,password) values ('$nom','$email','$pass')";
				mysqli_query($con,$query);
				echo "<script>window.location.href='signin.php';</script>";
				exit;
				}}
		}
	else
	{
		echo "password doesn't match!";
	}
		
} else
{
 echo "fill all fields!";	
}
}





?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PROJET</title>
	<link rel="icon" href="images/logo_noto.PNG">
    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="main">
	<section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" id="name" placeholder="Your Name"	required />
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email"	required />
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pass" id="pass" placeholder="Password"	required/>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password"	required/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" required />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="/projet_tp_web/signin.php" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>
		</div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>