<?php 
// function used to resize image uploaded

function imageResize($imageResourceId,$width,$height)
{


	$targetWidth =450;
	$targetHeight =300;


	$targetLayer=imagecreatetruecolor($targetWidth,$targetHeight);
	imagecopyresampled($targetLayer,$imageResourceId,0,0,0,0,$targetWidth,$targetHeight, $width,$height);


	return $targetLayer;
}


// Include the database configuration file  
require_once '../connection.php'; 
 
// If file upload form is submitted 
$status = $statusMsg = ''; 
if(isset($_POST["submit"])){ 
    $status = 'error'; 
    if(!empty($_FILES["image"]["name"])) { 
        // Get file info 
        $fileName = basename($_FILES["image"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
         
        // Allow certain file formats 
        $allowTypes = array('jpg','jpeg'); 
        if(in_array($fileType, $allowTypes)){ 
            
			$image = $_FILES['image']['tmp_name']; 
			
			
			
			//resize the image 
			 
				
			$sourceProperties = getimagesize($image);      // gives array  > [0] width   [1] hidth  [2] type
 			$fileNewName = time();                         // save the new file name into the current time 
			$folderPath = "upload/";						// folder to save images
			$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);   //give .jpg ...
			$imageType = $sourceProperties[2];                // 0 if gif 2 if jpg 3 if png ...
			

			switch ($imageType) {


				/*case IMAGETYPE_PNG:
					$imageResourceId = imagecreatefrompng($image); 
					$targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
					imagepng($targetLayer,$folderPath. $fileNewName. "_thump.". $ext); //save new image     
					break;


				case IMAGETYPE_GIF:
					$imageResourceId = imagecreatefromgif($image); 
					$targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
					imagegif($targetLayer,$folderPath. $fileNewName. "_thump.". $ext);
					break;    */


				case IMAGETYPE_JPEG:
					$imageResourceId = imagecreatefromjpeg($image); 
					$targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
					imagejpeg($targetLayer,$folderPath. $fileNewName. "_thump.". $ext);
					break;


				default:
					echo "Invalid Image type.";
					exit;
					break;
			}


			move_uploaded_file($image, $folderPath. $fileNewName. ".". $ext);   // move the original image into the same folder
			// echo "Image Resize Successfully.";
 			
						
				
			// resizing finished now insert in database		
					
			
            $imgContent = addslashes(file_get_contents($folderPath. $fileNewName. "_thump.". $ext));         //get image content from resized image path
			$name = $_POST['name'];
			$price = $_POST['price'];
            // Insert image content into database 
            $insert = $con->query("INSERT into produits (image, name,price) VALUES ('$imgContent', '$name','$price')"); 
             
            if($insert){ 
                $status = 'success'; 
                $statusMsg = "File uploaded successfully."; 
				echo '<script>alert("'.$statusMsg.'");</script>';
            }else{ 
                $statusMsg = "File upload failed, please try again."; 
				echo '<script>alert("'.$statusMsg.'");</script>';
            }  
        }else{ 
            $statusMsg = 'Sorry, only JPG, JPEG files are allowed to upload.'; 
			echo '<script>alert("'.$statusMsg.'");</script>';
        } 
    }else{ 
        $statusMsg = 'Please select an image file to upload.'; 
		echo '<script>alert("'.$statusMsg.'");</script>';
    } 
} 
 
// Display status message 
	

?>