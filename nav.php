


<div class="w3-container">


	<div class="w3-bar w3-light-grey" style="height: 70px;">
	    <p></p>
	    <p></p>

		<a href="#" class="w3-bar-item w3-button">Home</a>
		<a href="#" class="w3-bar-item w3-button">Shop</a>
		<div class="w3-dropdown-hover">
			<button class="w3-button">Sign in</button>
			<div class="w3-dropdown-content w3-card-4">
				<a href="#" class="w3-bar-item w3-button">Log in</a>
				<a href="#" class="w3-bar-item w3-button">My account</a>
				<a href="#" class="w3-bar-item w3-button">Register</a>
				<a href="#" class="w3-bar-item w3-button">Administrator</a>
			</div>
		</div>
<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
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
				alert("Item added to Cart!"); //alert user
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



<a href="#"  class="cart-box" id="cart-info" title="View Cart">
<?php
if(isset($_SESSION["products"])){
	echo count($_SESSION["products"]);
}else{
	echo 0;
}
?>
</a>

<div class="shopping-cart-box" >
<a href="#" class="close-shopping-cart-box" >Close</a>
<h3>Your Shopping Cart</h3>
    <div id="shopping-cart-results" >
    </div>
</div>


</div>
