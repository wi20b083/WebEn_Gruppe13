<?php
include "../config/dbconnect.php";

if($_SERVER["REQUEST_METHOD"] == "GET"){
    
    

    try{
    


        $stmt = $db_obj->prepare('SELECT * FROM users'); 
    
        if($stmt !== FALSE)
        {
            $stmt -> execute(); 
            $result = $stmt->get_result();
            $datas = Array();
             
            while($row = $result->fetch_assoc()) {
                $datas[] =$row;    
            }
            
            $stmt->close();
            echo json_encode($datas);
               
            
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



    
}



?>