<?php
  include 'db_connect.php';
  if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $name=$_POST["feedusername"];
    $email=$_POST["feedemail"];
    $feed=$_POST["feedback"];
    $sql = "INSERT INTO `feedback` (`Name`,`Email`,`Feedback`) VALUES ('$name','$email','$feed') ";
    mysqli_query($conn, $sql);
    echo '<script>alert("Feedback Submitted Thank you for the Feedback")</script>';
  }
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Feedback</title>
    <link rel="stylesheet" href="feedback.css">
  </head>
  <body>
    <div class="layer">
      <h1 class="title">Feedback</h1>
      <h3 class="tagline">It's always beautiful to hear from you.</h3>
    </div>
    <div class="feedbox">
      <form action="feedback.php" method="POST">
        <h3 class="feed">Full Name</h3>
        <input class="inp1" type="text" name="feedusername" placeholder="Enter your full name" required>
        <h3 class="feed">Email ID</h3>
        <input class="inp2" type="email" name="feedemail" placeholder="Enter you email" required>
        <h3 class="feed">Feedback</h3>
        <input class="inp3" type="textarea" name="feedback" placeholder="Enter your feedback" required>
        <button type="submit" name="submit">Submit</button>
      </form>
    </div>
  </body>
</html>
