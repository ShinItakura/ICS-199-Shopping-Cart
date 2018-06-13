<?php
ini_set('display_errors',1);

include ('mysqli_connect.php');
// on checkout click send order data to a text file

// database query for order goes here
$q = "SELECT u.id, fname, lname, email, i.name, o.quantity, orderDate FROM USER u, PURCHASE p, ITEM i, ORDERITEM o, CART c WHERE u.id = p.USER_id AND c.USER_id = p.USER_id AND c.ITEM_id = o.ITEM_id AND i.id = o.ITEM_id AND c.quantity = o.quantity AND p.id = o.PURCHASE_id AND email = '{$_POST['email']}' AND orderDate = '{$_POST['orderDate']}';";
// kill when error running query
if(!$result = $dbc->query($q)){
    die('There was an error running the query ['. $dbc->error.']');
}
// While loop to access results from database query
while($row = $result->fetch_assoc()){
    $userID = $row['id'];
    $fname = $row['fname'];
    $lname = $row['lname'];
    $email = $row['email'];
    $oDate = $row['orderDate'];
}
// Get selected info from database
$rq = mysqli_query($dbc,$q);
// root directory where file should be created and stored for security measures myfiles directory is set to CHMOD 777
$file = "/home/student/cst136/myfiles/{$_POST['id']}{$_POST['fname']}{$_POST['lname']}{$_POST['orderDate']}.txt";
// creates or opens file at location
$fileHandler = fopen($file, 'w') or die("can't open file");
// writes send address email
$sendAdd = "$email\n\n";
fwrite($fileHandler, $sendAdd);
// writes users first and last names
$rQUser = "$userID $fname $lname\n\n";
fwrite($fileHandler, $rQUser);
// writes order datetime
$dateTime = "$oDate\n\n";
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
    // recommended by Jon 
?>