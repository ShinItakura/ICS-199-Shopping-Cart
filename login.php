<!doctype html>
<html>
<head>
<title>Login</title>
<?php
  function endsWith($str, $substr) {
    $length = strlen($substr);
    return $length === 0 ||
        (substr($str, -length) === $substr);
  }

  if (isset($_POST['email'])) {
    include('mysqli_connect.php');
    $query = "SELECT * FROM USER WHERE email = '{$_POST['email']}';";
    $result = $dbc->query($query);
    
    //new privacy policy query to check database if user has accepted privacy policy
    //queries user data privacy policy column
    $resultQuery = "SELECT pp_accepted FROM USER WHERE email='{$_POST['email']}';"; 
    // changes the result to a number
    $resultppq = mysqli_fetch_array($resultQuery); 
    $ppaccepted = $resultppq['pp_accepted'];
    $answer = $_POST['privacypolicy'];  
    // checks if the privacy policy have been accepted updates database pp_accepted column and sets it to one
    if ($answer == "accept") {
        $update = "UPDATE USER SET pp_accepted=1 WHERE email='{$_POST['email']}';";
        mysqli_query($dbc,$update);
    }
    else {
        // if privacy policy has been set to not accept. On submit click updates the database pp_accepted column to zero for user and redirects back to fresh login page 
        $update = "UPDATE USER SET pp_accepted=0 WHERE email='{$_POST['email']}';";
        mysqli_query($dbc,$update);
        session_start();
        session_destroy();
        header ('Location: login.php');
        die();
    }

    if ($result == false) {
      print "Invalid Login";
        
    } else {
      $user = $result->fetch_object();
      if (password_verify($_POST['password'], $user->password)) {
        print "Successful Login";
        session_start();
        $_SESSION['userid'] = $user->id; 
        $_SESSION['logged_in'] = true; 
        $_SESSION['role'] = $user->role;

        // transfer items from session storage cart to db cart
        if(isset($_SESSION["products"]) && count($_SESSION["products"])>0) { 
          $userid = $_SESSION["userid"];
          foreach($_SESSION["products"] as $product) {
            $itemid = $product["id"];
            $quantity = $product["quantity"]; 

            $query = "INSERT INTO CART (ITEM_id, USER_id, quantity) 
              VALUES ($itemid, $userid, $quantity)
              ON DUPLICATE KEY UPDATE quantity = $quantity;";
            mysqli_query($dbc, $query);
          }
        }

        if ($user->role == 'customer') {
          if ($_SESSION["camefromcart"]) {
            header('Location: view_cart.php');
            unset($_SESSION["camefromcart"]);
          } else {
            header('Location: index.php');
          }
        } else if ($user->role == 'admin') {
          header('Location: addproduct.php');
        } 
        die(); 
      } else {
        print "Invalid login";
      }  
    }
  }
?>
<?php include('header.php');?>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style/login.css">
</head>

<body>

    <h2>Login Form</h2>
    <div class="content">
      <form action="login.php" method="POST">
          <div class="container">
              <label for="uname">
                  <b>Email</b>
              </label>
              <input type="text" placeholder="Enter Email" name="email" required>

              <label for="psw">
                  <b>Password</b>
              </label>
              <input type="password" placeholder="Enter Password" name="password" required>
              <br>
              <!--CR02 update to include a privacy policy acceptance and link to a new privacy policy page-->
              <!--accept the privacy policy with auto accept set for radio button-->
              <input type="radio" name="privacypolicy" value="accept"> I accept <a href="agreement.php">terms of service</a>.
              <br>
              <!--declines the privacy policy user must make the choice to unaccept it-->
              <input type="radio" name="privacypolicy" value="donotaccept" checked> I do not accept <a href="agreement.php">terms of service</a>.
              <br>
              <button type="submit">Login</button>
          </div>

          <div class="container" style="background-color:#f1f1f1">
              <span class="register">Not registered yet? <a href="register.php">Sign Up</a>
              </span>
          </div>
      </form>
    </div>
</body>

</html>

<?php include('footer.php');?>
