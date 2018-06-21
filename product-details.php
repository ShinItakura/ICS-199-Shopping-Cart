
	<?php
//		include("mysqli_connect.php"); //include config file

	?>



<?php include('header.php'); 
	ini_set("display_errors",1);
	$prodID = $_GET['id'];

if (!empty($prodID)) {
	$query = "select i.name as pname, a.name as aname, m.name as mname, s.name as sname, description, price, color, manufacturer, image
				from ITEM i INNER JOIN AXLE a ON i.AXLE_id = a.id 
				inner join MATERIAL m ON i.MATERIAL_id = m.id
				inner join SHAPE s ON i.SHAPE_id = s.id
				where i.id = '$prodID';" ;
	$sqlSelectSpecProd = mysqli_query($dbc, $query);
	$getProdInfo = mysqli_fetch_array($sqlSelectSpecProd);
	$prodname = $getProdInfo["pname"];
	$prodprice = $getProdInfo["price"];
	$proddesc = $getProdInfo["description"];
	$prodimage = $getProdInfo["image"];
	
	$prodaxle = $getProdInfo["aname"];
	$prodmat = $getProdInfo["mname"];
	$prodshape = $getProdInfo["sname"];
	$prodman = $getProdInfo["manufacturer"];
	$prodcol = $getProdInfo["color"];
}
?>
		<br>
		<section>
			<div class="container">
				<div class="row">
					
					
	                
					<div class="col-sm-9 padding-right">
						<div class="product-details"><!--product-details-->
							<div class="col-sm-5">
								<div class="view-product">
	                            
							
								<img src="images/<?php echo $prodimage; ?>" />	
	                                
								</div>
							</div>
							<div class="col-sm-7">
								<div class="product-information"><!--/product-information-->
								<h2 class="product"><?php echo $prodname; ?></h2>
								
					
									<p>Price: <span class="price"><?php echo $prodprice; ?></span></p>

	                         <!--        <br>
	                                
	                               <a class="btn btn-default add-to-cart" id="add-to-cart"><i class="fa fa-shopping-cart"></i>Add to Cart</a>
	                                <p class="info hidethis" style="color:red;"></p>	-->
									<p><b>Manufacturer: </b><?php echo $prodman; ?></p>
									<p><b>Axle Type: </b><?php echo $prodaxle; ?></p>
									<p><b>Material: </b><?php echo $prodmat; ?></p>
									<p><b>Shape: </b><?php echo $prodshape; ?></p>
									<p><b>Colour: </b><?php echo $prodcol; ?></p>
									<p><b>Description: </b><?php echo $proddesc; ?></p>
									
									
									
				   <!-- 					<p><b>Contact Info:</b> 123-456-7891</p>
									<p><b>Email:</b> bob@bob.com</p>	-->
									
								</div><!--/product-information-->
							</div>
						</div><!--/product-details-->
						
					</div>
				</div>
			</div>
			</div>
		</section>
		
		<?php include('footer.php'); ?>