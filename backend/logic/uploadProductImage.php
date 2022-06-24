<?php
if (($_FILES['pimg']['name']!="")){
    $pcode  = $_POST['pcode'];

    // Where the file is going to be stored
        $target_dir = "../../backend/image/";
        $file = $_FILES['pimg']['name'];
        $path = pathinfo($file);
        $filename = $pcode;
        $ext = $path['extension'];
        $temp_name = $_FILES['pimg']['tmp_name'];
        $path_filename_ext = $target_dir.$filename.".".$ext;
     
    // Check if file already exists
    if (file_exists($path_filename_ext)) {
     echo "Sorry, file already exists.";
     }else{
     move_uploaded_file($temp_name,$path_filename_ext);
     echo "Congratulations! File Uploaded Successfully.";
     }
    }

echo '<script>window.location="../../frontend/sites/newProduct.php";</script>';
   
?>