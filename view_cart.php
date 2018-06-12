<?php
session_start(); //start session
include("mysqli_connect.php");
setlocale(LC_MONETARY,"en_US"); // US national format (see : http://php.net/money_format)
?>

<?php include('header.php');?>

<head>
<title>Review Your Cart Before Buying</title>
<script src="jquery/jquery-1.10.2.js" type="text/javascript"></script>
<script>
	function checkQuantity(number, id) {
		if (number <= 1) {
			var decid = "dec"+id;
			document.getElementById(decid).href = "view_cart.php?case=rem&id="+id;
		} else {
			document.getElementById("dec").href = "view_cart.php?case=dec&id="+id;
		}
	}
	</script>
</head>
<body>
<h3 style="text-align:center">Review Your Cart Before Buying</h3>

<?php
//  	 ini_set('display_errors',1);

$userid = $_SESSION["userid"];
function increment($id, $userid, $dbc) {

	$query = "update CART set quantity = quantity + 1 where USER_id=$userid and ITEM_id=$id;";
	mysqli_query($dbc, $query);

}

function decrement($id, $userid, $dbc) {
	$check = "select quantity from CART where USER_id=$userid and ITEM_id=$id;";	
	$number =  (int)mysqli_query($dbc, $check);
//	echo "<p><h3>number = $number</h3></p>";
	$query = "update CART set quantity = quantity - 1 where USER_id=$userid and ITEM_id=$id;";
/*	if ($number <= 1) {
		remove($id, $userid, $dbc);
	} else {	*/
		mysqli_query($dbc, $query);
//	}
}

function remove ($id, $userid, $dbc) {
	$query = "delete from CART where USER_id=$userid and ITEM_id=$id;";
	mysqli_query($dbc, $query);
	
}

function emptyCart($userid, $dbc) {
	$query = "delete from CART where USER_id=$userid;";
	mysqli_query($dbc, $query);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	$case = $_GET["case"];
	if ($case == "emp") {
		emptyCart($userid, $dbc);
	} else {
		$id = $_GET["id"];	
		switch ($case) {
			case "inc":
				increment($id, $userid, $dbc);
				break;
			case "rem":
				remove($id, $userid, $dbc);
				break;
						default:
				decrement($id, $userid, $dbc);
				break;

		}
	}	
}
?>

<?php
//SESSION STUFF
/*
//if(isset($_SESSION["products"]) && count($_SESSION["products"])>0){
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

*/
	echo "<form action='view_cart.php' method='GET'>";
	echo "<table>";
	echo "<th>id</th>";	
	echo "<th>Product</th>";	
	echo "<th>Price</th>";	
	echo "<th>Decrease</th>";
	echo "<th>Quantity</th>";
	echo "<th>Increase</th>";
	echo "<th>Remove</th>";

	$userid = $_SESSION["userid"];	
	$getItems = "SELECT i.id, i.name, i.price, c.quantity FROM ITEM i INNER JOIN CART c ON i.id = c.ITEM_id WHERE USER_id=$userid;";
	$result = mysqli_query($dbc, $getItems);

	$subtotal = 0;
	while ($row = mysqli_fetch_array($result)) {
		echo "<tr>";
		$id = $row["id"];
		echo "<td>$id</td>";
		$name = $row["name"];
		echo "<td>$name</td>";
		$price = $row["price"];
		echo "<td>$price</td>";
		$quantity = $row["quantity"];
		$subtotal += $price*$quantity;		
		?>
		
				<!--Decrement button		href="view_cart.php?case=dec&id=<//?php echo $id; ?>"-->
		<td><a href="view_cart.php?case=dec&id=<?php echo $id; ?>" id="dec<?php echo $id; ?>" onclick="checkQuantity(<?php echo "$quantity, $id"; ?>)" class="btn btn-default">-</a></td>
		
				<!-- Quantity column-->
		<td><?php echo "$quantity"; ?></td>
	
				<!--Increment button-->
		<td><a href="view_cart.php?case=inc&id=<?php echo $id; ?>" class="btn btn-default">+</a></td>

	<!--	<td><input type='submit' name='add' value='+'/></td> 	-->

				<!--Remove button-->
		<td><a href="view_cart.php?case=rem&id=<?php echo $id; ?>" class="btn btn-default">Remove</a></td>
	<!--	<td><button onclick='remove($id)'>Remove</button></td>		-->

		</tr>
	<?php }
	
	$tax = number_format($subtotal*0.05,2, '.', '');
	$total = number_format($subtotal*1.05,2, '.', '');

	?>
	
	</table>
	<p>Subtotal = <?php echo number_format($subtotal,2, '.', ''); ?> </p>
	<p>GST = <?php echo $tax ?> </p>
	<p>Total = <?php echo $total ?> </p>
	<?php //echo round($subtotal*1.05,2); ?>
	</form>
	<br>
	<!--<form action="checkout.php" method="POST">
		<input type="submit" name="checkout" value="Check-out" />
	</form>	
  -->
	<p><a href="view_cart.php?case=emp" class="btn btn-default">Empty Cart</a></p> 
	
	<?php
/*}else{
	echo "Your Cart is empty";
	
} */
?>

<?php require_once('./config.php'); ?>

<form action="checkout.php" method="post">
  <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
          data-key="<?php echo $stripe['publishable_key']; ?>"
          data-description="Pay using Stripe"
          data-amount="$total * 100"
          data-locale="auto"
          data-currency="cad">
  </script>
</form>

<?php
include 'footer.php';
?>
</body>
</html>
