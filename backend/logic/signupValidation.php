<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "../config/dbconnect.php"; 

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $insert_users = "INSERT INTO users(fname, lname, address, zip, city, email, uname, pwd) VALUES (?,?,?,?,?,?,?,?);";

    $fname = $lname = $street = $streetnr = $address = $zip = $city = $email = $uname = $pwd = null; 

    $dataValid = $fnameValid = $lnameValid = $unameValid = $streetValid = $streetnrValid = $cityValid = $zipValid = $emailValid = false; 

    if(isset($_POST["fname"])) {
        $fnameValid = check_value("fname", $_POST["fname"]); 
        if($fnameValid) $fname = test_input($_POST["fname"]); 
    }

    if(isset($_POST["lname"])) {
        $lnameValid= check_value("lname", $_POST["lname"]);

        if($lnameValid) $lname = test_input($_POST["lname"]);
    }

    if(isset($_POST["street"]) && isset($_POST["streetnr"])) {
        $streetValid = check_value("street", $_POST["street"]);
        $streetnrValid = check_value("streetnr", $_POST["streetnr"]);
        
        if($streetValid && $streetnrValid){
            $street = test_input($_POST["street"]);
            $streetnr = test_input($_POST["streetnr"]);
            $address = $street." ".$streetnr; 
        }
    }

    if(isset($_POST["zip"])) {
        $zipValid = check_value("zip", $_POST["zip"]);
        if($zipValid) $zip = test_input($_POST["zip"]);
    }

    if(isset($_POST["city"])) {
        $cityValid = check_value("city", $_POST["city"]);

        if($cityValid) $city = test_input($_POST["city"]);
    }

    if(isset($_POST["email"])) {
        $emailValid = check_value("email", $_POST["email"]);
        if($emailValid) $email = test_input($_POST["email"]);
    }

    if(isset($_POST["uname"])) {
        $unameValid = check_value("uname", $_POST["uname"]);
        if($unameValid) $uname = test_input($_POST["uname"]);
    }

    if(isset($_POST["password"])) {
        $pwd = test_input($_POST["password"]);
        $pwd = hash("sha256", $pwd); 
    } 

    $dataValid = $fnameValid && $lnameValid && $unameValid && $streetValid && $streetnrValid && $cityValid && $zipValid && $emailValid;
    try {
        if($dataValid) {
            $unameQuery = "SELECT * FROM users WHERE uname = ?"; 
            $emailQuery = "SELECT * FROM users WHERE email = ?"; 

            $stmt = $db_obj->prepare($unameQuery); 
            $stmt -> bind_param("s", $uname); 
            $stmt-> execute(); 
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            if(empty($row)) {
                $unameExists = false; 
            } else {
                $unameExists = true; 
            }
            $stmt->close(); 
        
            $stmt = $db_obj->prepare($emailQuery); 
            $stmt -> bind_param("s", $email); 
            $stmt-> execute(); 
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            if(empty($row)) {
                $emailExists = false; 
            } else {
                $emailExists = true;
            }
            $stmt->close();

            if($unameExists || $emailExists) {
                if($unameExists) throw new Exception("Username already exisits.", 409); 
                if($emailExists) throw new Exception("Email already exists", 409); 
            } else {
                $stmt = $db_obj->prepare($insert_users); 
                $stmt -> bind_param("sssissss", $fname, $lname, $address, $zip, $city, $email, $uname, $pwd); 
                $stmt -> execute();
                $stmt -> close();
                $db_obj -> close(); 
                echo json_encode(
                    array(
                        'message' => "Success.",
                        'status_code' => 200
                    )
                );
            }  
        } else {
            throw new Exception("Input data not valid", 400);   
        }
    } catch(Exception $e) {
        echo json_encode(
            array(
                'message' => $e -> getMessage(),
                'status_code' => $e -> getCode()
            )
        );
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function check_value($field, $data) {
    switch($field) {
        case "fname": return isLetters($data);
            
        case "lname": return isLetters($data);
            
        case "uname": return isBetween($data); 
            
        case "street": return isLetters($data);
            
        case "streetnr": return isNumbers($data);
            
        case "city":return isLetters($data);
           
        case "zip": return isNumbers($data);

        case "email": return emailValid($data);
            
    }
}

function isLetters($value) {
    return preg_match("/^[a-zA-Z]{1}[a-zA-ZäöüßÄÖÜ]*$/", $value) === 1 ? true : false;
}

function isNumbers($value) {
    return preg_match("/[0-9]*$/", $value) === 1 ? true : false; 
}

function isBetween($value) {
    return (strlen($value) > 3 && strlen($value) < 25) ? true : false; 
}

function emailValid($value) {
    return filter_var($value, FILTER_VALIDATE_EMAIL); 
}
?>