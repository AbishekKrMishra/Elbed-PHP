<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
  include 'db_connect.php';
  $username = $_POST["vusername"];
  $password = $_POST["vpassword"];
  // $sql = "Select * from visitor where username='$username' AND password='$password'";
  $sql = "Select * from visitor where username='$username'";
  $result= mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);
  $name = mysqli_fetch_row($result);
  if($num==1){
    if(password_verify($password, $name[6])){
    session_start();
    $_SESSION['loggedin']=true;
    $_SESSION['username']=$username;
    $_SESSION['name']=$name[2];
    $_SESSION['city']=$name[3];
    $_SESSION['email']=$name[4];
    $_SESSION['address']=$name[5];
    $_SESSION['idproof']=$name[7];
    $_SESSION['idno']=$name[8];
    header("location: Vdash.php");
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
    <link rel="stylesheet" href="VSignin.css">
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
                <form action="VSignin.php" method="POST">
                    <input class="form-control" type="text" placeholder="Username" name="vusername">
                    <input class="form-control" type="password" placeholder="Password" name="vpassword">
                    <input class="form-enter" type="submit" value="Let's go">
                    <!--<input class="form-signup" type="submit" value="Sign-Up">-->
                    <a href="VSignup.php" class="form-signup" type="submit" value="Sign-Up">Sign-Up</a>
                </form>
            </div>
        </div>
    </div>

  </body>
</html>
