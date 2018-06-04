<?php
session_start(); //start session
include("config.inc.php");
setlocale(LC_MONETARY,"en_US"); // US national format (see : http://php.net/money_format)
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Review Your Cart Before Buying</title>
<link href="style/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link href="style/style.css" rel="stylesheet" type="text/css">

</head>
<body>
<h3 style="text-align:center">Review Your Cart Before Buying</h3>
<?php
ini_set('display_error',1);

if(isset($_SESSION["products"]) && count($_SESSION["products"])>0){
	$total 			= 0;
	$list_tax 		= '';
	$cart_box 		= '<ul class="view-cart">';

	foreach($_SESSION["products"] as $product){ //Print each item, quantity and price.
		$name = $product["name"];
		$quantity = $product["quantity"];
		$price = $product["price"];
		$id = $product["id"];

		$item_price 	= sprintf("%01.2f",($price * $quantity));  // price x qty = total item price

		$cart_box 		.=  "<li> $id &ndash;&ndash;  $name (Qty : $quantity ) <span> $currency. $price </span></li>";

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

        

}else{
	echo "Your Cart is empty";
}
?>
<div class="b">
<button class="btn-checkout"><a href="index.php">Continue Shopping<i class="fa fa-cart-plus"></i></button></a>
<button class="btn-checkout">Check Out<i class="fa fa-cart-arrow-down"></i></button>
</div>

</body>
</html>
