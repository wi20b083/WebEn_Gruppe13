<?php

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

include "../config/dbconnect.php"; 



if($_SERVER["REQUEST_METHOD"] == "POST") {

    $uname = $password = $uid = null;

    $query = "SELECT * FROM users WHERE uname = ? AND pwd = ?"; 
     


    if(isset($_POST["uname"]) && isset($_POST["password"])) {
        $uname = test_input($_POST["uname"]); 
        $password = hash("sha256", test_input($_POST["password"]));
        $stmt = $db_obj->prepare($query); 
        $stmt -> bind_param("ss", $uname, $password); 
        $stmt-> execute(); 
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if(!empty($row)) {
            $dataValid["valid"] = true;
            $uid = $row["ID"]; 
        } else {
            $dataValid["valid"] = false;
        }
        $stmt->close(); 
    }

     




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

    if($dataValid["valid"] && $resp) {
        $_SESSION["uname"] = $uname;
        echo json_encode($dataValid);
    }
    
}  
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["logout"])) {
    
        session_destroy(); 
       header("Location: http://localhost/WebEnProjekt/frontend/sites/login.php");
    
}
?>