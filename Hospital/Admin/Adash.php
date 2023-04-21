<?php
  if($_SERVER["REQUEST_METHOD"]=="POST"){
    include 'db_connect.php';
    $hospi_username = $_POST["username"];
    $sql_verify = "UPDATE `hospital` SET verified = 'V' WHERE username='$hospi_username' ";
    mysqli_query($conn, $sql_verify);
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="dash.css">
  </head>
  <body>
    <h1 style="margin-bottom:-30px;">Admin Panel</h1>
    <a href="alogout.php" style="margin-left: 1180px; font-weight:bold; color:red; border-radius: 10px;font-size:20px;text-decoration:none;border:1px solid red; padding:4px;">Logout</a><br>
    <table border="1">
      <br>
      <tr>
        <td class="username"><b>Username</b></td>
        <td class="name"><b>Name</b></td>
        <td class="file"><b>FILE Name</b></td>
        <td class="doc"><b>Document</b></td>
        <td class="verify"><b>VERIFY</b></td>
      </tr>
    <?php
      include 'db_connect.php';
      $sql="Select username,name,authenticate from hospital where authenticate is not NULL and verified = 'NO'";
      $query=mysqli_query($conn,$sql);
      while($info=mysqli_fetch_array($query)){
        ?>
        <form action="Adash.php" method="post">
          <div class="cont">
            <tr>
            <td><b><input type="text" name="username" value="<?php echo $info['username']; ?>"></b></td>
            <td><b><?php echo $info['name']; ?></b></td>
            <td><b><?php echo $info['authenticate']; ?></b></td>
            <td><embed type="application/pdf" src="pdf\<?php echo $info['authenticate']; ?>" width="800" height="200" /></td>
            <td><input class="subbtn" type="submit" name="subbtn" value="Verify"></td>
            </tr>
          </div>

          <?php
      }
    ?>
  </form>
  </table>
  </body>
</html>
