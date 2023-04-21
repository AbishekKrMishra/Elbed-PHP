<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Authentication</title>
    <link rel="stylesheet" href="authentication.css">
  </head>
  <body>
    <a href="Hdash.php" class="nav1">Home</a>
    <div class="container">
      <h1 class="title">Submit your supporting document</h1>
      <h2 class="bracket">(Hospital Registration Certificate / Building Permit and Licenses / No objection certificate)</h2>
      <form action="authentication.php" method="post" enctype="multipart/form-data">
    <input class="fileupload" type="file" name="fileupload" size="60">
    <input class="subbtn" type="submit" name="subbtn" value="Upload">
  </form>
    </div>
</html>
</body>

<?php
session_start();
include 'db_connect.php';
$username=$_SESSION['username'];
$status = $statusMsg = '';
if(isset($_POST["subbtn"])){
  $status = 'error';
  if(!empty($_FILES["fileupload"]["name"])) {
      $fileName = basename($_FILES["fileupload"]["name"]);
      $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
      $allowTypes = array('pdf');
      if(in_array($fileType, $allowTypes)){
          // $image = $_FILES['fileupload']['tmp_name'];
          $pdf=$_FILES['fileupload']['name'];
          $pdf_tem_loc=$_FILES['fileupload']['tmp_name'];
          $pdf_store="Admin/pdf/".$pdf;
          move_uploaded_file($pdf_tem_loc,$pdf_store);
          $sql= "UPDATE `hospital` SET authenticate='$pdf' WHERE username = '$username' ";
          $result=mysqli_query($conn, $sql);
          if($result){
              $status = 'success';
              $statusMsg = "File uploaded successfully.";
          }else{
              $statusMsg = "File upload failed, please try again.";
          }
      }else{
          $statusMsg = 'Sorry, only pdf formats are allowed to upload.';
      }
  }else{
      $statusMsg = 'Please select an pdf file to upload.';
  }
}
echo "<p style='color:green;text-align:center;margin-top:2%;font-weight:bold;'>$statusMsg</p>";
?>
