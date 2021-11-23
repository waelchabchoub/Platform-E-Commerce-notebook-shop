<?php 

// Include the database configuration file  
require_once 'connection.php'; 
 
// Get image data from database 
$result = $con->query("SELECT * FROM produits ORDER BY id DESC"); 

?>


<?php if($result->num_rows > 0){ ?> 
    <div class="gallery">
        <?php while($row = $result->fetch_assoc()){?> 
		

		<section class="py-5" >
		<div class="container px-4 px-lg-5 mt-5" >
		<div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
		
         <div class="col mb-5">
					<form action="index.php" method="post">
                        <div class="card h-100">
						
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                            <!-- Product image-->
                            <img class="card-img-top" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo $row["name"];?></h5>
                                    <!-- Product reviews-->
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                    </div>
                                    <!-- Product price-->
                                    <span class="text-muted text-decoration-line-through">20.00dt</span>
                                    <?php echo $row["price"]."dt";?>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><button type="Submit" value="add" name="add" class="btn btn-outline-dark mt-auto" href="#">Add to Cart</button></div>
								<input type="hidden" name="product_id" value=<?php echo $row["id"];?>>
                            </div>
                        </div>
					</form>
					</div>
		 </div>
		 </div>
        </section> 
			
        <?php } ?> 
    </div> 
<?php }else{ ?> 
    <p class="status error">Image(s) not found...</p> 
<?php } ?>