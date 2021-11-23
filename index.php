<?php
session_start(); //creates a session or resumes the current one based on a session identifier passed via a GET or POST request, or passed via a cookie.

include("connection.php");
include("functions.php");
$user_data = check_login($con);    

if (isset($_POST['add'])){
   // print_r($_POST['product_id']);
    if(isset($_SESSION['cart'])){

        $item_array_id = array_column($_SESSION['cart'], "product_id");                          // take only the product_id column
        if(in_array($_POST['product_id'], $item_array_id)){
            echo "<script>alert('Product is already added in the cart..!')</script>";
            echo "<script>window.location = 'index.php'</script>";
        }else{

            $count = count($_SESSION['cart']);                                // number of products
            $item_array = array(
                'product_id' => $_POST['product_id']
            );

            $_SESSION['cart'][$count] = $item_array;
			//print_r($_SESSION);                                       //display the _SESSION
        }

    }else{

        $item_array = array(
                'product_id' => $_POST['product_id']                   //create an array ( column 1 : 'product_id' -> 27 )  
        );
		//print_r($item_array);           
        // Create new session variable
        $_SESSION['cart'][0] = $item_array;									//create an array ( column 1 [0] column 2 : 'product_id' -> 27 )  
        //print_r($_SESSION['cart']);                                    //The print_r() function is a built-in function in PHP and is used to print or display information stored in a variable
    } 
}

?>
<html lang="en">
<head>
    <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Noto-Online Store</title>
        <link rel="icon" href="images/logo_noto.PNG">
        
        
        <!-- bootstrap CDN-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
        <!-- font awesome CDN-->
        <script src="https://kit.fontawesome.com/18b1306aeb.js" crossorigin="anonymous"></script>
       
        <!--Bootstrap icon-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style11.css">
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
<nav class="navbar navbar-expand-lg navbar-light bg-white">
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
 <div class="collapse navbar-collapse" id="navbarNav">  
     <ul class="navbar-nav text-center ">
      <li class="nav-item active">
        <a class="nav-link" href="#" style="color: #b57685">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#produits" style="color: #b57685">Products</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link " href="#about_us" style="color: #b57685" >About us</a>
      </li>
      <li class="nav-item rounded-circle " id="icon">
       <form class="d-flex">
                        <a class="btn" href="cart.php" style="font-size: 21px ; color: #c29064"> 
                            <i class="bi bi-cart-check "style="font-size: 2rem ; color: #c29064" ></i>

                           Cart
						<?php

                        if (isset($_SESSION['cart'])){
                            $count = count($_SESSION['cart']);
                            echo "<span id=\"span\" class=\"badge ms-1 rounded-pill \" style=\"color: #c29064 \" > ($count)</span>";
                        }else{
                            echo "<span id=\"span\" class=\"badge ms-1 rounded-pill\" style=\"color: #c29064 \">(0)</span>";
                        }

                        ?>
                        </a>
                    </form>
       </li>

       <li class="nav-item">
       <a class="nav-link" href="logout.php" style="font-size : 30px ; color:#c29064">Logout</a>
      </li
    </ul>
   
  </div>
</nav>
</div>

</header>
<!--header-->
<!--main section-->
<main >
<!---First Slider-->
<div class="container-fluid p-0 " >
    <div class="site-slider">
        <div class="slider-one shadow">
                <img src="images/couverture_noto2.PNG" class="img-fluid">
                <img src="images/capture5.PNG" class="img-fluid">
                <img src="images/capture1.PNG" class="img-fluid">
                
                
        </div>
        </div>
