<?php
//get the new user id
$userid = mysql_insert_id();         
//create a random key
$key = $username . $email . date('mY');
$key = md5($key);
//add confirm row
$confirm = mysql_query("INSERT INTO `confirm` VALUES(NULL,'$userid','$key','$email')"); 
if($confirm){
    //let's send the email
}else{
    $action['result'] = 'error';
    array_push($text,'Confirm row was not added to the database. Reason: ' . mysql_error());
}
?>