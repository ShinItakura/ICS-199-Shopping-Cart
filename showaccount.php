<head>
    <title>My Account</title>
    <style>
            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }
            td, th {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }
            tr:nth-child(even) {
                background-color: #dddddd;
            }
        </style>
</head>
<?php 
ini_set('display_errors',1);

// Set the page title and include the HTML header:

include ('mysqli_connect.php');
 
// Default query for this page:
//$q = "SELECT fname, lname, id, ORDER_id, orderDate, name, quantity from USER u, ORDER o, ORDERITEM oi, ITEM i WHERE u.id = o.USER_id;";
$q = "SELECT * FROM USER;";
// Create the table head:

echo '<table border="0" width="90%" cellspacing="3" cellpadding="3" align="center">
	<tr>
        <td align="left" width="20%"><b>User ID</b></td>
        <td align="left" width="20%"><b>Order ID</b></td>
        <td align="left" width="20%"><b>Order Date</b></td>
        <td align="left" width="20%"><b>Product Name</b></td>
        <td align="left" width="20%"><b>Quantity</b></td>
	</tr>';

// Display all the prints, linked to URLs:
$r = mysqli_query ($dbc, $q);
while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC)) {
    // Display user name: 
    echo "<h1>{$row['fname']} {$row['lname']}</h1>";
	// Display each record:
	/*echo "\t<tr>
        <td align=\"left\">{$row['id']}</td>
        <td align=\"left\">{$row['ORDER_id']}</td>
        <td align=\"left\">{$row['orderDate']}</td>
        <td align=\"left\">{$row['name']}</td>
        <td align=\"left\">{$row['quantity']}</td>
	</tr>\n";*/
    
} // End of while loop.

echo '</table>';
mysqli_close($dbc);
//include ('includes/footer.html');
?>