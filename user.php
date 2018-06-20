<html>
<head>
    <title>Account</title>

<?php
//header.php ends head tag and starts body tag
include('header.php');
?>
 
<br>
 <div class="row">
	<div class="side">
			<h2 align="center">My Account</h2>			
			<div class="fakeimg" style="height:500px;" align="center"><img src="images/user_2.png" alt="Image" position="center"></div>
   </div>				
				
	<div class="main">
			<h2>&nbsp;Personal Information</h2>		
		<div class="fakeimg" style="height:1000px;">

<?php
$query =  "SELECT * FROM USER WHERE id = " . $_SESSION['userid'] . ";";
$result=mysqli_query($dbc, $query);

while($userData = mysqli_fetch_array($result)) {

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

$query2 ="select USER_id, ITEM_id, PURCHASE_id,quantity, name, price
			from ORDERITEM, PURCHASE, ITEM
			where PURCHASE.id = ORDERITEM.PURCHASE_id
			and ITEM.id = ORDERITEM.ITEM_id
			and PURCHASE.USER_id = " . $_SESSION['userid'] . " order by PURCHASE_id , ITEM_id";
					
			
$result2=mysqli_query($dbc, $query2);

echo "<br>";
echo '<table border="1">';
	echo '<tr>';
		echo '<th>Order ID</th>';
		echo '<th>Item ID</th>';
		echo '<th>Product Name</th>';
		echo '<th>Price</th>';
		echo '<th>Quantity</th>';
	echo '</tr>';

while($orderData = mysqli_fetch_array($result2)){
	echo "<tr>";
	echo '<td>'.$orderData['PURCHASE_id'].'</td>';
	echo '<td>'.$orderData['ITEM_id'].'</td>';
	echo '<td>'.$orderData['name'].'</td>';
	echo '<td>'.$orderData['price'].'</td>';
	echo '<td>'.$orderData['quantity'].'</td>';
	echo "</tr>";
}

echo '</table>';
echo '</form>';


?> 


        </div>			
	</div>
</div>


<?php include('footer.php'); ?>




