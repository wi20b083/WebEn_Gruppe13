<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "../config/dbconnect.php"; 

if($_SERVER["REQUEST_METHOD"] == "GET") {
    $result = array();
    if(isset($_SESSION["uname"])) {
        $uid = $rid = "";  
        $sql = 'SELECT userrights.rid FROM userrights INNER JOIN users ON userrights.uid = users.ID WHERE uname=?'; 
        $stmt = $db_obj->prepare($sql); 
        $stmt->bind_param('s', $_SESSION["uname"]); 
        $stmt->execute(); 
        $stmt->bind_result($rid); 
        while($stmt->fetch()) {
            array_push(
                $result, 
                array(
                    "rid" => $rid
                ) 
            );
        }
        $stmt->close(); 
    }
    echo json_encode($result);
}

?>