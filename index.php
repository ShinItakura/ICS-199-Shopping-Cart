<?php
<<<<<<< HEAD
session_start(); //start session
include("config.inc.php"); //include config file
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
$result = mysqli_query($mysqli_conn, $query);


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
    <select name="quantity">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    </select>
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
=======
session_start();
$db_host = 'localhost'; // Server Name
$db_user = 'cst107'; // Username
$db_pass = '446287'; // Password
$db_name = 'ICS199Group13_dev'; // Database Name

$connect = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$connect) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Products - Yo Yo Ma's House of Yo-Yo's</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>

	<div class="container" style="width:60%;">
	<h2 align="center">Yo Yo Ma's House of Yo-Yo's</h2>
	<form action="index.php" method="GET">
		<p>Axle: <select name="axle">
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
	$result = mysqli_query($connect, $query);
		
	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_array($result))
		{
			?>
            <div class="col-md-3">
            <form method="post" action="shop.php?action=add&id=<?php echo $row["id"]; ?>">
            <div style="border: 1px solid #eaeaec; margin: -1px 19px 3px -1px; box-shadow: 0 1px 2px rgba(0,0,0,0.05); padding:10px;" align="center">
            <img src="<?php echo $row["image"]; ?>" class="img-responsive">
            <h5 class="text-info"><?php echo $row["name"]; ?></h5>
            <h5 class="text-danger">$ <?php echo $row["price"]; ?></h5>
            <input type="text" name="quantity" class="form-control" value="1">
            <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>">
            <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
            <input type="submit" name="add" style="margin-top:5px;" class="btn btn-default" value="Add to Bag">
            </div>
            </form>
            </div>
            <?php
		}
	} else {		
		echo "<h3> No products found <h3>";
	}

  // Shopping Cart
	?>
    <div style="clear:both"></div>
    <h2>My Shopping Bag</h2>
    <div class="table-responsive">
    <table class="table table-bordered">
    <tr>
    <th width="40%">Product Name</th>
    <th width="10%">Quantity</th>
    <th width="20%">Price Details</th>
    <th width="15%">Order Total</th>
    <th width="5%">Action</th>
    </tr>
    <?php
	if(!empty($_SESSION["cart"]))
	{
		$total = 0;
		foreach($_SESSION["cart"] as $keys => $values)
		{
			?>
            <tr>
            <td><?php echo $values["item_name"]; ?></td>
            <td><?php echo $values["item_quantity"] ?></td>
            <td>$ <?php echo $values["product_price"]; ?></td>
            <td>$ <?php echo number_format($values["item_quantity"] * $values["product_price"], 2); ?></td>
            <td><a href="shop.php?action=delete&id=<?php echo $values["product_id"]; ?>"><span class="text-danger">X</span></a></td>
            </tr>
            <?php
			$total = $total + ($values["item_quantity"] * $values["product_price"]);
		}
		?>
        <tr>
        <td colspan="3" align="right">Total</td>
        <td align="right">$ <?php echo number_format($total, 2); ?></td>
        <td></td>
        </tr>
        <?php
	}
	?>
    </table>
    </div>
    </div>
 </body>
>>>>>>> origin/master
</html>
