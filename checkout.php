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
  $total_str = number_format($total, 2, '.', '');
  print "<h3>Successfully Charged $total_str</h3>";

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
  $file = "/home/student/cst136/myfiles/$userid$email$orderid.txt";
  // creates or opens file at location
  $fileHandler = fopen($file, 'w') or die("can't open file");
  // database query for order goes here
  $q = "SELECT u.id, fname, lname, email, i.name, o.quantity, orderDate FROM USER u, PURCHASE p, ITEM i, ORDERITEM o, CART c WHERE u.id = p.USER_id AND c.USER_id = p.USER_id AND c.ITEM_id = o.ITEM_id AND i.id = o.ITEM_id AND c.quantity = o.quantity AND p.id = o.PURCHASE_id AND u.id = '$userid' AND p.id = '$orderid';";
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
  // writes send address email
  $sendAdd = "$email\n\n";
  fwrite($fileHandler, $sendAdd);
  // writes users first and last names
  $rQUser = "$userid $fname $lname\n\n";
  fwrite($fileHandler, $rQUser);
  // writes order datetime
  $dateTime = "$datetime\n\n";
  fwrite($fileHandler, $dateTime);
  // writes heading of product

  $heading = "Quantity | Item Name\n";
  fwrite($fileHandler, $heading);
  $underline = "______________________\n";
  fwrite($fileHandler, $underline);
  // writes order item(s) using a while loop
  while ($row = mysqli_fetch_array($rq)){
      $iQuan = $row['quantity'];
      $iName = $row['name'];
      $order = "$iQuan     $iName\n";
      fwrite($fileHandler, $order);
  }
  // Write to text file email message confirmation
  $txt = "\nThank you for your purchase! We have confirmed that we received your payment, and now processing your order. We hope to ship your order as soon as possible. Due to excess orders during this time please be patient with us. We will send you a tracking number as soon as shipping commences. Have a great day!";
  fwrite($fileHandler, $txt);
  fclose($fileHandler);

  // Empty the cart after the order is done
  $query = "DELETE FROM CART WHERE USER_id = $userid;";
  mysqli_query($dbc, $query);

  include('footer.php');
?>
