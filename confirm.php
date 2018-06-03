<?php
ini_set('display_errors',1);

inclued ('mysqli_connect.php');
// on checkout click send order data to a text file

// database query for order goes here
$q = "SELECT * FROM USER;";

// Get info from data base while loop
$r = mysqli_query ($dbc, $q);
while($row = mysqli_fetch_array ($r, MYSQLI_ASSOC)){
    //open file and write
    $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
    $txt = $q;
    fwrite($myfile, $txt);
    $txt = "Jane Doe\n";
    fwrite($myfile, $txt);
    fclose($myfile);
}

?>