
<!doctype html>
<html>


<head>
<meta charset="UTF-8">
<title> Shopping Cart</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!--<link rel="stylesheet" type="text/css" href="cart.css">-->

<link href="bootstrap3/css/bootstrap.css" rel="stylesheet" />
<link href="style/login-register.css" rel="stylesheet" />
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
<script src="jquery/jquery-1.10.2.js" type="text/javascript"></script>
<script src="bootstrap3/js/bootstrap.js" type="text/javascript"></script>
<script src="js/login-register.js" type="text/javascript"></script>
<link rel="stylesheet" href="style/style.css">



</head>


<body>

 

	<!-- container -->
	<div class="d"><img src="images/YoYo_LOGO_4.jpg"></div> <!-- the ending div lokks to be a problem -->
		
	   
	   <div class="e">
	   <?php
	   session_start(); //start session
	   include_once(mysqli_connect.php);
	   //ini_set('display_errors',1);
       $query3 = "SELECT fname,lname,role FROM USER WHERE id = {$_SESSION['userid']}";
	   $result2=mysqli_query($dbc, $query3);

		$test = mysqli_fetch_array($result2);
		$username = $test['fname'];
		$username2 = $test['lname'];
		$userrole = $test['role'];
		echo "<p class='f'> Welcome $userrole &ensp; $username &ensp;$username2</p>";
		echo "<p class='f'><a href='user.php'>&ensp;Go to your account page</a></p>";	
        ?>
	   </div>
	   
	

<?php include('nav.php');?>
