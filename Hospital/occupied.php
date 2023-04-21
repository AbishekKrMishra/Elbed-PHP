<?php
session_start();
include 'db_connect.php';
if($_SERVER["REQUEST_METHOD"]=="POST"){
  include 'db_connect.php';
  $visi_username = $_POST["username"];
  $hos_username= $_SESSION['username'];
  $booking_sql="DELETE FROM bookings WHERE v_username='$visi_username'";
  $_SESSION['occupied']-=1;
  $_SESSION['available']=  $_SESSION['beds']- $_SESSION['occupied'];
  mysqli_query($conn, $booking_sql);
  $hospital_sql="UPDATE `hospital` SET occupied = occupied-1 WHERE username='$hos_username' ";
  mysqli_query($conn, $hospital_sql);
  echo '<script>alert("Booking deleted!")</script>';
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>OCCUPIED</title>
    <link rel="stylesheet" href="occupied.css">
  </head>
  <body>
<h1 style="color:white;text-align:center;">Occupied Beds</h1>
    <a href="Hdash.php" class="nav1">Home</a>
    <br><br>
    <div>
      <?php
      include 'db_connect.php';
      $c=$_SESSION['username'];
      $query=mysqli_query($conn, "SELECT * FROM bookings WHERE h_username='$c'"); ?>
      <?php
      while($row = mysqli_fetch_array($query))
        {
          // echo $row['v_username'];
          ?>
        <form action="occupied.php" method="post">
          <input type="hidden" class="" name="username" value="<?php echo $row['v_username'];  ?>">
          <div class="container">
            <input type="text" class="namelbl" name="name" value="<?php echo $row['v_name'];  ?>" readonly>
            Email:
            <input type="text" class="emaillbl" name="email" value="<?php echo $row['v_email']; ?>" readonly>&emsp;
            Price:
            <input type="text" class="pricelbl" name="price" value="<?php echo $row['price']; ?>" readonly>
            <input type="text" class="pricelbl" name="price" value="<?php echo $row['pay_status']; ?>" readonly>
          </div>
        </form>
    <?php  }
      ?>
    </div>
  </body>
</html>
