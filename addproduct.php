<?php
//	ini_set('display_errors',1);
	session_start();
	// If not 'admin', redirect
	if ($_SESSION['role'] != 'admin') {
		header('Location: login.php');
		die();
	}
  include('header.php');
?>

<head>
	<title>Add Product</title>
</head>
<body>

<?php
/* This script displays and handles an HTML form. This script takes a file upload and stores it on the server. */
if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.
	// Check that file is an image
	if(!@is_array(getimagesize($_FILES['picture']['tmp_name']))){	// Not an image
		print '<p style="color: red;">Error. File upload is not an image. Please upload an image.</p>';
	} else {	// It is an image
		// Try to move the uploaded file:	
		//if (move_uploaded_file ($_FILES['the_file']['tmp_name'], "/home/student/cst107/myfiles/{$_FILES['the_file']['name']}")) {	
		//if (move_uploaded_file ($_FILES['picture']['tmp_name'], "/home/student/cst107/public_html/ICS199/project/images/{$_FILES['picture']['name']}")) {
		if (move_uploaded_file ($_FILES['picture']['tmp_name'], "images/{$_FILES['picture']['name']}")) {	
	
			print '<p>Your picture has been uploaded.</p>';
	
		} else { // Problem!
			print '<p style="color: red;">Your file could not be uploaded because: ';
		
			// Print a message based upon the error:
			switch ($_FILES['picture']['error']) {
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
					print 'The temporary folder does not exist';
					break;
				default:
					print 'Something unforeseen happened';
					break;
			}
		
			print '.</p>'; 
		}

		$name = strip_tags($_POST['name']);
		$desc = strip_tags($_POST['description']);
		$price = strip_tags($_POST['price']);
		$pic = strip_tags($_FILES['picture']['name']);
		$shape = $_POST['shape'];
		$color = $_POST['color'];
		$mat = $_POST['material'];
		$manu = $_POST['manufacturer'];
		$axle = $_POST['axle'];
	
	
		// Connect to Database
		$db = mysqli_connect('localhost', 'cst107','446287', 'ICS199Group13_dev');
		// Create insert query
		$query = "insert into ITEM (name, AXLE_id, MATERIAL_id, SHAPE_id, price, image, color, manufacturer, description)
		values('$name', '$axle', '$mat', '$shape', CAST('$price' AS DECIMAL(5,2)), '$pic', '$color', '$manu', '$desc');";
		//NOW()
		// Run insert query
		if (@mysqli_query($db, $query)) {
			?>
			<p><h3>The product "<?php echo "$name" ?>" has been successfully added.</h3></p>';
			<?php
		} else {
			print '<p>The product could not be added because:<br>' . mysqli_error($db) . '.</p>';
			print '<p>The query being run was: ' . $query . '</p>'; 
		}	
	}
}
?>

<form action="addproduct.php" enctype="multipart/form-data" method="POST">

	<p>Name: <input type="text" name="name" required maxlength="45" pattern=".*[A-Za-z].*"/></p>

	<p>Description: <input type="textarea" name="description" /></p>

	<p>Price: $ <input type="number" step=".01" name="price" required/></p>

	<input type="hidden" name="MAX_FILE_SIZE" value="300000">
	<p>Picture: <input type="file" name="picture" required/></p>

	<p>Shape: <select name="shape">
		<option value="1" selected>Butterfly</option>
		<option value="2">Classic</option>
		<option value="3">Imperial</option>
		<option value="4">Modified</option>
	</select> </p>

	<p>Color: <input type="text" name="color" required/></p>

	<p>Material: <select name="material">
		<option value="1" selected>Metal</option>
		<option value="2">Plastic</option>
		<option value="3">Wood</option>
	</select> </p>

	<p>Manufacturer: <input type="text" name="manufacturer" required/></p>

	<p>Axle: <select name="axle">
		<option value="1" selected>Ball Bearing</option>
		<option value="2">Fixed</option>
		<option value="3">Transaxle</option>
	</select> </p>

	<input type="submit" value="Submit" />

</form>
<?php include('footer.php');?>
