<?php


include "../config/dbconnect.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    //getting all data
    $pid  = $_POST['id'];
    $pname =$_POST['pname'];
    $pprice =$_POST['pprice'];
    $pimg = $_POST['pimg'];
    $pcode =$_POST['pcode'];
    $pcategory =$_POST['pcategory'];
    $currentImgSrc = $_POST['imgSrc'];

    

    //checking image
    $pimg  =  strstr($pimg, ".", false);

    if($pimg ==""){
      $pimg =   strstr($currentImgSrc, ".", false);
    }

    $nameImg = $pcode;
    $pimg = "image/" . $nameImg . $pimg;
}

try{
    

//query
    $stmt = $db_obj->prepare('UPDATE product SET product_name = ?, product_price= ?,product_image = ?, product_code = ?, product_category = ? WHERE id = ?'); 

    
//executing
    if($stmt !== FALSE)
    {
        $stmt -> bind_param('sisisi',$pname, $pprice, $pimg, $pcode, $pcategory, $pid); 
        $stmt -> execute(); 
        
        echo "yes";
        
        $db_obj->close();
        $stmt->close();
           

    }else{
        echo "no";
    }
 

}catch(Exception $e) {
    echo json_encode(
        array(
            'message' => $e -> getMessage(),
            'status_code' => $e -> getCode()
        )
    );
}


?>

