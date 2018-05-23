<html>
<head>
<title>Add Product</title>
</head>
<body>

<form action="addproductresult.php" method="POST">
<p>Name: <input type="text" name="name" /></p>
<p>Description: <input type="textarea" name="description" /></p>
<p>Price: $ <input type="text" name="price" /></p>
<p>Picture: <input type="text" name="picture" /></p>
<!--<p>Shape: <input type="text" name="shape" /></p>-->
<p>Shape: <select name="shape">
	<option value="Butterfly" selected>Butterfly</option>
	<option value="Classic">Classic</option>
	<option value="Imperial">Imperial</option>
	<option value="Modified">Modified</option>
	<option value="Other">Other</option>
</select> </p>
<!--<p>Color: <input type="text" name="color" /></p>-->
<p>Color: <select name="color">
	<option value="Black" selected>Black</option>
	<option value="Blue">Blue</option>
	<option value="Brown">Brown</option>
	<option value="Gold">Gold</option>
	<option value="Green">Green</option>
	<option value="Purple">Purple</option>
	<option value="Red">Red</option>
	<option value="Yellow">Yellow</option>
	<option value="Other">Other</option>
</select> </p>
<!--<p>Material: <input type="text" name="material" /></p>-->
<p>Material: <select name="material">
	<option value="Metal" selected>Metal</option>
	<option value="Plastic">Plastic</option>
	<option value="Wood">Wood</option>
	<option value="Other">Other</option>
</select> </p>
<!--<p>Manufacturer: <input type="text" name="manufacturer" /></p>-->
<p>Manufacturer: <select name="manufacturer">
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
</select> </p>
<!--<p>Axles: <input type="text" name="axles" /></p>-->
<p>Axle: <select name="axle">
	<option value="Ball Bearing" selected>Ball Bearing</option>
	<option value="Fixed">Fixed</option>
	<option value="Transaxle">Transaxle</option>
	<option value="other">Other</option>
</select> </p>

<input type="submit" value="Submit" />

</form>
</body>
</html>
