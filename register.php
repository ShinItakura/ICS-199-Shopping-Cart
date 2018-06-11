<?php include('header.php');?>
  <head>
    <title>Register - Yo Yo Ma's</title>
  </head>
<style>
    table#regtable{
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

  <body>
      <h2>Registration Form</h2>
      <div class="content">
            <form action="register.php" method="post">
                <div class="container">
                    <table id="regtable">
                        <tr>
                            <td>First Name: </td>
                            <td><input type="text" name="first" required maxlength=45></td>
                        </tr>
                        <tr>
                            <td>Last Name: </td>
                            <td><input type="text" name="last" required maxlength=45> </td>
                        </tr>
                        <tr>
                            <td>Email Address: </td>
                            <td><input type="email" name="email" required maxlength=255></td>
                        </tr>
                        <tr>
                            <td>Password: </td>
                            <td><input type="password" name="password" required minlength=8></td>
                        </tr>
                        <tr>
                            <td>Address: </td>
                            <td><input type="text" name="street" required maxlength=45></td>
                        </tr>
                        <tr>
                            <td>Country: </td>
                            <td><select name="country">
                                <option value="Canada">Canada</option>
                                <option value="USA">USA</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>Postal Code: </td>
                            <td><input type="text" name="postcode" required minlength=5 maxlength=7 pattern="[ABCEGHJKLMNPRSTVXY][0-9][ABCEGHJKLMNPRSTVWXYZ] ?[0-9][ABCEGHJKLMNPRSTVWXYZ][0-9]|[0-9]{5}"></td>
                        </tr>
                        <tr>
                            <td> I agree to the <a href="agreement.php">Privacy Policy </a></td>
                            <td><input type="checkbox" name="pp_accepted" required></td>
                        </tr>
                        <tr>
                            <td><input type="submit" value="Sign Up"></td>
                            <td><button type="reset" value="Reset">Reset</button></td>
                        </tr>
                    </table>
                </div>
          </form>
        </div>
    <?php
      include('mysqli_connect.php');
      //ini_set('display_errors',1);
      /*function recordExists($table, $where, $mysqli{
        $query = "SELECT * FROM `$table` WHERE $where;
        $result = $mysqli->query($query);
            if($result->num_rows > 0 {
                echo "account already exists";
            }
      }*/
      if (isset($_POST['password'])) {
        mysqli_set_charset($dbc, 'utf8');
        $pw_hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $email = mysqli_real_escape_string($dbc, $_POST['email']);
        $pw_hash = mysqli_real_escape_string($dbc, $pw_hash);
        $first = mysqli_real_escape_string($dbc, $_POST['first']);
        $last = mysqli_real_escape_string($dbc, $_POST['last']);
        $street = mysqli_real_escape_string($dbc, $_POST['street']);
        $country = mysqli_real_escape_string($dbc, $_POST['country']);
        $postcode = str_replace(' ', '', mysqli_real_escape_string($dbc, $_POST['postcode']));
        $pp_accepted = $_POST['pp_accepted'] == "on";
        $query = "INSERT INTO USER (fname, lname, password, email, address, country, postcode, role, pp_accepted) VALUES ('$first', '$last', '$pw_hash', '$email', '$street', '$country', '$postcode', 'customer', $pp_accepted);";
        $result = mysqli_query($dbc, $query);
        if ($result == true) {
          print "<script type='text/javascript'>";
          print "alert('Account Successfully Registered')";
          print "</script>";
        } else if (mysqli_errno($dbc) == 1062) {
          print "<script type='text/javascript'>";
          print "alert('Error: An account with that email address already exists')";
          print "</script>";
        } else {
          print "Error #" . mysqli_errno($dbc) . " " . mysqli_error($dbc);
        }
        mysqli_close($dbc);
      }
    ?>
<?php include('footer.php');?>

