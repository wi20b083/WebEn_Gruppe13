<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }

include "../config/dbconnect.php";


if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])){
    //getting uid
    $uid = $_GET['id']; 


    //query
    $stmt = $db_obj->prepare('SELECT * FROM userstatus WHERE uid = ?'); 


    if($stmt !== FALSE)
    {
        $res = array(); 

        $stmt -> bind_param('i',$uid); 
        $stmt -> execute(); 
         
        $stmt->bind_result($uid, $status); 
        while($stmt->fetch()) {

            //setting the response depending on status
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

        //returning the response
        echo json_encode($resp); 
        die(); 
        

        
        


    }else{
        echo "no";
    }
 


}
?>