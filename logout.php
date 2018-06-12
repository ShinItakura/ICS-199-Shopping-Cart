<?php
// destroys session and redirects back to login page when clicked
  session_start();
  session_destroy();
  header('Location: login.php');
  die();
?>
