<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
  header("location: Hsignin.php");
  exit;
}
// elseif( $_SESSION['occup'] ) {
//     // $current_referrer = 'page1.php';
//     echo '<script>alert("Booking deleted!")</script>';
// }
// else{
//   $name = $_SESSION['username'];
//   $sql_h = "Select * from hospital where username='$name'";
//   $result_h= mysqli_query($conn, $sql);
//   $name_h = mysqli_fetch_row($result_h);
// }
function submitbeds(){
include 'db_connect.php';
$_SESSION['beds']+=$_POST["enterbeds"];
$new_beds=$_SESSION['beds'];
$newname=$_SESSION['username'];
$_SESSION['available']=$new_beds-$_SESSION['occupied'];
$sql="UPDATE `hospital` SET beds='$new_beds' WHERE username = '$newname' ";
mysqli_query($conn, $sql);
}
function submitprice(){
  include 'db_connect.php';
  $_SESSION['price']=$_POST["enterprice"];
  $new_price=$_SESSION['price'];
  $newname=$_SESSION['username'];
  $sql="UPDATE `hospital` SET price='$new_price' WHERE username = '$newname' ";
  mysqli_query($conn, $sql);
}
function submitdelete(){
  if(($_SESSION['beds']-$_SESSION['occupied'])>$_POST["deletebeds"]){
    include 'db_connect.php';
    $_SESSION['beds']-=$_POST["deletebeds"];
    $new_beds=$_SESSION['beds'];
    $newname=$_SESSION['username'];
    $_SESSION['available']=$new_beds-$_SESSION['occupied'];
    $sql="UPDATE `hospital` SET beds='$new_beds' WHERE username = '$newname' ";
    mysqli_query($conn, $sql);
  }
  else{
    echo '<script>alert("Count of delete beds must be less than available beds!")</script>';
  }
}
if(array_key_exists('submitbeds',$_POST))
{
  submitbeds();
}
elseif (array_key_exists('submitprice',$_POST)) {
  submitprice();
}
elseif (array_key_exists('submitdelete',$_POST)) {
  submitdelete();
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="Hdash.css">
  </head>
  <body>
    <div class="head">
      <img class="logo" src="logo_white.png" alt="logo">
    </div>

    <div class="nav">
      <a href="Hdash.php" class="nav1">Home</a>
      <a href="occupied.php" class="nav2">Occupied Check</a>
      <a href="authentication.php" class="nav3">Authenticate</a>
      <h6 class="hname"> <?php echo $_SESSION['name'] ?></h6>
      <p><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
        </svg></p>
    </div>

    <div class="entries">
      <b class="ent-title">Enter</b><br>
      <b class="ent-title">Data</b>
      <div class="bedsdata">
        <form class="" action="" method="post">
          <input class="bedsinput" type="text" name="enterbeds" placeholder="0">
          <input class="submitbeds" type="submit" name="submitbeds" value=">">
        </form>
          <form class="" action="" method="post">
            <input class="priceinput" type="text" name="enterprice" placeholder="0">
            <input class="submitprice" type="submit" name="submitprice" value=">">
          </form>
        <form class="ddd" action="" method="post">
          <input class="deletebeds" type="text" name="deletebeds" placeholder="0">
          <input class="submitdelete" type="submit" name="submitdelete" value=">">
        </form>
        <br><br>
      </div>
      <div class="firstlbl">
        <b class="enterbeds">Beds</b>
        <b class="enterprice">Set Price</b>
        <b class="deletelbl">Delete Beds</b>
      </div>

    </div>

    <div class="details">
      <b class="det-title">Details</b>
      <div class="data">
        <h6 class="availableinput"> <?php echo $_SESSION['available'] ?></h6>
        <h6 class="occupied"> <?php echo $_SESSION['occupied'] ?></h6>
        <h6 class="availableprice"> <?php echo $_SESSION['price'] ?></h6>
        <br><br>
      </div>
      <div class="secondlbl">
        <b class="availablelbl">Available Beds</b>
        <b class="occupiedlbl">Occupied Beds</b>
        <b class="pricelbl">Price</b>
      </div>
    </div>
    <div class="log">
      <a href="logout.php" class="logout">Logout</a>
    </div>

  </body>
</html>
