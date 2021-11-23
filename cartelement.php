<?php
function cartElement($productimg, $productname, $productprice, $productid){

    $element = "
   
				<form action=\"cart.php?action=remove&id=$productid\" method=\"post\" class=\"cart-items\">
                    <div style=\"padding:10px ; margin: 10px ;  \">
                        <div class=\"row shadow border rounded \"  style=\"background-color: #ffffff ; border-color: #c29064\">
                            <div class=\"col-md-3 pl-0\"> ";
                            
    $element2=              "</div>
                            <div class=\"col-md-6\" style=\"margin-left:50px\">
                                <h5 class=\"pt-2\" style=\" font-family: Brush Script MT,Times New Roman ; font-size: 30px ; color: #ac6576 ; margin-left: 25px\">$productname</h5>
                                <small class=\"text-secondary\" style=\" font-family: Times New Roman ; font-size: 18px ; color: #ac6576 ;margin-left: 10px\">Notebook 50 pages A5</small>
                                <h5 class=\"pt-2\" style=\" font-family:Brush Script MT, Times New Roman ; font-size: 25px  ;margin-left: 70px\">$productprice dt</h5>
                                <button type=\"submit\" class=\"btn btn-warning\" style=\"\" >Save for Later</button>
                                <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Remove</button>
                            </div>
                           
                        </div>
                    </div>
                </form>
    
    ";
    echo  $element;
	echo '<img  class="rounded" src="data:image/jpg;base64,' . $productimg . '" style="width: 215px; height:176px; margin-left:0px; margin-top: 0px; margin-bottom: 0px;"/>';
	echo $element2;
}



?>

		