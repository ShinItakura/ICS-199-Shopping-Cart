<?php
session_start(); //start session
include("mysqli_connect.php");
setlocale(LC_MONETARY,"en_US"); // US national format (see : http://php.net/money_format)
include('header.php');
?>
<head>
<title>Review Your Cart Before Buying</title>
</head>
<body>
<h3 style="text-align:center">Review Your Cart Before Buying</h3>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.
	if ($_SESSION['logged_in']) {
		if (count($_SESSION["products"])>0) {	
			header('Location: checkout.php');
		} else {	// Cart is empty
				echo "<h3>Can't checkout, your cart is empty.</h3>";
		}
	} else {
		header('Location: login.php');
	}
}

if(isset($_SESSION["products"]) && count($_SESSION["products"])>0){
	$total 			= 0;
	$list_tax 		= '';
	$cart_box 		= '<ul class="view-cart">';

	$currency = '&#36; '; //currency symbol
	$shipping_cost = 1.50; //shipping cost
	$taxes = array('GST' => 5);

	foreach($_SESSION["products"] as $product){ //Print each item, quantity and price.
		$name = $product["name"];
		$quantity = $product["quantity"];
		$price = $product["price"];
		$id = $product["id"];
		// $product_color = $product["product_color"];
		// $product_size = $product["product_size"];

		$item_price 	= sprintf("%01.2f",($price * $quantity));  // price x qty = total item price

		$cart_box 		.=  "<li> $id &ndash;&ndash;  $name (Qty : $quantity ) <span> $currency $price </span></li>";

		$subtotal 		= ($price * $quantity); //Multiply item quantity * price
		$total 			= ($total + $subtotal); //Add up to total price
	}

	$grand_total = $total + $shipping_cost; //grand total

	foreach($taxes as $key => $value){ //list and calculate all taxes in array
			$tax_amount 	= round($total * ($value / 100));
			$tax_item[$key] = $tax_amount;
			$grand_total 	= $grand_total + $tax_amount;
	}

	foreach($tax_item as $key => $value){ //taxes List
		$list_tax .= $key. ' '. $currency. sprintf("%01.2f", $value).'<br />';
	}

	$shipping_cost = ($shipping_cost)?'Shipping Cost : '.$currency. sprintf("%01.2f", $shipping_cost).'<br />':'';


	//Print Shipping, VAT and Total
	$cart_box .= "<li class=\"view-cart-total\">$shipping_cost  $list_tax <hr>Payable Amount : $currency ".sprintf("%01.2f", $grand_total)."</li>";
	$cart_box .= "</ul>";

	echo $cart_box;
//	echo '<button type="submit" name="checkout">Check-out</button>';

	
}else{
	echo "Your Cart is empty";
}
?>

	<form action="view_cart.php" method="POST">
		<input type="submit" value="Check-out" />
	</form>
<?php include('footer.php');?>
