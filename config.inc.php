<?php
$db_username        = 'cst118'; //MySql database username
$db_password        = '127996'; //MySql dataabse password
$db_name            = 'ICS199Group13_dev'; //MySql database name
$db_host            = 'localhost'; //MySql hostname or IP

$currency			= '&#36; '; //currency symbol
$shipping_cost		= 1.50; //shipping cost
$taxes				= array( //List your Taxes percent here.
							// 'VAT' => 12,
							'GST' => 5,
							// 'Other Tax' => 10
							);

$mysqli_conn = new mysqli($db_host, $db_username, $db_password,$db_name); //connect to MySql
if ($mysqli_conn->connect_error) {//Output any connection error
    die('Error : ('. $mysqli_conn->connect_errno .') '. $mysqli_conn->connect_error);
}
