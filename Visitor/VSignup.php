<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
  include 'db_connect.php';
  $username = $_POST["username"];
  $name = $_POST["name"];
  $city = $_POST["city"];
  $email = $_POST["email"];
  $address = $_POST["address"];
  $password = $_POST["password"];
  $idproof = $_POST["idproof"];
  $idno = $_POST["idno"];
  $city=strtolower($city);
  $existsql = "SELECT * FROM `visitor` WHERE username = '$username' ";
  $result = mysqli_query($conn,$existsql);
  $existrow = mysqli_fetch_row($result);
  if($existrow>0){
    echo '<script>alert("Username already exist!")</script>';
  }
  else{
    $pass=password_hash($password, PASSWORD_ARGON2I);
    $sql = "INSERT INTO `visitor` (`username`,`name`,`city`,`email`,`address`,`password`,`idproof`,`idno`) VALUES ('$username','$name','$city','$email','$address','$pass','$idproof','$idno') ";
    mysqli_query($conn, $sql);
    header("location: VSignin.php");
  }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SignUp</title>
    <link rel="stylesheet" href="VSignup.css">
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
                <form action="VSignup.php" method="POST">
                    <input class="form-control" type="text" placeholder="Username" name="username" required>
                    <input class="form-control" type="text" placeholder="Name" name="name" required>
                    <input class="form-control" type="text" placeholder="City" name="city" required>
                    <input class="form-control" type="text" placeholder="Email Address" name="email" required>
                    <input class="form-control" type="text" placeholder="Address" name="address" required>
                    <input class="form-control" type="password" placeholder="Password" name="password" required>
                    <select class="form-control" placeholder="ID Proof" name="idproof">
                      <option value="None" disabled selected class="first">Select ID Proof</option>
                      <option value="Aadhar">Aadhar</option>
                      <option value="DrivingLisence">Driving Lisence</option>
                      <option value="Voter ID">Voter ID</option>
                      <option value="Passport">Passport</option>
                    </select>
                    <input class="form-control" type="text" placeholder="Enter ID Number" name="idno">
                    <input class="form-enter" type="submit" value="Register">
                </form>
            </div>
        </div>
    </div>
  </body>
</html>
