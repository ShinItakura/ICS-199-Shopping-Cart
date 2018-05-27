<html>
<head>
<title>Result</title>
</head>
<body>
<?php

	$name = strip_tags($_POST['name']);
	$desc = strip_tags($_POST['description']);
	$price = strip_tags($_POST['price']);
	$pic = strip_tags($_POST['picture']);
	$shape = $_POST['shape'];
	$color = $_POST['color'];
	$mat = $_POST['material'];
	$manu = $_POST['manufacturer'];
	$axle = $_POST['axle'];
	
	echo "<p>$name</p>";
	echo "<p>$desc</p>";
	echo "<p>$$price</p>";
	echo "<p>$pic</p>";
	echo "<p>$shape</p>";
	echo "<p>$color</p>";
	echo "<p>$mat</p>";	
	echo "<p>$manu</p>";	
	echo "<p>$axle</p>";
	
	$db = mysqli_connect('localhost', 'cst107','446287', 'ICS199Group13_dev');
	$query = "insert into ITEM (name, AXLE_id, MATERIAL_id, SHAPE_id, price, image, color, manufacturer, description)
	values('$name', '$axle', '$mat', '$shape', CAST('$price' AS DECIMAL(5,2)), '$pic', '$color', '$manu', '$desc');";
	//NOW(), 
if (@mysqli_query($db, $query)) {
	print '<p>The product has been successfully added.</p>';
} else {
	print '<p>The product could not be added because:<br>' . mysqli_error($db) . '.</p>';
	print '<p>The query being run was: ' . $query . '</p>'; 
}

?>
</body>
</html>