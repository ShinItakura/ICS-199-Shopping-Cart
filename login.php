<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        form {
            border: 3px solid #f1f1f1;
        }

        input[type=text],
        input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            opacity: 0.8;
        }

        .cancelbtn {
            width: auto;
            padding: 10px 18px;
            background-color: #f44336;
        }

        .imgcontainer {
            text-align: center;
            margin: 24px 0 12px 0;
        }

        img.avatar {
            width: 40%;
            border-radius: 50%;
        }

        .container {
            padding: 16px;
        }

        span.psw {
            float: right;
            padding-top: 16px;
        }

        /* Change styles for span and cancel button on extra small screens */

        @media screen and (max-width: 300px) {
            span.psw {
                display: block;
                float: none;
            }
            .cancelbtn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <h2>Login Form</h2>

    <form action="login.php" method="POST">
        <div class="imgcontainer">
            <img src="img_avatar2.png" alt="Avatar" class="avatar">
        </div>

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
            <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>
        </div>

        <div class="container" style="background-color:#f1f1f1">
            <button type="button" class="cancelbtn">Cancel</button>
            <span class="psw">Forgot
                <a href="#">password?</a>
            </span>
        </div>
    </form>

</body>

</html>
<?php
  if (isset($_POST['email'])) {
    $db = new mysqli("localhost", "cst177", "461570", "ICS199Group13_dev");
    $query = "SELECT * FROM USER WHERE email = '{$_POST['email']}';";
    $result = $db->query($query);
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
          if (endsWith($_SERVER['HTTP_REFERER'], 'cart.php')) {
            header('Location: cart.php');
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

  function endsWith($str, $substr) {
    $length = strlen($substr);
    return $length === 0 ||
        (substr($str, -length) === $substr);
  }
?>
