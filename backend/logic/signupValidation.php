<?php
include "../config/dbconnect.php"; 

if($_SERVER["REQUEST_METHOD"] == "GET") {

    $uname = $email = null; 

    $unameQuery = "SELECT * FROM users WHERE uname = ?"; 
    $emailQuery = "SELECT * FROM users WHERE email = ?"; 


    if(isset($_GET["uname"])) {
        $uname = test_input($_GET["uname"]); 
        $stmt = $db_obj->prepare($unameQuery); 
        $stmt -> bind_param("s", $uname); 
        $stmt-> execute(); 
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if(empty($row)) {
            $dataValid["uname"] = true; 
        } else {
            $dataValid["uname"] = false;
        }
        $stmt->close(); 
    }

    if(isset($_GET["email"])) {
        $email = test_input($_GET["email"]); 
        $stmt = $db_obj->prepare($emailQuery); 
        $stmt -> bind_param("s", $email); 
        $stmt-> execute(); 
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if(empty($row)) {
            $dataValid["email"] = true; 
        } else {
            $dataValid["email"] = false;
        }
        $stmt->close();
    }
    echo json_encode($dataValid);  
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $insert_users = "INSERT INTO users(fname, lname, address, zip, city, email, uname, pwd) VALUES (?,?,?,?,?,?,?,?);";

    $fname = $lname = $street = $streetnr = $address = $zip = $city = $email = $uname = $pwd = null; 

    if(isset($_POST["fname"])) {
        $fname = test_input($_POST["fname"]); 
    }

    if(isset($_POST["lname"])) {
        $lname = test_input($_POST["lname"]);
    }

    if(isset($_POST["street"]) && isset($_POST["streetnr"])) {
        $street = test_input($_POST["street"]);
        $streetnr = test_input($_POST["streetnr"]);
        $address = $street." ".$streetnr; 
    }

    if(isset($_POST["zip"])) {
        $zip = test_input($_POST["zip"]);
    }

    if(isset($_POST["city"])) {
        $city = test_input($_POST["city"]);
    }

    if(isset($_POST["email"])) {
        $email = test_input($_POST["email"]);
    }

    if(isset($_POST["uname"])) {
        $uname = test_input($_POST["uname"]);
    }

    if(isset($_POST["password"])) {
        $pwd = test_input($_POST["password"]);
        $pwd = hash("sha256", $pwd); 
    }

    $stmt = $db_obj->prepare($insert_users); 
    $stmt -> bind_param("sssissss", $fname, $lname, $address, $zip, $city, $email, $uname, $pwd); 
    $stmt -> execute();
    $stmt -> close();
    $db_obj -> close(); 
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>