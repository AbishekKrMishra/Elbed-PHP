<!-- <?php
  // session_start();
  // include 'db_connect.php';
  // if($_SERVER["REQUEST_METHOD"]=="POST"){
  //   include 'db_connect.php';
  //   $visi_username = $_SESSION['username'];
  //   $hos_username= $_POST['husername'];
  //   $booking_sql="DELETE FROM bookings WHERE v_username='$visi_username'";
  //   mysqli_query($conn, $booking_sql);
  //
  //   $hospital_sql="UPDATE `hospital` SET occupied = occupied-1 WHERE username='$hos_username' ";
  //   mysqli_query($conn, $hospital_sql);
  //   echo '<script>alert("Booking deleted!")</script>';
  //}
//?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div>
      <?php
      // include 'db_connect.php';
      // $v_name=$_SESSION['username'];
      // // echo $v_name;
      // $existingbooking = "SELECT * FROM `bookings` WHERE v_username = '$v_name' ";
      // $result = mysqli_query($conn,$existingbooking);
      // $num = mysqli_num_rows($result);
      // $existbooking = mysqli_fetch_row($result);
      // if($num==1){
      //   $h_name=$existbooking[1];
      //   $hos_details="SELECT * FROM `hospital` WHERE username = '$h_name' ";
      //   $answer = mysqli_query($conn,$hos_details);
      //   $details = mysqli_fetch_row($answer);
        //?>
        <form action="booking.php" method="post">
          <input type="hidden" class="" name="husername" value="<?php echo $details[1];  ?>">
          <input type="text" class="" name="hname" value="<?php echo $details[2];  ?>" readonly><br><br>
          <input type="text" class="" name="hemail" value="<?php echo $details[4]; ?>" readonly><br><br>
          <input type="text" class="" name="haddress" value="<?php echo $details[5]; ?>" readonly><br><br>
          <input class="" type="submit" name="delbooking" value="Delete Booking">
        </form>
    //<?php
  //}
    // else{
    //   echo "No bookings available for you.";
    //}
      ?>
    </div>
  </body>
</html> -->
<?php
  session_start();
  include 'db_connect.php';
  if($_SERVER["REQUEST_METHOD"]=="POST"){
    include 'db_connect.php';
    $visi_username = $_SESSION['username'];
    $hos_username= $_POST['husername'];
    $booking_sql="DELETE FROM bookings WHERE v_username='$visi_username'";
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
    <title></title>
    <link rel="stylesheet" href="booking.css">
  </head>
  <body>
    <div>
      <?php
      include 'db_connect.php';
      $v_username=$_SESSION['username'];
      $v_name=$_SESSION['name'];
      $v_email=$_SESSION['email'];
      $v_city=$_SESSION['city'];
      $v_add=$_SESSION['address'];
      $v_idproof=$_SESSION['idproof'];
      $v_idno=$_SESSION['idno'];
      $existingbooking = "SELECT * FROM `bookings` WHERE v_username = '$v_username' ";
      $result = mysqli_query($conn,$existingbooking);
      $num = mysqli_num_rows($result);
      $existbooking = mysqli_fetch_row($result);
      if($num==1){
        $h_name=$existbooking[1];
        $price=$existbooking[5];
        $hos_details="SELECT * FROM `hospital` WHERE username = '$h_name' ";
        $answer = mysqli_query($conn,$hos_details);
        $details = mysqli_fetch_row($answer);
        $custid=" ";
        $amount=" ";
        $custid=base64_encode($_SESSION['username'].rand(1000,1000));
        $amount=base64_encode($price);
        ?>
        <a href="Vdash.php" class="nav1">Home</a>
        <div class="container">
          <div class="con2">
            <h1 class="title">Receipt</h1>
            <div class="log">
              <img class="logo" src="logo.png" alt="logo">
            </div>
          </div>
          <div class="details">
            <form action="booking.php" method="post">
              <input type="hidden" class="" name="husername" value="<?php echo $details[1];  ?>">
              <input type="text" class="name" name="hname" value="<?php echo $details[2];  ?>" readonly><br><br>
              <input type="text" class="email" name="hemail" value="<?php echo $details[4]; ?>" readonly><br>
              <input type="text" class="add" value="Address:">
              <input type="text" class="address" name="haddress" value="<?php echo $details[5]; ?>" readonly>
              <input type="text" class="city" name="hcity" value="<?php echo $details[3]; ?>" readonly><br><br><br><br>
              <input type="text" class="add" value="Patient Details:">
              <input type="text" class="vuser" name="v_username" value="<?php echo $v_name; ?>" readonly><br>
              <input type="text" class="vmail" name="v_email" value="<?php echo $v_email; ?>" readonly><br>
              <input type="text" class="vadd" name="v_add" value="<?php echo $v_add; ?>" readonly><br>
              <input type="text" class="vcity" name="v_city" value="<?php echo $v_city; ?>" readonly><br>
              <input type="text" class="vid" name="v_idproof" value="<?php echo $v_idproof; ?>" readonly>:
              <input type="text" class="vidno" name="v_idno" value="<?php echo $v_idno; ?>" readonly><br><br>
              <input class="smtbtn" type="submit" name="delbooking" value="Delete Booking">
              <a href="ordernow.php?custid=<?php echo $custid;?>&am=<?php echo $amount; ?>"  class="pay">PayNow</a>
            </form>
          </div>
        </div>

    <?php }
    else{
      echo "No bookings available for you.";
    }
    // echo "$price";
    // $custid=base64_encode($_SESSION['username'].rand(1000,1000));
    // $amount=base64_encode($price);
      ?>

    </div>
  </body>
</html>
