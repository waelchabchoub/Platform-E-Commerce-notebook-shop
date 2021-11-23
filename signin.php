<?php
session_start();

include("connection.php");
include("functions.php");
if($_SERVER['REQUEST_METHOD']=="POST")
{	 
	$nom = $_POST['your_name'];
	$pass = $_POST['your_pass'];
	if(!empty($nom) && !empty($pass)){
	// prepare and bind
	$stmt = $con->prepare("select * from users where name = ? limit 1 ");     //use prepared statement tp prevent sql injection //ans les systèmes de gestion de base de données, une instruction préparée ou une instruction paramétrée est une fonctionnalité utilisée pour pré-compiler le code SQL, en le séparant des données
	$stmt->bind_param("s", $nom);
	$stmt->execute();
	$result = $stmt->get_result();
		if($result)
		{
			if($result && mysqli_num_rows($result)>0)
			{
				$user_data = mysqli_fetch_assoc($result);
				if($user_data['password'] == $pass)
				{
					
					//creation du cookie remember me 
					if (!empty($_POST['remember-me']))
					{
						setcookie("loginuser",$nom,time()+(60*1));
					}
					else //si remember me not checked empty the cookie to avoid error
					{
						if (isset($_COOKIE["loginuser"]))
						{
							setcookie("loginuser","");
						}
					}	
						
					//end of cookie creation
						// set SESSION array to curent user
					$_SESSION['name']=$user_data['name'];
					echo "<script>window.location.href='index.php';</script>";
					die;
				}
			}
		}
	
	echo "enter valid informations!";	
} else
{
 echo "enter valid informations!";	
}
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Noto-Online Store</title>
    <link rel="icon" href="images/logo_noto.PNG">
    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="main">
	<section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="images/signin-image.jpg" alt="sing up image"></figure>
                        <a href="/projet_tp_web/signup.php" class="signup-image-link">Create an account</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" class="register-form" id="login-form">
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="your_name" id="your_name" placeholder="Your Name" value = <?php if(isset($_COOKIE["loginuser"])){echo $_COOKIE["loginuser"];} ?> >
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="your_pass" id="your_pass" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" <?php if(isset($_COOKIE["loginuser"])){?> checked <?php }?>/>
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                            </div>
                        </form>
                        <div class="social-login">
                            <span class="social-label">Or login with</span>
                            <ul class="socials">
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                            </ul>
                        </div>
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