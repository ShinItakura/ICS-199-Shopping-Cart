<?php
session_start(); //start session
include_once("mysqli_connect.php"); //include config file
setlocale(LC_MONETARY,"en_US"); // US national format (see : http://php.net/money_format)
############# add products to cart #########################
if(isset($_POST["id"]))
{
	foreach($_POST as $key => $value){
		$new_product[$key] = filter_var($value, FILTER_SANITIZE_STRING); //create a new product array
	}

  //Add item to cart table of database
  if (isset($_SESSION["logged_in"])) {
    $userid = $_SESSION["userid"];
    $itemid = $new_product['id'];
    $quantity = $_POST["quantity"];
    $query = "INSERT INTO CART (ITEM_id, USER_id, quantity) 
      VALUES ($itemid, $userid, $quantity)
      ON DUPLICATE KEY UPDATE quantity = $quantity;";
    mysqli_query($dbc, $query);

    $query = "SELECT * FROM CART WHERE USER_id = $userid;";
    $result = mysqli_query($dbc, $query);
    $total_items = mysqli_num_rows($result);

    die(json_encode(array('items'=>$total_items))); //output json

  } else {
    //Add item to session storage
    
    $statement = $dbc->prepare("SELECT name, price FROM ITEM WHERE id=? LIMIT 1");
    $statement->bind_param('s', $new_product['id']);
    $statement->execute();
    $statement->bind_result($name, $price);


    while($statement->fetch()){
      $new_product["name"] = $name; //fetch product name from database
      $new_product["price"] = $price;  //fetch product price from database

      if(isset($_SESSION["products"])){  //if session var already exist
        if(isset($_SESSION["products"][$new_product['id']])) //check item exist in products array
        {
          unset($_SESSION["products"][$new_product['id']]); //unset old item
        }
      }

      $_SESSION["products"][$new_product['id']] = $new_product;	//update products with new item array
    }


    $total_items = count($_SESSION["products"]); //count total items
    die(json_encode(array('items'=>$total_items))); //output json
  }
}

################## list products in cart ###################
if(isset($_POST["load_cart"]) && $_POST["load_cart"]==1)
{
    if (isset($_SESSION["logged_in"])) {
      $cart_box = '<ul class="cart-products-loaded">';
      $total = 0;
      $userid = $_SESSION["userid"];
      $query = "SELECT i.id, i.name, i.price, c.quantity FROM ITEM i 
        JOIN CART c on i.id = c.ITEM_id WHERE c.USER_id = $userid;";
      $result = mysqli_query($dbc, $query);

    if ($result) {
        while($row = mysqli_fetch_array($result)) {
          $name = $row["name"];
          $price = $row["price"];
          $id = $row["id"];
          $quantity = $row["quantity"];

          $cart_box .=  "<li> $name (Qty : $quantity) &mdash; $currency ".sprintf("%01.2f", ($price * $quantity)). " <a href=\"#\" class=\"remove-item\" data-code=\"$id\">&times;</a></li>";
          $subtotal = ($price * $quantity);
          $total = ($total + $subtotal);
        }
        $cart_box .= "</ul>";
        $cart_box .= '<div class="cart-products-total">Total : '.$currency.sprintf("%01.2f",$total).' <u><a href="view_cart.php" title="Review Cart and Check-Out">Review Cart and Check-Out</a></u></div>';
      die($cart_box); //exit and output content
    } else {
      die("Your Cart is empty"); //we have empty cart
    }
  } else {
    //Use session storage
    if(isset($_SESSION["products"]) && count($_SESSION["products"])>0){ //if we have session variable
        $cart_box = '<ul class="cart-products-loaded">';
        $total = 0;
        foreach($_SESSION["products"] as $product){ //loop though items and prepare html content

          //set variables to use them in HTML content below
          $name = $product["name"];
          $price = $product["price"];
          $id = $product["id"];
          $quantity = $product["quantity"];
          // $product_color = $product["product_color"];
          // $product_size = $product["product_size"];

          $cart_box .=  "<li> $name (Qty : $quantity) &mdash; $currency ".sprintf("%01.2f", ($price * $quantity)). " <a href=\"#\" class=\"remove-item\" data-code=\"$id\">&times;</a></li>";
          $subtotal = ($price * $quantity);
          $total = ($total + $subtotal);
        }
        $cart_box .= "</ul>";
        $cart_box .= '<div class="cart-products-total">Total : '.$currency.sprintf("%01.2f",$total).' <u><a href="view_cart.php" title="Review Cart and Check-Out">Review Cart and Check-Out</a></u></div>';
        die($cart_box); //exit and output content
      }else{
        die("Your Cart is empty"); //we have empty cart
      }
  }
}

################# remove item from shopping cart ################
if (isset($_GET["remove_code"]))
{
  if (isset($_SESSION["logged_in"])) {
    $id = filter_var($_GET["remove_code"], FILTER_SANITIZE_STRING); //get the product code to remove

    $userid = $_SESSION["userid"];
    $query = "DELETE FROM CART WHERE USER_id = $userid AND ITEM_id = $id;";
    mysqli_query($dbc, $query);
    
    $query = "SELECT * FROM CART WHERE USER_id = $userid;";
    $result = mysqli_query($dbc, $query);
    $total_items = mysqli_num_rows($result);

    die(json_encode(array('items'=>$total_items)));
  } else {
    //Use session storage
    if(isset($_GET["remove_code"]) && isset($_SESSION["products"])) {
      $id   = filter_var($_GET["remove_code"], FILTER_SANITIZE_STRING); //get the product code to remove

      if(isset($_SESSION["products"][$id]))
      {
        unset($_SESSION["products"][$id]);
      }

      $total_items = count($_SESSION["products"]);
      die(json_encode(array('items'=>$total_items)));
    }
  }
}
