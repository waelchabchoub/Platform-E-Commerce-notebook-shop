<?php
session_start(); //creates a session or resumes the current one based on a session identifier passed via a GET or POST request, or passed via a cookie.

include("../connection.php");
include("../functions.php");
$admin_data = check_admin_login($con);    
include("upload.php");
?>

<head>
<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="icon" href="images/logo_noto.PNG">

        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Noto_Online Store_Admin</title>
        
        
        <!-- bootstrap CDN-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
        <!-- font awesome CDN-->
        <script src="https://kit.fontawesome.com/18b1306aeb.js" crossorigin="anonymous"></script>
       
        <!--Bootstrap icon-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style7.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css">

         
       
</head>
<body>
	<!--header-->
<header>
<div class="container ">
    <div class="row">
         
         <div class="text-center">
         <img src="./images/logo_noto.PNG" id="logo" width="180px" height="105px">
         </div>
         

    </div>
</div>
<div class="container-fluid p-0" id="conteneur_nav">
<nav class="navbar shadow navbar-expand-lg navbar-light bg-white">
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">  
    <ul class="navbar-nav text-center ">
      <li class="nav-item">
        <a class="nav-link" href="#produits" style="color:#b57685 ; margin-left : 130px">Add_Products</a>
      </li>
      

       <li class="nav-item">
       <a class="nav-link" href="adminlogout.php" style="font-size : 28px ; color:#c29064 ; margin-left: 360px">Logout Admin</a>
      </li>
    </ul>
   
  </div>
</nav>
</div>

</header>
<!--header-->
<main>
  <br>
  <br>

  <center><h1 style=" font-size: 38px ; font-family:Brush Script MT, Times New Roman ; color: #bb8352"> DataBase Content<h1></center>
	<div class="container-fluid " name="produits" >
    <div class="row py-5 " style="margin: 30px " >
	<?php include("view.php");?>
	</div>
</div>
<center><h1 style=" font-size: 38px ; font-family:Brush Script MT, Times New Roman ;  color: #bb8352" id="produits"> Add Products<h1></center>
<center><div class="row shadow border rounded" style=" padding:10px ; width: 950px ; height: 260px ">

  <form name = "produit" action="" method="post" enctype="multipart/form-data" > <!--The type that allows file <input> element(s) to upload file data.-->
  <input type="file" name="image" required style="font-size: 25px ; margin-left:215px ; padding: 15px"/><br>
  <input type="text" name="name" placeholder="name" required style="font-size: 25px ; margin-left:100px ; margin-bottom: 10px" /><br>
	<input type="text" name="price" placeholder="price" required style="font-size: 25px ; margin-left:100px ; margin-bottom: 20px"/><br>
	<center><input type="submit" class="btn btn-warning" name="submit" value="Charger" style="font-size: 30px ; margin-left:120px ;font-family:Brush Script MT, Times New Roman "/></center>
	</form>
  </div> </center>
  </main>
    
</body>
</html>