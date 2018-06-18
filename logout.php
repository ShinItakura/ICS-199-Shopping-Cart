<?php
// destroys session and redirects back to login page when clicked
  session_start();
  $_SESSION = array();
  session_destroy();
  header('Location: login.php');
  die();
?>
