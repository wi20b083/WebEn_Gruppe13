<?php
include "../config/dbconnect.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $pid  = $_POST['id'];

    
}

try{
    


    $stmt = $db_obj->prepare('SELECT * FROM product WHERE ID = ?'); 

    if($stmt !== FALSE)
    {
        $stmt -> bind_param('i',$pid); 
        $stmt -> execute(); 
        $result = $stmt->get_result();
        $datas = Array();
         
        while($row = $result->fetch_assoc()) {
            $datas[] =$row;    
        }
        echo json_encode($datas);
           
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