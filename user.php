

 

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

<?php include('header.php'); ?>

<body>
<br>
 <div class="row">
	<div class="side">
			<h2 align="center">My Account</h2>
			
			<div class="fakeimg" style="height:500px;" align="center"><img src="images/user_2.png" alt="Image" position="center">
				
			</div>
			
	</div>
			<div class="main">
				<h2><i class="fas fa-user"></i>&nbsp;Personal Information</h2>		
			<div class="fakeimg" style="height:1000px;">



<?php
session_start();
ini_set('display_errors',1);
include 'mysqli_connect.php';

$db = mysqli_connect('localhost', 'cst107','446287', 'ICS199Group13_dev');
$query =  "SELECT * FROM USER WHERE id = " . $_SESSION['userid'] . ";";
				
$result=mysqli_query($db, $query);


while($userData = mysqli_fetch_array($result)){
	
	
//echo'<form action="user.php" method="POST">';

echo'<table>';
	
	echo'<tbody>';
		echo'<tr>'; 
		    echo '<th scope="col">User ID</th>';
			echo '<td>'.$userData['id'].'</td>';						
		echo'</tr>';
	echo'</tbody>';
	
	echo'<tbody>';
		echo'<tr>';
			echo'<th scope="col">First Name</th>';
			echo '<td>'.$userData['fname'].'</td>';	
		echo'</tr>';			
	echo'</tbody>';
	
	echo'<tbody>';
		echo '<tr>';
			echo'<th scope="col">Last Name</th>';
			echo '<td>'.$userData['lname'].'</td>';	
		echo'</tr>';				
	echo'</tbody>';
	
	echo'<tbody>';
		echo '<tr>';
			echo'<th scope="col">Address</th>';
			echo'<td>'.$userData['address'].'</td>';	
		echo'</tr>';				
	echo'</tbody>';
	
	
	
	echo'<tbody>';
		echo'<tr>';
			echo'<th scope="col">Country</th>';
			echo'<td>'.$userData['country'].'</td>';
		echo'</tr>';				
	echo'</tbody>';
	
	echo'<tbody>';
		echo'<tr>';
			echo'<th scope="col">Postal Code</th>';
			echo'<td>'.$userData['postcode'].'</td>';	
		echo'</tr>';				
	echo'</tbody>';
	
echo'</table>';
echo'</form>';


}



//include 'mysqli_connect.php';
//$db = mysqli_connect('localhost', 'cst107','446287', 'ICS199Group13_dev');

//$query =  "SELECT * FROM USER WHERE id = " . $_SESSION['userid'] . ";";



$query2 ="select USER_id, ITEM_id, PURCHASE_id,quantity
			from ORDERITEM, PURCHASE 
			where PURCHASE.id = ORDERITEM.PURCHASE_id
			and PURCHASE.USER_id = " . $_SESSION['userid'] . " order by PURCHASE_id , ITEM_id";
			
#print "<h3> query2 = " . $query2 . "</h3>";			
			
$result2=mysqli_query($dbc, $query2);

echo "<br>";
echo '<table border="1">';
	echo '<tr>';
		echo '<th>Order ID</th>';
		echo '<th>Item ID</th>';
		echo '<th>Product Name</th>';
		echo '<th>Price</th>';
		echo '<th>Order Date</th>';
	echo '</tr>';

while($orderData = mysqli_fetch_array($result2)){
	echo "<tr>";
	echo '<td>'.$orderData['PURCHASE_id'].'</td>';
	echo '<td>'.$orderData['ITEM_id'].'</td>';
	echo '<td>'.$orderData['USER_id'].'</td>';
	echo '<td>'.$orderData['quantity'].'</td>';
	echo '<td> put something here </td>';
	echo "</tr>";
}

echo '</table>';
echo '</form>';


?> 


        </div>			
	</div>
</div>


<? include('footer.php'); ?>




