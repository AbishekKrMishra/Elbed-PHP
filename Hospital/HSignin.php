<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
  include 'db_connect.php';
  $username = $_POST["username"];
  $password = $_POST["password"];
  // $sql = "Select * from hospital where username='$username' AND password='$password'";
  $sql = "Select * from hospital where username='$username'";
  $result= mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);
  $name = mysqli_fetch_row($result);
  if($num==1){
    if(password_verify($password, $name[6])){
      session_start();
      $_SESSION['loggedin']=true;
      $_SESSION['username']=$username;
      $_SESSION['name']=$name[2];
      $_SESSION['beds']=$name[7];
      $_SESSION['price']=$name[8];
      $_SESSION['occupied']=$name[9];
      $_SESSION['available']=$name[7]-$name[9];
      header("location: Hdash.php");
    }
    else{
      echo '<script>alert("Wrong credentials!")</script>';
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SignIn</title>
    <link rel="stylesheet" href="HSignin.css">
  </head>
  <body>

    <img class="logo" src="logo.png" alt="logo">

    <div class="main">
        <div class="login-box">
            <div class="text-login">
            <p>Login</p>
            <span>Use your credentials to log in.</span>
            </div>
            <div class="login-form">
                <form action="Hsignin.php" method="POST">
                    <input class="form-control" name="username" type="text" placeholder="Username">
                    <input class="form-control" name="password" type="password" placeholder="Password">
                    <input class="form-enter" type="submit" name="login" value="Let's go">
                    <a href="HSignup.php" class="form-signup" type="submit" value="Sign-Up">Sign-Up</a>
                </form>
            </div>
        </div>
    </div>
  </body>
</html>
