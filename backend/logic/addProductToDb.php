<?php
include "../config/dbconnect.php";

//if request method  = post 
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $pname  = $_POST['pname'];
    $pprice  = $_POST['pprice'];
    
    $pcode  = $_POST['pcode'];
    $pcategory  = $_POST['pcategory'];
    $pimg = $_POST['pimg'];

    
}
//setting img name with pcode filename 
$pimg  =  strstr($pimg, ".", false);
$nameImg = $pcode;
$pimg = "image/" . $nameImg . $pimg; 

try{
    //adds product to tb 
    $stmt = $db_obj->prepare('INSERT INTO product (product_name, product_price, product_image, product_code, product_category) VALUES (?, ?, ?, ?, ?)'); 
    //if stamte is not false 
    if($stmt !== FALSE)
    {   //binding params for the statement ? 
        $stmt -> bind_param('sisis', $pname, $pprice, $pimg, $pcode, $pcategory); 
        $stmt -> execute(); 
        $db_obj->close();
        $stmt->close();
        //
        echo "Statement Right";
    }else{
        echo "False Statement";
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