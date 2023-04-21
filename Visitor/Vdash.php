<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
  header("location: Vsignin.php");
  exit;
}
elseif($_SERVER["REQUEST_METHOD"]=="POST"){
  include 'db_connect.php';
  $name = $_POST["name"];
  $hospi_username = $_POST["username"];
  $visi_username= $_SESSION['username'];
  $visi_name=$_SESSION['name'];
  $visi_email=$_SESSION['email'];
  $available_beds = $_POST["avail"];
  $price_per_bed= $_POST["price"];

  $existbookingsql = "SELECT * FROM `bookings` WHERE v_username = '$visi_username' ";
  $res = mysqli_query($conn,$existbookingsql);
  $existbooking = mysqli_fetch_row($res);
  if($existbooking>0){
    echo '<script>alert("Cannot book 2 beds at a time!")</script>';
  }
  else{
    if($available_beds==0){
      echo '<script>alert("Beds not available in this hospital!")</script>';
    }
    else{
      $sql_book = "INSERT INTO `bookings` (`h_username`,`v_username`,`v_name`,`v_email`,`price`) VALUES ('$hospi_username','$visi_username','$visi_name','$visi_email','$price_per_bed') ";
      mysqli_query($conn, $sql_book);

      $sql_hos = "UPDATE `hospital` SET occupied = occupied+1 WHERE username='$hospi_username' ";
      mysqli_query($conn, $sql_hos);
      //payment code goes here
      echo '<script>alert("Bed booked in the hospital!\nMove to the booking page to review.")</script>';
    }
  }

}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="Vdash.css">
  </head>
  <body>
    <div class="head">
      <img class="logo" src="logo.png" alt="logo">
    </div>

    <div class="nav">
      <a href="Vdash.php" class="nav1">Home</a>
      <a href="booking.php" class="nav2">Booking</a>
      <a href="vlogout.php" class="nav3">Logout</a>
      <h6 class="hname"><?php echo $_SESSION['name'] ?></h6>
      <p><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
        </svg></p>
    </div>
    <div class="title">
      <b class="title-t">These are the Hospitals available in <?php echo strtoupper($_SESSION['city']) ?>:</b>
    </div>
    <div>
      <?php
      include 'db_connect.php';
      $c=$_SESSION['city'];
      $query=mysqli_query($conn, "SELECT username,name,beds,occupied,price,verified FROM hospital WHERE city='$c'"); ?>
      <?php
      $username_hos="";
      while($row = mysqli_fetch_array($query))
        {
          // echo $row['username'];
          if($row['verified']=='V'){
            $verified="✅";
          }
          else{
            $verified=" ";
          }
          $username_hos = $row['username'];
          ?>
        <form action="Vdash.php" method="post">
          <input type="hidden" class="" name="username" value="<?php echo $row['username'];  ?>">
          <div class="container">
            <input type="text" class="namefield" name="name" value="<?php echo $row['name'].$verified;  ?>" readonly>
            Available Beds:
            <input type="text" class="availfield" name="avail" value="<?php echo ($row['beds']-$row['occupied']); ?>" readonly>
            Price:
            <input type="text" class="pricefield" name="price" value="<?php echo $row['price']; ?>" readonly>
            <input class="submitbutton" type="submit" name="confbook" value="Confirm Booking">
          </div>
        </form>
    <?php  }
      ?>
    </div>
  </body>
</html>
