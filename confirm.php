<form action="confirm.php" method="post">
<label>Subject of email:</label><br>
<input type="text" name="subject" id="subject"/><br>
<label>Body of email:</label><br>
<textarea name="body" id="body" rows="10" cols="35"></textarea><br>
<input type="submit" name=submit value="Submit"/>
</form>
<?php
<<<<<<< HEAD
// testing git update with this text
//setup some variables
// enter username password hostname database name table name to connect to mySQL server table
$user = "user_name"; 
$password = "password"; 
$host = "host_name"; 
$dbase = "database_name"; 
$table = "table_name"; 

//email address from where you want to send order confirmation from
$from= 'email_address';

//retrieves subject title and body 
$subject= $_POST['subject'];
$body= $_POST['body'];

// connect to mySQL server
$dbc= mysqli_connect($host,$user,$password, $dbase) 
or die("Unable to select database");

//mySQL query to retrieve order data
$query= "SELECT * FROM $table";
$result= mysqli_query ($dbc, $query) 
=======
// enter username password hostname database name table name to connect to mySQL server table
$user = "cst136"; 
$password = "451722"; 
$host = "localhost"; 
$dbase = "ICS199Group13_dev"; 
$table = "USER"; 

//email address from where you want to send order confirmation from
$from= "shintaro.itakura28@camosun.bc.ca";

//retrieves subject title and body 
$subject= $_POST['subject'];
//$subject = "Your order has been processed";
$body= $_POST['body'];
//$body = 

// connect to mySQL server
$db= mysqli_connect($host,$user,$password, $dbase) 
or die("Unable to select database");

//mySQL query to retrieve order data
$query= "SELECT * FROM $ORDERITEM";
$result= mysqli_query ($db, $query) 
>>>>>>> origin/master
or die ('Error querying database.');

//fetches email list from database
while ($row = mysqli_fetch_array($result)) {
<<<<<<< HEAD
$first_name= $row['first_name'];
$last_name= $row['last_name'];
=======
$firstname= $row['fname'];
$lastname= $row['lname'];
>>>>>>> origin/master
$email= $row['email'];

//write email
$msg= "Dear $first_name $last_name,\n$body";
mail($email, $subject, $msg, 'From:' . $from);
echo 'Email sent to: ' . $email. '<br>';
}

//close database
<<<<<<< HEAD
mysqli_close($dbc);
=======
mysqli_close($db);
>>>>>>> origin/master
?>