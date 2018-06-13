<?php
ini_set('display_errors',1);

include ('mysqli_connect.php');
// on checkout click send order data to a text file

// database query for order goes here
$q = "SELECT u.id, fname, lname, email, i.name, orderDate FROM USER u, PURCHASE p, ITEM i WHERE u.id = p.USER_id and email = 'dgreening@camosun.bc.ca';";

if(!$result = $dbc->query($q)){
    die('There was an error running the query ['. $dbc->error.']');
}
// While loop to access results from database query
while($row = $result->fetch_assoc()){
    $userID = $row['id'];
    $fname = $row['fname'];
    $lname = $row['lname'];
    $email = $row['email'];
    $iName = $row['name'];
    $oDate = $row['orderDate'];
}
// Get selected info from database
$rq = mysqli_query($dbc,$q);
// root directory where file should be created and stored
$file = "/home/student/cst136/myfiles/testreceipt.txt";
// creates or opens file at location
$fileHandler = fopen($file, 'w') or die("can't open file");
// writes send address email
//$sendAdd = "$email\n";
//$fwrite($fileHandler, $sendAdd);
// writes users first and last names
$rQUser = "$fname $lname\n";
fwrite($fileHandler, $rQUser);
// writes order item and datetime
$order = "$iName $oDate\n";
fwrite($fileHandler, $order);
// Write to text file email message confirmation
$txt = "Thank you for your purchase! We have confirmed that we received your payment, and now processing your order. We hope to ship your order as soon as possible. Due to excess orders during this time please be patient with us. We will send you a tracking number as soon as shipping commences. Have a great day!";
fwrite($fileHandler, $txt);
fclose($fileHandler);
    // recommended by Jon 
?>