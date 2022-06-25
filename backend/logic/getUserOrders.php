<?php
include "../config/dbconnect.php";

if($_SERVER["REQUEST_METHOD"] == "GET"){
    
    $id = $_GET["id"];


    try{
    


        $stmt = $db_obj->prepare('SELECT * FROM orders WHERE uid = ? '); 
    
        if($stmt !== FALSE){
            $data = array();
            $stmt -> bind_param('i', $id);
            $stmt -> execute(); 
            $stmt->bind_result($oid, $uid, $timestamp);
            while($stmt->fetch()) {
                array_push($data, array(
                    "uname" => $_SESSION["uname"],
                    "oid" => $oid, 
                    "uid" => $uid,
                    "time" => $timestamp
                ));     
            }

            $db_obj->close();
            $stmt->close();
            echo json_encode(array("data" => $data));
               
            

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