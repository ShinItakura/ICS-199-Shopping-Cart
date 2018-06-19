<meta charset="UTF-8">

<!-- Custom / Directory-->
<link rel="stylesheet" href="style/style.css">
<link href="style/login-register.css" rel="stylesheet" />
<link href="bootstrap3/css/bootstrap.css" rel="stylesheet" />
<!--<link rel="stylesheet" type="text/css" href="cart.css">-->

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<!-- javascript library -->
<script src="js/login-register.js" type="text/javascript"></script>
<script src="bootstrap3/js/bootstrap.js" type="text/javascript"></script>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="jquery/jquery-1.10.2.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>

<meta name="viewport" content="width=device-width, initial-scale=1">

<!--This script is for the mini shopping cart in nav bar-->
<script>
$(document).ready(function(){
		$(".form-item").submit(function(e){
			var form_data = $(this).serialize();
			var button_content = $(this).find('button[type=submit]');
			button_content.html('Adding...'); //Loading button text

			$.ajax({ //make ajax request to cart_process.php
				url: "cart_process.php",
				type: "POST",
				dataType:"json", //expect json value from server
				data: form_data
			}).done(function(data){ //on Ajax success
				$("#cart-info").html(data.items); //total items in cart-info element
				button_content.html('Add to Cart'); //reset button text to original text
				// alert("Item added to Cart!"); //alert user
				if($(".shopping-cart-box").css("display") == "block"){ //if cart box is still visible
					$(".cart-box").trigger( "click" ); //trigger click to update the cart box.
				}
			})
			e.preventDefault();
		});

	//Show Items in Cart
	$( ".cart-box").click(function(e) { //when user clicks on cart box
		e.preventDefault();
		$(".shopping-cart-box").fadeIn(); //display cart box
		$("#shopping-cart-results").html('<img src="images/ajax-loader.gif">'); //show loading image
		$("#shopping-cart-results" ).load( "cart_process.php", {"load_cart":"1"}); //Make ajax request using jQuery Load() & update results
	});

	//Close Cart
	$( ".close-shopping-cart-box").click(function(e){ //user click on cart box close link
		e.preventDefault();
		$(".shopping-cart-box").fadeOut(); //close cart-box
	});

	//Remove items from cart
	$("#shopping-cart-results").on('click', 'a.remove-item', function(e) {
		e.preventDefault();
		var pcode = $(this).attr("data-code"); //get product code
		$(this).parent().fadeOut(); //remove item element from box
		$.getJSON( "cart_process.php", {"remove_code":pcode} , function(data){ //get Item count from Server
			$("#cart-info").html(data.items); //update Item count in cart-info
			$(".cart-box").trigger( "click" ); //trigger click on cart-box to update the items list
		});
	});

});
</script>
</head>

<body>
	<?php 
	session_start(); //start session
	include_once('mysqli_connect.php');
	?>
	
	<!-- container -->
	<div class="d"><img src="images/YoYo_LOGO_4.jpg"></div>   
		<div class="e">
		<?php
		if (!isset($_SESSION['userid'])) {
			echo "<p class='f'> Welcome Guest</p>";
		} else {
		$query3 = "SELECT fname,lname,role FROM USER WHERE id = {$_SESSION['userid']}";
		$result2=mysqli_query($dbc, $query3);

		$test = mysqli_fetch_array($result2);
		$username = $test['fname'];
		$username2 = $test['lname'];
		$userrole = $test['role'];
		echo "<p class='f'> Welcome $userrole: $username $username2</p>";
		echo "<p class='f'><a href='user.php' style='color:#ffffff';>&ensp;Go to your account page</a></p>";	
		}
        ?>
	   </div>	   	
	<?php include('nav.php'); ?>

