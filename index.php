<?php
session_start(); //start session
include('mysqli_connect.php');
//include 'header.php';
//include 'nav.php';

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Shopping Cart</title>
<link href="style/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
<script>
$(document).ready(function(){
		$(".form-item").submit(function(e){
			var form_data = $(this).serialize();
			var button_content = $(this).find('button[type=submit]');
			button_content.html('Adding...'); //Loading button text

			$.ajax({ //make ajax request to cart_process.php
				url: "cart_process.php",
				type: "POST",
				dataType:"json", //expect json value from server
				data: form_data
			}).done(function(data){ //on Ajax success
				$("#cart-info").html(data.items); //total items in cart-info element
				button_content.html('Add to Cart'); //reset button text to original text
				alert("Item added to Cart!"); //alert user
				if($(".shopping-cart-box").css("display") == "block"){ //if cart box is still visible
					$(".cart-box").trigger( "click" ); //trigger click to update the cart box.
				}
			})
			e.preventDefault();
		});

	//Show Items in Cart
	$( ".cart-box").click(function(e) { //when user clicks on cart box
		e.preventDefault();
		$(".shopping-cart-box").fadeIn(); //display cart box
		$("#shopping-cart-results").html('<img src="images/ajax-loader.gif">'); //show loading image
		$("#shopping-cart-results" ).load( "cart_process.php", {"load_cart":"1"}); //Make ajax request using jQuery Load() & update results
	});

	//Close Cart
	$( ".close-shopping-cart-box").click(function(e){ //user click on cart box close link
		e.preventDefault();
		$(".shopping-cart-box").fadeOut(); //close cart-box
	});

	//Remove items from cart
	$("#shopping-cart-results").on('click', 'a.remove-item', function(e) {
		e.preventDefault();
		var pcode = $(this).attr("data-code"); //get product code
		$(this).parent().fadeOut(); //remove item element from box
		$.getJSON( "cart_process.php", {"remove_code":pcode} , function(data){ //get Item count from Server
			$("#cart-info").html(data.items); //update Item count in cart-info
			$(".cart-box").trigger( "click" ); //trigger click on cart-box to update the items list
		});
	});

});
</script>
</head>


<body>
<div align="center">
<h3>YO YO Ma's House of YO-YO's</h3>
</div>



<a href="#"  class="cart-box" id="cart-info" title="View Cart">
<?php
if(isset($_SESSION["products"])){
	echo count($_SESSION["products"]);
}else{
	echo 0;
}
?>
</a>

<div class="shopping-cart-box" >
<a href="#" class="close-shopping-cart-box" >Close</a>
<h3>Your Shopping Cart</h3>
    <div id="shopping-cart-results" >
    </div>
</div>




<br>

<div align="center">
<form action="index.php" method="GET">
	<p class="b">Axle: <select name="axle">
		<option value="0">All</option>
		<option value="1">Ball Bearing</option>
		<option value="2">Fixed</option>
		<option value="3">Transaxle</option>
	</select>
	Material: <select name="mat">
		<option value="0">All</option>
		<option value="1">Metal</option>
		<option value="2">Plastic</option>
		<option value="3">Wood</option>
	</select>
	Shape: <select name="shape">
		<option value="0">All</option>
		<option value="1">Butterfly</option>
		<option value="2">Classic</option>
		<option value="3">Imperial</option>
		<option value="4">Modified</option>
	</select>
	<input type="submit" value="Submit"/>
	</p>
</form>
</div>



<?php
//	ini_set('display_errors',1);
$axleChoice = $_GET['axle'];
$matChoice = $_GET['mat'];
$shapeChoice = $_GET['shape'];
$query ="SELECT * FROM ITEM";
$previous = false;
if ($axleChoice != 0) {
$query .= " WHERE AXLE_id = $axleChoice";
$previous = true;
}
if ($matChoice != 0) {
if ($previous) {
	$query .= " AND MATERIAL_id = $matChoice";
} else {
	$query .= " WHERE MATERIAL_id = $matChoice";
}
$previous = true;
}
if ($shapeChoice != 0) {
if ($previous) {
//	$query = "SELECT * FROM ITEM WHERE AXLE_id = $axleChoice AND SHAPE_id = $shapeChoice";
	$query .= " AND SHAPE_id = $shapeChoice";
} else {
//	$query = "SELECT * FROM ITEM WHERE SHAPE_id = $shapeChoice";
	$query .= " WHERE SHAPE_id = $shapeChoice";
}
}
$result = mysqli_query($dbc, $query);


//Display fetched records as you please
$item =  '<ul class="products-wrp">';

while($row = $result->fetch_assoc()) {
$item .= <<<EOT
<li>

   <form class="form-item">
    <p class="a">{$row["name"]}</p>
     <div><img src="images/{$row["image"]}"></div>
     <div>Price : {$currency} {$row["price"]}<div>
<div class="item-box">
	<div> Qty :
    <input type="number" min="0" value="1" name="quantity" style="width: 5em;" required>
	</div>
    <input name="id" type="hidden" value="{$row["id"]}">
    <button type="submit">Add to Cart</button>

</div>
</form>
</li>
EOT;

}
$item .= '</ul></div>';

echo $item;
?>
 </body>
</html>
