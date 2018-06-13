<?php
ini_set('display_errors',1);

include ('mysqli_connect.php');
// on checkout click send order data to a text file

// database query for order goes here
/*
$q = "SELECT u.id, fname, lname, email, i.name FROM USER u, PURCHASE p, ITEM i WHERE u.id = p.USER_id and email = 'dgreening@camosun.bc.ca';";
*/
$q = "SELECT * FROM USER;";

// root directory where file should be created and stored
$file = "/home/student/cst136/myfiles/testreceipt.txt";
// creates or opens file at location
$fileHandler = fopen($file, 'w') or die("can't open file");

// Get selected info from database
$rq = mysqli_query($dbc,$q);
// Convert sql data to string
$receiptQuery = strval($rq);
// Write to text file the receipt data from database
fwrite($fileHandler, $receiptQuery);
// Write to text file email message confirmation
$txt = "Thank you for your purchase we are processing your order, and we will ship your order in the next few days. Due to excess orders during this time please be patient about with status of your order. We will send you a tracking number as soon as shipping commences.";
fwrite($fileHandler, $txt);
fclose($fileHandler);
    // recommended by Jon 
?>