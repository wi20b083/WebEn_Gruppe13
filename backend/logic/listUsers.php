<?php
include "../config/dbconnect.php";

if($_SERVER["REQUEST_METHOD"] == "GET"){
    
    try{
    

        //getting all users 
        $stmt = $db_obj->prepare('SELECT * FROM users'); 
    
        if($stmt !== FALSE)
        {
            $stmt -> execute(); 
            $result = $stmt->get_result();
            $datas = Array();
             
            //parsing data into an array
            while($row = $result->fetch_assoc()) {
                $datas[] =$row;    
            }
            
            $stmt->close();
            //echoing the Array where the users are stored 
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