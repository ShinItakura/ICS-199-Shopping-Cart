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
$q = "SELECT fname, lname, id from USER u, ORDER o Where u.id = o.USER_id;";



// Create the table head:
echo '<table border="0" width="90%" cellspacing="3" cellpadding="3" align="center">
	<tr>
		<td align="left" width="20%"><b>First name</b></td>
		<td align="left" width="20%"><b>Last name</b></td>
        <td align="left" width="20%"><b>User ID</b></td>
		<td align="left" width="20%"><b>Order Date</b></td>
	</tr>';

// Display all the prints, linked to URLs:
$r = mysqli_query ($dbc, $q);
while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC)) {

	// Display each record:
	echo "\t<tr>
		<td align=\"left\">{$row['fname']}</td>
		<td align=\"left\">{$row['lname']}</td>
        <td align=\"left\">{$row['id']}</td>
        <td align=\"left\">{$row['orderDate']}</td>
	</tr>\n";

} // End of while loop.

echo '</table>';
mysqli_close($dbc);
//include ('includes/footer.html');
?>