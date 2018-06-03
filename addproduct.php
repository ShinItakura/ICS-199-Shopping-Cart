<?php
  ini_set('display_errors',1);
  session_start();
  if ($_SESSION['role'] != 'admin') {
    header('Location: login.php');
    die();
  }
?>

<html>
<head>
<title>Result</title>
</head>
<body>
<?php

<<<<<<< HEAD
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
=======


<form action="addproductresult.php" enctype="multipart/form-data" method="POST">
<p>Name: <input type="text" name="name" required maxlength="45" pattern=".*[A-Za-z].*"/></p>
<p>Description: <input type="textarea" name="description" /></p>
<p>Price: $ <input type="number" step=".01" name="price" required/></p>
<input type="hidden" name="MAX_FILE_SIZE" value="300000">
<p>Picture: <input type="file" name="picture" required/></p>
<!--<p>Shape: <input type="text" name="shape" /></p>-->
<p>Shape: <select name="shape">
	<option value="1" selected>Butterfly</option>
	<option value="2">Classic</option>
	<option value="3">Imperial</option>
	<option value="4">Modified</option>
</select> </p>
<p>Color: <input type="text" name="color" required/></p>
<!--<p>Color: <select name="color">
	<option value="Black" selected>Black</option>
	<option value="Blue">Blue</option>
	<option value="Brown">Brown</option>
	<option value="Gold">Gold</option>
	<option value="Green">Green</option>
	<option value="Purple">Purple</option>
	<option value="Red">Red</option>
	<option value="Yellow">Yellow</option>
	<option value="Other">Other</option>
</select> </p>-->
<!--<p>Material: <input type="text" name="material" /></p>-->
<p>Material: <select name="material">
	<option value="1" selected>Metal</option>
	<option value="2">Plastic</option>
	<option value="3">Wood</option>
</select> </p>
<p>Manufacturer: <input type="text" name="manufacturer" required/></p>
<!--<p>Manufacturer: <select name="manufacturer">
	<option value="Beboo" selected>Beboo</option>
	<option value="Duncan">Duncan</option>
	<option value="Elenker">Elenker</option>
	<option value="Kascimu">Kascimu</option>
	<option value="Magic Yoyo">Magic Yoyo</option>
	<option value="Offstring">OffString</option>
	<option value="Raider">Raider</option>
	<option value="Spintastics">Spintastics</option>
	<option value="Yomega">Yomega</option>
	<option value="Yostar">Yostar</option>
	<option value="Yoyo">Yoyo</option>
	<option value="Yoyo King">Yoyo King</option>
	<option value="Yoyo Magic">Yoyo Magic</option>
	<option value="YoyoFactory">YoyoFactory</option>
	<option value="Other">Other</option>
</select> </p>-->
<!--<p>Axles: <input type="text" name="axles" /></p>-->
<p>Axle: <select name="axle">
	<option value="1" selected>Ball Bearing</option>
	<option value="2">Fixed</option>
	<option value="3">Transaxle</option>
</select> </p>
>>>>>>> origin/master

?>
</body>
</html>