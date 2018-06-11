
<!--Dropdown in nav bar-->
<div class="w3-container">
	<div class="w3-bar w3-light-grey" style="height: 70px;">
	    <p></p>
		<a href="#" class="w3-bar-item w3-button">Home</a>
		<a href="index.php" class="w3-bar-item w3-button">Shop</a>
		<div class="w3-dropdown-hover">
			<button class="w3-button">Account</button>
			<div class="w3-dropdown-content w3-card-4">
				 <a href="login.php" class="w3-bar-item w3-button">Log in</a>
				 <a href="register.php" class="w3-bar-item w3-button">Register</a>
				 <a href="logout.php" class="w3-bar-item w3-button">Logout</a>
				 
			</div>
		</div>


<!--This script is for the mini shopping cart in nav bar-->
<link href="bootstrap3/css/bootstrap.css" rel="stylesheet" />
<link href="style/login-register.css" rel="stylesheet" />
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
<script src="jquery/jquery-1.10.2.js" type="text/javascript"></script>
<script src="bootstrap3/js/bootstrap.js" type="text/javascript"></script>
<script src="js/login-register.js" type="text/javascript"></script>



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

<!--mini shopping cart in nav bar-->
<a href="#"  class="cart-box" id="cart-info" title="View Cart">

<?php

 //ini_set('display_errors',1);
 include_once('mysqli_connect.php');
 
  if (isset($_SESSION["logged_in"])) {
    $userid = $_SESSION['userid'];
    $query = "SELECT * FROM CART WHERE USER_id = $userid;";
    $result = mysqli_query($dbc, $query);
    if ($result) {
      echo mysqli_num_rows($result);
    }
  }
  elseif(isset($_SESSION["products"])) {
    echo count($_SESSION["products"]);
  } else {
    echo 0;
  }

if (isset($_POST['empty_cart'])) {
	    // session_desrtoy();
		unset($_SESSION['products']);
		$userid = $_SESSION['userid'];
		$query = "delete from CART WHERE USER_id = $userid;";
		$result = mysqli_query($dbc, $query);
}
?>

</a>

<div class="shopping-cart-box" >
<a href="#" class="close-shopping-cart-box" >Close</a>
<h3>Your Shopping Cart</h3>
<form action="" method="post">
<p><input type="image" src="images/x_2.png" alt="submit" name="empty_cart" value="empty_cart">&nbsp;empty cart</p>
</form>
    <div id="shopping-cart-results" >
    </div>
</div>
</div>

