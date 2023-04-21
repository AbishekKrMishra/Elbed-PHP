<?php
  session_start();
  session_unset();
  session_destroy();
  header("location:HSignin.php");
  exit;
?>
