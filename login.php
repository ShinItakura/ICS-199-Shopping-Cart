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
