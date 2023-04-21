<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
  include 'db_connect.php';
  $username = $_POST["username"];
  $name = $_POST["name"];
  $city = $_POST["city"];
  $email = $_POST["email"];
  $address = $_POST["address"];
  $password = $_POST["password"];
  $cpassword = $_POST["cpassword"];

  $city=strtolower($city);

  $existsql = "SELECT * FROM `hospital` WHERE username = '$username' ";
  $result = mysqli_query($conn,$existsql);
  $existrow = mysqli_fetch_row($result);
  if($existrow>0){
    //echo "Username already exist";
    echo '<script>alert("Username already exist!")</script>';
  }
  elseif ($password != $cpassword) {
    //echo "Password and confirm password must be same.";
    echo '<script>alert("Password and confirm password must be same!")</script>';
  }
  else{
    $pass=password_hash($password, PASSWORD_ARGON2I);
    $sql = "INSERT INTO `hospital` (`username`,`name`,`city`,`email`,`address`,`password`) VALUES ('$username','$name','$city','$email','$address','$pass') ";
    mysqli_query($conn, $sql);
    //echo '<script>alert("Account created successfully!")</script>';
    header("location: Hsignin.php");
  }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SignUp</title>
    <link rel="stylesheet" href="HSignup.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </head>
  <body>
    <img class="logo" src="logo.png" alt="logo">

    <div class="main">
        <div class="signup-box">
            <div class="text-signup">
            <p>Sign-up</p>
            <span>Enter your credentials to register.</span>
            </div>
            <div class="signup-form">
                <form  action="HSignup.php" method="POST">
                    <input class="form-control" type="text" name="username" placeholder="Username" required>
                    <input class="form-control" type="text" name="name" placeholder="Name" required>
                    <input class="form-control" type="text" name="city" placeholder="City" required>
                    <input class="form-control" type="text" name="email" placeholder="Email Address" required>
                    <input class="form-control" type="text" name="address" placeholder="Address" required>
                    <input class="form-control" type="password" name="password" placeholder="Password" required>
                    <input class="form-control" type="password" name="cpassword" placeholder="Confirm Password" required>
                    <input class="form-enter" type="submit" name="register" value="Register">
                </form>
            </div>
        </div>
    </div>
  </body>
</html>
