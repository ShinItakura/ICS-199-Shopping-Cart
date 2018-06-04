<?php
ini_set('display_errors',1);

include ('mysqli_connect.php');
// on checkout click send order data to a text file

// database query for order goes here
$q = "SELECT id,fname,lname,orderDate FROM USER u, ORDER o;";

// Get info from data base while loop
$r = mysqli_query ($dbc, $q);
while($row = mysqli_fetch_array ($r, MYSQLI_ASSOC)){
    //open file and write
    $myfile = fopen("{$row['id,fname, lname, orderDate']}.txt", "w") or die("Unable to open file!");
    $orderUser = $q;
    fwrite($myfile, $orderUser);
    $txt = "test/n";
    fwrite($myfile, $txt);
    fclose($myfile);
}

?>