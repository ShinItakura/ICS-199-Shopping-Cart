<div class="w3-container">
	<div class="w3-bar w3-light-grey" style="height: 70px;">
	    <p></p>
		<a href="home.php" class="w3-bar-item w3-button">Home</a>
		<a href="index.php" class="w3-bar-item w3-button">Shop</a>
		<div class="w3-dropdown-hover">
			<button class="w3-button">Account</button>
			<div class="w3-dropdown-content w3-card-4">
				 <a href="login.php" class="w3-bar-item w3-button">Log in</a>
				 <a href="register.php" class="w3-bar-item w3-button">Register</a>
				 <a href="logout.php" class="w3-bar-item w3-button">Logout</a>
				 
			</div>
		</div>
<!--mini shopping cart in nav bar-->
	<a href="#"  class="cart-box" id="cart-info" title="View Cart">

<?php
    if (isset($_POST['empty_cart'])) {
            // session_desrtoy();
            unset($_SESSION['products']);
            $userid = $_SESSION['userid'];
            $query = "delete from CART WHERE USER_id = $userid;";
            $result = mysqli_query($dbc, $query);
    }

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

