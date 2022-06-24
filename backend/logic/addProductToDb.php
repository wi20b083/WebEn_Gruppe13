<?php
include "../config/dbconnect.php";


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $pname  = $_POST['pname'];
    $pprice  = $_POST['pprice'];
    //$pqty  = $_POST['pqty'];
    $pcode  = $_POST['pcode'];
    $pcategory  = $_POST['pcategory'];
    $pimg = $_POST['pimg'];

    
}

$pimg  =  strstr($pimg, ".", false);
$nameImg = $pcode;
$pimg = "image/" . $nameImg . $pimg; 

try{
    
    $stmt = $db_obj->prepare('INSERT INTO product (product_name, product_price, product_image, product_code, product_category) VALUES (?, ?, ?, ?, ?)'); 

    if($stmt !== FALSE)
    {
        $stmt -> bind_param('sisis', $pname, $pprice, $pimg, $pcode, $pcategory); 
        $stmt -> execute(); 
        $db_obj->close();
        $stmt->close();
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