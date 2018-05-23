<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Register - Yo Yo Ma's</title>
  </head>

  <body>
    <form action="register.php" method="post">
      First Name: <input type="text" name="first">
      <br/>
      Last Name: <input type="text" name="last"> 
      <br/>
      Email Address: <input type="email" name="email">
      <br/>
      Password: <input type="password" name="password">
      <br/>
      Street Address: <input type="text" name="street">
      <br/>
      Apt Number: <input type="number" name="apt">
      <br/>
      City: <input type="text" name="city">
      <br/>
      Province: <select name="province">
        <option value="AB">Alberta</option> 
        <option value="BC">British Columbia</option>
        <option value="MB">Manitoba</option>
        <option value="NB">New Brunswick</option>
        <option value="NL">Newfoundland</option>
        <option value="NS">Nova Scotia</option>
        <option value="NT">Northwest Territories</option>
        <option value="NU">Nunavut</option>
        <option value="ON">Ontario</option>
        <option value="PE">PEI</option>
        <option value="QC">Quebec</option>
        <option value="SK">Saskatchewan</option>
        <option value="YT">Yukon</option>
      </select>
      <br/>
      Country: <select name="country">
        <option value="Canada">Canada</option>
        <option value="USA">USA</option>
      </select>
      <br/>
      Postal Code: <input type="text" name="postcode">
      <br/>
      
    <input type="submit" value="Sign Up">
    
    <?php
      ini_set('display_errors',1);
      if (isset($_POST['password'])) {
        $db = mysqli_connect('localhost', 'cst177', '461570', 'ICS199Group13_dev');
        mysqli_set_charset($db, 'utf8');
        $pw_hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $pw_hash = mysqli_real_escape_string($db, $pw_hash);
        $first = mysqli_real_escape_string($db, $_POST['first']);
        $last = mysqli_real_escape_string($db, $_POST['last']);
        $street = mysqli_real_escape_string($db, $_POST['street']);
        $city = mysqli_real_escape_string($db, $_POST['city']);
        $country = mysqli_real_escape_string($db, $_POST['country']);
        $postcode = str_replace(' ', '', mysqli_real_escape_string($db, $_POST['postcode']));
        $province = mysqli_real_escape_string($db, $_POST['province']);
        if ($_POST['apt'] != '') {
          $apt = (int) mysqli_real_escape_string($db, $_POST['apt']);
        } else {
          $apt = "NULL";
        }
        $query = "INSERT INTO USERS (email, password, first, last, street_address, city, country, postcode, province, apt_no) VALUES ('$email', '$pw_hash', '$first', '$last', '$street', '$city', '$country', '$postcode', '$province', $apt);";
        mysqli_query($db, $query) or die(mysqli_error($db));
        mysqli_close($db);
      }
    ?>
  </body>  
</html>


