<?php
  include('header.php');
  include('mysqli_connect.php');
  session_start();
  ini_set('display_errors',1);
  $userid = $_SESSION['userid'];
  $query = "SELECT i.id, i.price, c.quantity FROM ITEM i 
    JOIN CART c ON i.id = c.ITEM_id 
    WHERE USER_id = $userid;";
  $result = mysqli_query($dbc, $query);
  $subtotal = 0;
  while ($row = mysqli_fetch_array($result)) {
    $subtotal += $row['price'] * $row['quantity'];
  }
  $total = round($subtotal*1.05, 2); 
  require_once('./config.php');

  $token  = $_POST['stripeToken'];
  $email  = $_POST['stripeEmail'];

  $customer = \Stripe\Customer::create(array(
      'email' => $email,
      'source'  => $token
  ));

  $charge = \Stripe\Charge::create(array(
      'customer' => $customer->id,
      'amount'   => $total*100,
      'currency' => 'cad'
  ));
  print "<h3>Successfully Charged $total</h3>";

  $datetime = date("Y-m-d H:i:s");
  $query = "INSERT INTO PURCHASE (USER_id, orderDate, total) VALUES ($userid, '$datetime', $total);
            SELECT LAST_INSERT_ID();";
  mysqli_multi_query($dbc, $query);
  mysqli_next_result($dbc);
  $result = mysqli_store_result($dbc);
  $orderid = mysqli_fetch_array($result)[0];

  $query = "SELECT ITEM_id, quantity FROM CART WHERE USER_id = $userid;";
  $result = mysqli_query($dbc, $query);
  while ($row = mysqli_fetch_array($result)) {
    $itemid = $row['ITEM_id'];
    $quantity = $row['quantity'];
    $query = "INSERT INTO ORDERITEM (ITEM_id, PURCHASE_id, quantity) 
      VALUES ($itemid, $orderid, $quantity);";
    mysqli_query($dbc, $query) or die(mysqli_error($dbc));
  }
  include('footer.php');
?>
