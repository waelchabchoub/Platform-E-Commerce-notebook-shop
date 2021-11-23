<?php

session_start();

require_once ("connection.php");
require_once ("cartelement.php");


//button remove clicked;
if (isset($_POST['remove'])){
  if ($_GET['action'] == 'remove'){
      foreach ($_SESSION['cart'] as $key => $value){
          if($value["product_id"] == $_GET['id']){
              unset($_SESSION['cart'][$key]);
              echo "<script>alert('Product has been Removed...!')</script>";
              echo "<script>window.location = 'cart.php'</script>";
          }
      }
  }
}else if(empty($_SESSION['cart'])){
	echo "<script>alert('Cart is Empty')</script>";
	echo "<script>window.location = 'index.php'</script>";
}


?>

<!doctype html>
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
        <link rel="stylesheet" href="style10.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css">
</head>

<body class="bg-light">

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
      <li class="nav-item active">
        <a class="nav-link" href="index.php" style="color:#b57685">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php" style="color:#b57685">Products</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link " href="index.php" style="color:#b57685" >About us</a>
      </li>
      <li class="nav-item rounded-circle " id="icon">
       <form class="d-flex">
                        <a class="btn" href="cart.php" style="font-size: 21px ; color: #c29064 "> 
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
       <a class="nav-link" href="logout.php" style="font-size : 30px ; color:#c29064 ; margin-top: 12px" >Logout</a>
      </li>
    </ul>
   
  </div>
</nav>
</div>

</header>

<div class="container-fluid bg-white">
    <div class="row px-5 bg-white">
    
        <div class="col-md-7">
            <div class="shopping-cart">
           
                <h6 style="font-size: 38px ; font-family: Brush Script MT,Times New Roman ; color: #bb8352; margin-top: 25px; margin-left: 300px" >  My Cart </h6>
                <hr>
                

                <?php

                $total = 0;
                    if (isset($_SESSION['cart'])){
                        $product_id = array_column($_SESSION['cart'], 'product_id');

                        $result = $con->query("SELECT * FROM produits ORDER BY id DESC"); 
                        while ($row = mysqli_fetch_assoc($result)){ 
							
                         foreach ($product_id as $id){
                                if ($row['id'] == $id){ 
									
								  cartelement(base64_encode($row['image']),$row['name'],$row['price'],$row['id']);
								
                                  $total = $total + (int)$row['price'];
									
                                }
                            }
                        }
                    }else{
                        echo "<script>alert('Cart is Empty')</script>";
					      	echo "<script>window.location = 'index.php'</script>";
                    }

                ?>
			
            </div>
        </div>
        <div class="col-md-4 offset-md-1 shadow border rounded mt-5 bg-white h-25">

            <div class="pt-4">
                <h6 style="margin-left: 115px ; font-size: 32px ; font-family:Brush Script MT, Times New Roman ; color: #b57685">Price Details</h6>
                <hr>
                <div class="row price-details">
                    <div class="col-md-6">
                        <?php
                            if (isset($_SESSION['cart'])){
                                $count  = count($_SESSION['cart']);
                                echo "<h6>Price ($count items)</h6>";
                            }else{
                                echo "<h6>Price (0 items)</h6>";
                            }
                        ?>
                        <h6>Delivery Charges</h6>
                        <hr>
                        <h6>Amount Payable</h6>
                    </div>
                    <div class="col-md-6">
                        <h6><?php echo $total; ?>dt</h6>
                        <h6 class="text-success">FREE</h6>
                        <hr>
                        <h6><?php
                            echo $total;
                            ?>dt</h6>
						<hr>	
						

					<form name="submit" id="contact" action="https://formsubmit.co/waelchabchoub@outlook.com"  method="post">
						<input type="hidden" name="products" rows="2" class="form-control" id="products" value= "<?php foreach($product_id as $id){print_r("product id : ".$id." ");}; ?>" required="">
						<input type = "hidden" name="total price" rows="2" class="form-control" id="price" value=<?php echo $total."dt";?> required="">
						<div class="row">
						 <div class="col-md-12" style="margin-right: 20px">
							<fieldset>
							  <input name="name" rows="2" class="form-control" id="name" placeholder="name" required="">
							</fieldset>
						  </div>
						  <div class="col-md-12">
							<fieldset>
							  <input name="num" rows="2" class="form-control" id="num" placeholder="num" required="">
							</fieldset>
						  </div>
						  <div class="col-md-12">
							<fieldset>
							  <input name="email" rows="2" class="form-control" id="email" placeholder="email" required="">
							</fieldset>
						  </div>
						  <div class="col-md-12">
							<fieldset>
							  <input name="adresse" rows="2" class="form-control" id="message" placeholder="Addresse" required="">
							</fieldset>
						  </div>
						  <div class="col-md-12">
							<fieldset>
							<hr>
							  <button  type="submit" id="submit" name ="submit" class="btn btn-warning" style="margin-left: 30px" >Commander </button> 
							  
							</fieldset>  <br>
						  </div>
						</div>
					  </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>