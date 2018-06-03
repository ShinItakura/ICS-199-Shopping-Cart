<?php
$db_host = 'localhost'; // Server Name
$db_user = 'cst118'; // Username
$db_pass = '127996'; // Password
$db_name = 'ICS199Group13_dev'; // Database Name

$connect = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$connect) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}
?>
