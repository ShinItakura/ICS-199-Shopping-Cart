<?php
ini_set('display_errors',1);

include ('mysqli_connect.php');
// on checkout click send order data to a text file

// database query for order goes here
$q = "SELECT fname,lname, email, u.id, i.name from ICS199Group13_dev.USER u, ICS199Group13_dev.PURCHASE p, ICS199Group13_dev.ITEM i WHERE u.id = p.USER_id and email = '{$_POST['email']}}';";

// Get info from data base while loop
$r = mysqli_query ($dbc, $q);
while($row = mysqli_fetch_array ($r, MYSQLI_ASSOC)){
    //open file and write
    $myfile = fopen("{$row['id,fname, lname, orderDate']}.txt", "w") or die("Unable to open file!");
    // user email
    $email = {$row['email']};
    fwrite($myfile, $email);
    $orderUser = $q;
    fwrite($myfile, $orderUser);
    $txt = "Thank you for your purchase we are processing your order, and we will ship your order in the next few days. Due to excess orders during this time please be patient about with status of your order. We will send you a tracking number as soon as shipping commences.";
    fwrite($myfile, $txt);
    fclose($myfile);
    // recommended by Jon 
}

?>