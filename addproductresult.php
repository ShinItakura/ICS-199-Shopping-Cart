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
	
	//if (move_uploaded_file ($_FILES['the_file']['tmp_name'], "/home/student/cst107/myfiles/{$_FILES['the_file']['name']}")) {
/*	if (move_uploaded_file ($_FILES['the_file']['tmp_name'], "/home/student/cst107/public_html/ICS199/project/{$_FILES['the_file']['name']}")) {
	
		print '<p>Your picture has been uploaded.</p>';
	
	} else { // Problem!
		print '<p style="color: red;">Your file could not be uploaded because: ';
		
		// Print a message based upon the error:
		switch ($_FILES['the_file']['error']) {
			case 1:
				print 'The file exceeds the upload_max_filesize setting in php.ini';
				break;
			case 2:
				print 'The file exceeds the MAX_FILE_SIZE setting in the HTML form';
				break;
			case 3:
				print 'The file was only partially uploaded';
				break;
			case 4:
				print 'No file was uploaded';
				break;
			case 6:
				print 'The temporary folder does not exist.';
				break;
			default:
				print 'Something unforeseen happened.';
				break;
		}
		
		print '.</p>';
	}	
		*/
	
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
//	$validate = "select name from ITEM";
//	$names = array	
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
