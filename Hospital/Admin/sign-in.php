<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
  include 'db_connect.php';
  $id = $_POST["id"];
  $pass = $_POST["password"];
  if($id=="any" && $pass=="any@123"){
    session_start();
    header("location: Adash.php");
  }
  else{
    echo '<script>alert("Wrong id or password")</script>';
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Sign-In</title>
    <link rel="stylesheet" href="signin.css">
  </head>
  <body>
    <div class="container">
      <h3>Sign In</h3>
      <form class="" action="sign-in.php" method="post">
        ID: &emsp;&emsp;&emsp;<input type="text" name="id"><br><br>
        Password: &nbsp;&nbsp;<input type="password" name="password"><br><br>
        <input type="submit" class="smtbtn" name="submit" value="Sign-In">
      </form>
    </div>
  </body>
</html>
