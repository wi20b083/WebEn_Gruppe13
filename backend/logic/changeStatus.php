<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }

include "../config/dbconnect.php";


if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])){
    $uid = $_GET['id']; 
    $status =""; 
    echo $_GET["status"]; 
    if($_GET['status'] == "true") {
        $status = "deactivated"; 
    } else {
        $status = "activated";
    }
    echo $status; 




    $stmt = $db_obj->prepare('UPDATE userstatus SET status = ? WHERE uid = ?'); 


    if($stmt !== FALSE)
    {
        $res = array(); 

        $stmt -> bind_param('si',$status,$uid); 
        $stmt -> execute(); 
         
        
        $stmt->close();
        $db_obj->close();  
         
        

        
        


    }else{
        echo "no";
    }
 


}
?>