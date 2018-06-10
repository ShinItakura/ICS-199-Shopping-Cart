<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<style>
<style>
* {
		box-sizing: border-box;
}

/* Style the body */
body {
	font-family: "Open Sans", sans-serif;
	line-height: 1.25;
}
table {
	border: 1px solid #ccc;
	border-collapse: collapse;
	table-layout: fixed;
	width: 80%;
}
table caption {
	font-size: 1.5em;
	margin: .5em 0 .75em;
}
table tr {
	border: 1px solid #ddd;
	padding: .35em;
}
table tr:nth-child(even) {
	background: #f8f8f8;  
}
table th,
table td {
	padding: .625em;
	text-align: left;
}
table th {
	background: rgba(125, 125, 125, 1.0); 
	color: white;
	font-size: .85em;
	letter-spacing: .1em;
	text-transform: uppercase;
	width: 30%;
}
table td {
	white-space: nowrap;
	overflow: hidden;
	text-overflow: ellipsis;
}



/* Style the navigation bar links */


/* Column container */
.row {  
		display: flex;
		flex-wrap: wrap;
		
}

/* Create two unequal columns that sits next to each other */
/* Sidebar/left column */
.side {
		flex: 20%;
		background-color: #f1f1f1;
		padding: 20px;
}

/* Main column */
.main {
		flex: 75%;
		background-color: white;
		padding: 10px;
		
		
}

/* Fake image, just for this example */
.fakeimg {
		background-color: white;
		width: 100%;
		padding: 20px;
		height: 1000px;
}



/* Responsive layout - when the screen is less than 700px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 700px) {
		.row, .navbar {   
				flex-direction: column;
		}
}
</style>
</head>
<body>
<?php

ini_set('display_errors',1);

$query1= mysql_query("SELECT * FROM USERS WHERE username = $_SESSION['username']");
$result1=mysql_query($dbc, $query1);

while($userData = mysqli_fetch_array($results1)){
echo '<form action="order.php" method="POST">';

echo '<table>';
	
	echo '<tbody>';
		echo '<tr>'; 
		    echo '<th scope="col">User ID</th>';
			echo '<td>'.$userData['id'].'</td>';						
		echo'</tr>';
	echo '</tbody>';
	
	echo '<tbody>';
		echo '<tr>';
			echo'<th scope="col">First Name</th>';
			echo '<td>'.$userData['fname'].'</td>';	
		echo'</tr>';			
	echo '</tbody>';
	
	echo '<tbody>';
		echo '<tr>';
			echo'<th scope="col">Last Name</th>';
			echo '<td>'.$userData['lname'].'</td>';	
		echo'</tr>';				
	echo '</tbody>';
	
	echo '<tbody>';
		echo '<tr>';
			echo'<th scope="col">Address</th>';
			echo '<td>'.$userData['street_address'].'</td>';	
		echo'</tr>';				
	echo '</tbody>';
	
	echo '<tbody>';
		echo '<tr>';
			echo'<th scope="col">City</th>';
			echo '<td>'.$userData['city'].'</td>';	
		echo'</tr>';				
	echo '</tbody>';
	
	echo '<tbody>';
		echo '<tr>';
			echo'<th scope="col">Country</th>';
			echo '<td>'.$userData['counrty'].'</td>';
		echo'</tr>';				
	echo '</tbody>';
	
	echo '<tbody>';
		echo '<tr>';
			echo'<th scope="col">Postal Code</th>';
			echo '<td>'.$userData['postalcode'].'</td>';	
		echo'</tr>';				
	echo '</tbody>';
	
echo '</table>';
?>

<?php

$query2 =mysql_query("SELECT * 
        FROM USERS 
		JOIN ORDERS ON
		USERS.id=ORDERS.id
		JOIN items ON
		ORDERS.id=items.id		
		WHERE USERS.username = $_SESSION['username']
		AND ORDER BY orderDate DESC;");

// "SELECT i.name,i.price,o.orderDate,o.ORDERS_id FROM ORDER o, ITEM i GROUP BY ORDERS_id ORDER BY orderDate DESC;";

$result2=mysql_query($dbc, $query2);

while($orderData = mysqli_fetch_array($results2)){
echo '<form action="order.php" method="POST">';

echo '<table border="1">';
	echo '<tr>';
		echo '<th>Order ID</th>';
		echo '<th>Item ID</th>';
		echo '<th>Product Name</th>';
		echo '<th>Price</th>';
		echo '<th>Order Date</th>';
	echo '</tr>';
	
	echo '<td>'.$orderData['ORDERS.ORDERS_id'].'</td>';
	echo '<td>'.$orderData['ITEM.ITEM_id'].'</td>';
	echo '<td>'.$orderData['USERS.name'].'</td>';
	echo '<td>'.$orderData['ITEM.price'].'</td>';
	echo '<td>'.$orderData['ORDERS.orderDate'].'</td>';
echo '</table>';

}

?>


// Use Session username
$query = mysql_query("SELECT * FROM USERS WHERE username = $_SESSION['username']");


// Two
$query1 = mysql_query("SELECT USERS.fname , USERS.lname , ORDERS.CART_id
		 FROM USERS ,ORDERS
         WHERE ORDERS.id = USERS.id
         AND USERS.username = $_SESSION['username']");

// Two
$query1 = mysql_query("SELECT ITEM.id, ITEM.name, ITEM.name, ORDERS.CART_id
		    FROM USERS ,ORDERS
			WHERE ORDERS.id = USERS.id
			AND USERS.username = $_SESSION['username']");



// Three way
$query2 =mysql_query("SELECT * FROM USERS 
			JOIN ORDERS ON
			USERS.id=ORDERS.id
			JOIN items ON
			ORDERS.id=items.id;");

// Three way
$query3 = mysql_query("Select USERS.lname, ORDERS.id, item.id   // Select *
			INNER JOIN TICKETS ON USERS.id = ORDERS.id
			INNER JOIN CUSTOMERS ON ORDERS.id = cart.id
			ORDER BY orderDate DESC;"); 




