<?php
include "../config/dbconnect.php";

if($_SERVER["REQUEST_METHOD"] == "GET"){
    
    $id = $_GET["id"];


    try{
    

        //getting the user where the uid (User id) = ?
        $stmt = $db_obj->prepare('SELECT * FROM orders WHERE uid = ? '); 
    
        if($stmt !== FALSE){
            $data = array();

            //binding params 
            $stmt -> bind_param('i', $id);
            $stmt -> execute(); 
            //binding the result 
            $stmt->bind_result($oid, $uid, $timestamp);

            //putting the gained information in to an array 
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
            //putting a key on the array so we can read it out easily 
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