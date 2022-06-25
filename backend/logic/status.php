<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }

include "../config/dbconnect.php";


if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])){
    $uid = $_GET['id']; 




    $stmt = $db_obj->prepare('SELECT * FROM userstatus WHERE uid = ?'); 


    if($stmt !== FALSE)
    {
        $res = array(); 

        $stmt -> bind_param('i',$uid); 
        $stmt -> execute(); 
         
        $stmt->bind_result($uid, $status); 
        while($stmt->fetch()) {

            if($status == "activated"){
                $resp = true; 
            } else {
                $resp = false; 
            }
            array_push(
                $res, 
                array(
                    "status" => $resp
                ) 
            );
        }
        $stmt->close();
        $db_obj->close(); 
        echo json_encode($resp); 
        die(); 
        

        
        


    }else{
        echo "no";
    }
 


}
?>