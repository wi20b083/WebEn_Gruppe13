<?php

//setting dir
$uploadDir = "../image/"; 
$destinationDir = "../image/";

//if dir don't exist -> create
if (!file_exists($uploadDir)) {
   mkdir($uploadDir, 0755, true); 
  }
  if (!file_exists($destinationDir)) {
    mkdir($destinationDir, 0755, true); 
  }
  
  

  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["pimgEdit"])) {
    

    //acually pcode 
    $pid  = $_POST['pcode'];

    //getting path extention
    $ext = pathinfo($_FILES["pimgEdit"]["name"], PATHINFO_EXTENSION);

    //renaming file
    $uploadFile = "";
    $uploadFile .= $uploadDir . $pid . "." . $ext;
    
    move_uploaded_file($_FILES["pimgEdit"]["tmp_name"], $uploadFile);

    echo '<script>window.location="../../frontend/sites/editProducts.php";</script>';
  }
?>
