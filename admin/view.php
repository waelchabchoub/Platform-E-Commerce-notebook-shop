<?php 
// Include the database configuration file  
require_once '../connection.php'; 
 
// Get image data from database 
$result = $con->query("SELECT * FROM produits ORDER BY id DESC"); 
?>


<?php if($result->num_rows > 0){ ?> 
     
        <?php while($row = $result->fetch_assoc()){?> 
		
		<div class="col-md-4 my-3 my-md-0 " >
		<form action="delete.php" method="post">
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
							<center><h5 ><?php echo "id = ".$row["id"];?></h5></center>
							<input type = "text" name = "id" value = "<?php echo "id = ".$row["id"];?>" hidden>
                            <center><button type="Submit" name="delete" value="delete" class="btn btn-warning my-3"  style="font-family: Brush Script MT,Times New Roman;font-size:30px ; "  href="#">Delete </button></center>
                            
                        </div>
                    </div>
                </form>
            </div>
		
		
	
		
        <?php } ?> 
     
<?php }else{ ?> 
    <p class="status error">Image(s) not found...</p> 
<?php } ?>