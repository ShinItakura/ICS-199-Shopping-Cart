<?php
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
	$shapeChoice = $_GET['shape'];
	$query ="SELECT * FROM ITEM";
	$previous = false;
	if ($axleChoice != 0) {
	//	$query = "SELECT * FROM ITEM WHERE AXLE_id = $axleChoice";
		$query .= " WHERE AXLE_id = $axleChoice";
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
</html>
