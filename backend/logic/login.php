<?php
include "../config/dbconnect.php"; 

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $uname = $password = null;

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
        } else {
            $dataValid["valid"] = false;
        }
        $stmt->close(); 
    }
    echo json_encode($dataValid);  
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>