</div>
<div class="product_cont container-fluid "  >
    <center><h1 style=" font-size: 38px ; font-family:Brush Script MT, Times New Roman ; margin-top: 20px ;margin-bottom : 10px;  color: #bb8352" id="produits"> Our Products<h1></center>
    <div class="product_slider row border rounded shadow py-5 " style="margin-left:30px ; margin-right: 30px ; height: 650px ; margin-bottom: 25px">
        <?php 
        // Include the database configuration file  
        require_once 'connection.php'; 
 
        // Get image data from database 
        $result = $con->query("SELECT * FROM produits ORDER BY id DESC"); 

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){?>
                <div class="col-md-4 my-3 my-md-0 " style="padding-right: 30px ; padding-left: 30px" >
                <form action="index.php" method="post">
                    <div class="cart shadow bg-white " >
                        <div>
                            <img class="img-fluid card-img-top" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" alt="..." />
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row["name"];?></h5>
                            <h6 class="card-star">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                            </h6>
                            <p class="card-text" style="font-size: 18px">
                                Notebook 50 pages A5
                            </p>
                            <h5 class="price-text">
                                <span class="price"><?php echo $row["price"]."dt";?></span>
                            </h5>
                           <center><button type="Submit" name="add" value="add" class="btn btn-warning my-3 "  style="font-family: Brush Script MT,Times New Roman;font-size:23px; "  href="#">Add to Cart <i class="bi bi-cart-check "></i></button></center>
                            <input type="hidden" name="product_id" value=<?php echo $row["id"];?>>
                        </div>
                    </div>
                </form>
            </div>
            <?php } ?> 



         
            <?php }else{ ?>
            <p class="status error">Image(s) not found...</p> 
        <?php } ?>
        
       
    </div>
    <div class="slider-btn">
        <span class="prev position-top left-0"><i class="bi bi-chevron-left"></i></span>
        <span class="next position-top right-0"><i class="bi bi-chevron-right"></i></span>
    </div>
</div>
<!--img src="capture1.PNG" class="img-fluid"-->
<center<h1 style=" font-size: 45px ; font-family:Brush Script MT, Times New Roman ; margin-left: 630px ; margin-top: 20px ;margin-bottom : 10px;  color: #bb8352" id="about_us">About Us<h1>
    <div class="row border rounded shadow "  style="margin:25px ; margin-right: 74px ; margin-left: 73px ; position : relative">
    <img src="images/background.jpg" class="img-fluid" style="width : 100%; height : 450px" >
    <h3 class="noto" style="position: absolute ; margin-top : 60px ; color: #EBAC82 ; margin-left : 680px ; font-size : 50px">Noto Online_Store</h3>
    <p class="promote text_center" style="position: absolute ; margin-top : 230px ; color : #bb8352 ; font-size : 35px ; margin-left : 430px">Are you a creative person? Are you in the process of becoming one? </p> 
    <p class="promote text_center" style="position: absolute ; margin-top : 270px ; color : #bb8352 ; font-size : 35px ; margin-left : 200px">These pages have the perfect layout for you to write down and plan  your best <br> ideas, thoughts and memories <br> and most importantly: Have fun! <br>
                        So don't think twice and create your favorite design now.
                        </p>


    </div>

</main>
<!--main section-->

        <footer class="shadow" >

        <div class="container">
                <div class="row">
                      
                </div>
                     <div class="row contact">
                        <h3>Contact us</h3>
                     </div>

                    <div class="icon">
                    <a href="https://www.facebook.com/NOTO-%E3%83%8E%E3%83%BC%E3%83%88-100553209063574" target="_blank"><i class="bi bi-facebook">  NOTO ノート</i></a>
                    <a href="https://www.instagram.com/noto.tn/?hl=en" target="_blank"><i class="bi bi-instagram">  noto.tn </i></a>
                    <a href="noto_online_store@gmail.com" target="_blank"><i class="bi bi-google">  noto@gmail.com</i></a> 
                    <a href="tel:+216 94191872"><i class="bi bi-telephone">  +216 94191872</i></a>
                    <a href=""><i class="bi bi-geo-alt">  Sousse_Tunisia </i></a>

                    </div>
                         <br>
                    
            
            </div>
           <center> <p class="copyright">Noto © 2021 | Designed by Islem and Wael</p> </center>
</footer>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script type="text/javascript">
        $('.slider-one').slick(
            {
  slidesToShow: 1,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 3000,
  arrows : false,
}
        );
    </script>
<script type="text/javascript">
        $('.product_slider').slick(
            {
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 3,
                dots : true ,
                prevArrow : ".product_cont .slider-btn .prev",
                nextArrow : ".product_cont .slider-btn .next"

}
        );
    </script>


</body>
</html>