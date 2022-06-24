<?php
$uploadDir = "../image/"; 
$destinationDir = "../image/";
if (!file_exists($uploadDir)) {
   mkdir($uploadDir, 0755, true); 
  }
  if (!file_exists($destinationDir)) {
    mkdir($destinationDir, 0755, true); 
  }
  
  

  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["pimgEdit"])) {
    echo "rando";
    $pid  = $_POST['pcode'];

    $ext = pathinfo($_FILES["pimgEdit"]["name"], PATHINFO_EXTENSION);

    $uploadFile = "";
    $uploadFile .= $uploadDir . $pid . "." . $ext;
    echo "rando";
    print_r($uploadFile);
    move_uploaded_file($_FILES["pimgEdit"]["tmp_name"], $uploadFile);

    echo '<script>window.location="../../frontend/sites/editProducts.php";</script>';
  }
?>
