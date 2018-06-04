
<!doctype html>
<html>


<head>
<meta charset="UTF-8">
<title> Shopping Cart in PHP & Mysql</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="cart.css">




</head>


<body>



	<!-- container -->
	<div class="container">
		<div class="row">

		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo isset($page_title) ? $page_title : "Yo Yo Ma's House of Yo-Yo's"; ?></h1>
			</div>
		</div>

<?php
include 'nav.php';
?>
