<?php

include "../config/dbconnect.php";
//if the methode = post get the product id 
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $pid  = $_POST['id'];
}

try{
    

    //deletes user where the id = ? 
    $stmt = $db_obj->prepare('DELETE FROM product WHERE ID = ?'); 

    

    if($stmt !== FALSE)
    {       //binding the param for the statement 
        $stmt -> bind_param('i',$pid); 
        $stmt -> execute(); 
        $result = $stmt->get_result();   
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
