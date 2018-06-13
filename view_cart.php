<?php
session_start(); //start session
include("mysqli_connect.php");
setlocale(LC_MONETARY,"en_US"); // US national format (see : http://php.net/money_format)

$userid = $_SESSION["userid"];		// Get userid from session

function increment($id, $userid, $dbc) {		// Increment quantity of an item
	$query = "update CART set quantity = quantity + 1 where USER_id=$userid and ITEM_id=$id;";
	mysqli_query($dbc, $query);
}

function decrement($id, $userid, $dbc) {		// Decrement quantity of an item
	$check = "select quantity from CART where USER_id=$userid and ITEM_id=$id;";	
	$number =  (int)mysqli_query($dbc, $check);
	$query = "update CART set quantity = quantity - 1 where USER_id=$userid and ITEM_id=$id;";
	mysqli_query($dbc, $query);
}

function remove ($id, $userid, $dbc) {		// Remove item
	$query = "delete from CART where USER_id=$userid and ITEM_id=$id;";
	mysqli_query($dbc, $query);	
}

function emptyCart($userid, $dbc) {			// Empty all items from cart
	$query = "delete from CART where USER_id=$userid;";
	mysqli_query($dbc, $query);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {	// If GET processed
	$case = $_GET["case"];		// Get the function that should be performed
	if ($case == "emp") {		// Empty function requested
		emptyCart($userid, $dbc);
	} else {	
		$id = $_GET["id"];		// Get the ID of item acted upon
		switch ($case) {
			case "inc":			// Increment function requested
				increment($id, $userid, $dbc);
				break;
			case "rem":			// Remove function requested
				remove($id, $userid, $dbc);
				break;
			default:			// Decrement function requested
				decrement($id, $userid, $dbc);
				break;

		}
	}	
}
?>

<?php include('header.php');?>

<head>
<title>Review Your Cart Before Buying</title>
<link rel="stylesheet" href="style/tablestyle.css">
<script src="jquery/jquery-1.10.2.js" type="text/javascript"></script>
<script>
	function checkQuantity(number, id) {
		if (number <= 1) {
			var decid = "dec"+id;
			document.getElementById(decid).href = "view_cart.php?case=rem&id="+id;
		}
	}
</script>
</head>

<body>
<h3 style="text-align:center">Review Your Cart Before Buying</h3>

<?php

$getItems = "SELECT i.id, i.name, i.price, c.quantity FROM ITEM i INNER JOIN CART c ON i.id = c.ITEM_id WHERE USER_id=$userid;";
$result = mysqli_query($dbc, $getItems);	// Get items from database
if (mysqli_num_rows($result) != 0) {			// Check if cart is empty
?>

<!--	<form action='view_cart.php' method='GET'>-->
	<table align="center">
<!--	<th>id</th>	-->
	<th>Product</th>
	<th>Price</th>
<!--		<th>Decrease</th>-->
	<th colspan="3">Quantity</th>
<!--		<th>Increase</th>-->
	<th>Remove</th>
	
<?php
	$subtotal = 0;		// Start subtotal at zero
	while ($row = mysqli_fetch_array($result)) {	// Display values for each product in cart
		echo "<tr>";
		$id = $row["id"];
		$name = $row["name"];
		echo "<td class='product'>$name</td>";
		$price = $row["price"];
		echo "<td>$price</td>";
		$quantity = $row["quantity"];
		$subtotal += $price*$quantity;	// Add to subtotal	
		?>
		
				<!--Decrement button-->
		<td><a href="view_cart.php?case=dec&id=<?php echo $id; ?>" id="dec<?php echo $id; ?>" onclick="checkQuantity(<?php echo "$quantity, $id"; ?>)" class="btn btn-default">-</a></td>	
				<!-- Quantity column-->
		<td><?php echo "$quantity"; ?></td>	
				<!--Increment button-->
		<td><a href="view_cart.php?case=inc&id=<?php echo $id; ?>" class="btn btn-default">+</a></td>
				<!--Remove button-->
		<td><a href="view_cart.php?case=rem&id=<?php echo $id; ?>" class="btn btn-default">Remove</a></td>
		</tr>
		
	<?php 
	}
	
	$tax = number_format($subtotal*0.05,2, '.', '');	// Compute taxes
	$total = number_format($subtotal*1.05,2, '.', '');	// Compute total
	?>
	
	<tr>
		<td class="total">Subtotal: </td>
		<td> <?php echo number_format($subtotal,2, '.', ''); ?> </td>
	</tr>
	<tr>
		<td class="total">Tax: </td>
		<td> <?php echo $tax ?> </td>	
	</tr>
	<tr>
		<td class="total">Subtotal: </td>
		<td> <?php echo $total ?> </td>		
		<td colspan="3"></td>
		<td><a href="view_cart.php?case=emp" class="btn btn-default">Empty Cart</a></td>
	</tr>
	<tr class="blank_row">
		<td colspan="6"><br> </td>
	</tr>
	<tr>
		<td colspan="5"></td>
		<td>
			<!-- Payment button and script -->
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
		<td>
	</tr>
	</table>
<!--	</form>-->
	<br>



<?php
} else {
	echo "<h3>Your Cart is empty.</h3>";
	echo "<h4>Please return to the <a href='index.php'>shop</a> to add products to your cart.";
} 

include 'footer.php';
?>
