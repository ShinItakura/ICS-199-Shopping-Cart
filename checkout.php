<!doctype html>
<html>
<head>
  <title>Checkout</title>
</head>
<?php
  include('mysqli_connect.php');
  session_start();
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
  $total_str = number_format($total, 2, '.', '');
//  print "<h3>Successfully Charged $$total_str</h3>";

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
  // on checkout click send order data to a text file

  // root directory where file should be created and stored for security measures myfiles directory is set to CHMOD 777
  $file = "/home/student/cst136/myfiles/OrderNum-$orderid-UserID-$userid-Email-$email.txt";
  // creates or opens file at location
  $fileHandler = fopen($file, 'w') or die("can't open file");
  // database query for order goes here
  $q = "SELECT u.id, fname, lname, email, i.name, i.price, o.quantity, orderDate, p.total FROM USER u, PURCHASE p, ITEM i, ORDERITEM o, CART c WHERE u.id = p.USER_id AND c.USER_id = p.USER_id AND c.ITEM_id = o.ITEM_id AND i.id = o.ITEM_id AND c.quantity = o.quantity AND p.id = o.PURCHASE_id AND u.id = '$userid' AND p.id = '$orderid';";
  // kill when error running query
  if(!$res = $dbc->query($q)){
      die('There was an error running the query ['. $dbc->error.']');
  }
  // Get selected info from database
  $rq = mysqli_query($dbc,$q);
  //access results from database query
  $row = $res->fetch_assoc();
  $userid = $row['id'];
  $fname = $row['fname'];
  $lname = $row['lname'];
  $email = $row['email'];
  $oDate = $row['orderDate'];
  $total = $row['total'];
  // writes send address email
  $sendAdd = "Email Address : $email\n\n";
  fwrite($fileHandler, $sendAdd);
  // writes heading for user id, first, and last names
  $userHeading = "Order ID | User ID | User Name\n";
  fwrite($fileHandler, $userHeading);
  // writes underline
  $underline = "________________________________________________________________________________\n";
  fwrite($fileHandler, $underline);
  // writes order id, user id, and users first and last names
  $rQUser = "$orderid       | $userid      | $fname $lname\n";
  fwrite($fileHandler, $rQUser);
  // writes underline
  fwrite($fileHandler, $underline);
  // writes order datetime
  $dateTime = "Order Date : $datetime\n";
  fwrite($fileHandler, $dateTime);
  // writes underline
  fwrite($fileHandler, $underline);
  // writes heading of product
  $heading = "Quantity | Price | Item Name\n";
  fwrite($fileHandler, $heading);
  // write underline
  fwrite($fileHandler, $underline);
  // writes order item(s) using a while loop
  while ($row = mysqli_fetch_array($rq)){
      $iQuan = $row['quantity'];
      $iName = $row['name'];
      $iPrice = $row['price'];        
      $order = "$iQuan      | $iPrice | $iName\n";
      fwrite($fileHandler, $order);
  }
  // writes underline    
  fwrite($fileHandler, $underline);
  // writes price total
  $totalCost = "                                                                 Total : $total\n";
  fwrite($fileHandler, $totalCost);
  // writes underline
  fwrite($fileHandler, $underline);
  // Write to text file email message confirmation
  $txt = "\nThank you for your purchase! We have confirmed that we received your payment,\n and now processing your order. We hope to ship your order as soon as possible.\n Due to excess orders during this time please be patient with us.\n We will send you a tracking number as soon as shipping commences.\n Have a great day!";
  fwrite($fileHandler, $txt);
  fclose($fileHandler);

  // Empty the cart after the order is done
  $query = "DELETE FROM CART WHERE USER_id = $userid;";
  mysqli_query($dbc, $query);
  
  // Content displayed to page
  include('header.php');
  print "<h3>Successfully Charged $$total_str</h3>";
  include('footer.php');
?>
