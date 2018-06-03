<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Register - Yo Yo Ma's</title>
  </head>

  <body>
    <form action="register.php" method="post">
      First Name: <input type="text" name="first" required maxlength=45>
      <br/>
      Last Name: <input type="text" name="last" required maxlength=45> 
      <br/>
      Email Address: <input type="email" name="email" required maxlength=255>
      <br/>
      Password: <input type="password" name="password" required minlength=8>
      <br/>
<<<<<<< HEAD
      Address: <input type="text" name="street">
=======
      Address: <input type="text" name="street" required maxlength=45>
>>>>>>> origin/master
      <br/>
      Country: <select name="country">
        <option value="Canada">Canada</option>
        <option value="USA">USA</option>
      </select>
      <br/>
      Postal Code: <input type="text" name="postcode" required minlength=5 maxlength=7 
       pattern="[ABCEGHJKLMNPRSTVXY][0-9][ABCEGHJKLMNPRSTVWXYZ] ?[0-9][ABCEGHJKLMNPRSTVWXYZ][0-9]|[0-9]{5}">
      <br/>
      
    <input type="submit" value="Sign Up">
    
    <?php
      ini_set('display_errors',1);
      /*function recordExists($table, $where, $mysqli{
        $query = "SELECT * FROM `$table` WHERE $where;
        $result = $mysqli->query($query);
            if($result->num_rows > 0 {
                echo "account already exists";
            }
      }*/
      if (isset($_POST['password'])) {
        $db = mysqli_connect('localhost', 'cst177', '461570', 'ICS199Group13_dev');
        mysqli_set_charset($db, 'utf8');
        $pw_hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $pw_hash = mysqli_real_escape_string($db, $pw_hash);
        $first = mysqli_real_escape_string($db, $_POST['first']);
        $last = mysqli_real_escape_string($db, $_POST['last']);
        $street = mysqli_real_escape_string($db, $_POST['street']);
        $country = mysqli_real_escape_string($db, $_POST['country']);
        $postcode = str_replace(' ', '', mysqli_real_escape_string($db, $_POST['postcode']));
        $query = "INSERT INTO USER (fname, lname, password, email, address, country, postcode, role) VALUES ('$first', '$last', '$pw_hash', '$email', '$street', '$country', '$postcode', 'customer');";
        mysqli_query($db, $query) or die(mysqli_error($db));
        mysqli_close($db);
      }
    ?>
  </body>  
</html>


