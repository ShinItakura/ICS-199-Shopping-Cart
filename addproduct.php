<?php
session_start(); //start session
if ($_SESSION['role'] != 'admin') {
	header('Location: login.php');
	die();
}
?>

<html>
<head>
	<title>Add Product</title>
	<style>
    table#addtable{
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }
    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
    tr:nth-child(even) {
        background-color: #dddddd;
    } 
</style>

<?php
//header.php ends head tag and starts body tag
	include('header.php');

?>
	<h2>Add a Product</h2>
<?php
/* This script displays and handles an HTML form. This script takes a file upload and stores it on the server. */
if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.
	// Check that file is an image
	if(!@is_array(getimagesize($_FILES['picture']['tmp_name']))){	// Not an image
		print '<p style="color: red;">Error. File upload is not an image. Please upload an image.</p>';
	} else {	// It is an image
		// Try to move the uploaded file:	
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
	
		$query = "insert into ITEM (name, AXLE_id, MATERIAL_id, SHAPE_id, price, image, color, manufacturer, description)
		values('$name', '$axle', '$mat', '$shape', CAST('$price' AS DECIMAL(5,2)), '$pic', '$color', '$manu', '$desc');";
		if (@mysqli_query($dbc, $query)) {
			?>
			<p><h3>The product "<?php echo "$name" ?>" has been successfully added.</h3></p>
			<?php
		} else {
			print '<p>The product could not be added because:<br>' . mysqli_error($dbc) . '.</p>';
		}	
	}
}
?>
<div class="content">
	<form action="addproduct.php" enctype="multipart/form-data" method="POST">
		 <div class="container">
			<table id="addtable">
				<tr>
					<td>Name: </td>
					<td> <input type="text" name="name" required maxlength="45" pattern="[^']*[A-Za-z][^']*"/> </td>
				</tr>
				<tr>
					<td>Description: </td>
					<td> <input type="textarea" name="description" /> </td>
				</tr>
				<tr>	
					<td>Price: </td>
					<td> $ <input type="number" step=".01" name="price" required/> </td>
				</tr>
				<tr>	
					<td>Picture: </td>
					<td> <input type="hidden" name="MAX_FILE_SIZE" value="300000"> <input type="file" name="picture" required/> </td>
				</tr>
				<tr>
					<td>Shape: </td>
					<td> <select name="shape">
						<option value="1" selected>Butterfly</option>
						<option value="2">Classic</option>
						<option value="3">Imperial</option>
						<option value="4">Modified</option>
					</select> </td>
				</tr>					
				<tr>
					<td>Color: </td>
					<td> <input type="text" name="color" required/> </td>
				</tr>
				<tr>
					<td>Material: </td>
					<td> <select name="material">
						<option value="1" selected>Metal</option>
						<option value="2">Plastic</option>
						<option value="3">Wood</option>
					</select> </td>
				</tr>
				<tr>
					<td>Manufacturer: </td>
					<td> <input type="text" name="manufacturer" required/> </td>
				</tr>
				<tr>
					<td>Axle: </td>
					<td> <select name="axle">
						<option value="1" selected>Ball Bearing</option>
						<option value="2">Fixed</option>
						<option value="3">Transaxle</option>
					</select> </td>
				</tr>
			</table>
		</div>
		<input type="submit" value="Submit" />
	</form>
</div>
<?php include('footer.php');?>
