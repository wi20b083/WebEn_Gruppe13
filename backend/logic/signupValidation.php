<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "../config/dbconnect.php"; 

if($_SERVER["REQUEST_METHOD"] == "POST") {

    //query for insert
    $insert_users = "INSERT INTO users(fname, lname, address, zip, city, email, uname, pwd) VALUES (?,?,?,?,?,?,?,?);"; 


    //defining variables
    $fname = $lname = $street = $streetnr = $address = $zip = $city = $email = $uname = $pwd = null; 

    //validation variables are false at first
    $dataValid = $fnameValid = $lnameValid = $unameValid = $streetValid = $streetnrValid = $cityValid = $zipValid = $emailValid = false; 

    //lots of validation
    //fname
    if(isset($_POST["fname"])) {
        $fnameValid = check_value("fname", $_POST["fname"]); 
        if($fnameValid) $fname = test_input($_POST["fname"]); 
    }

    //lname
    if(isset($_POST["lname"])) {
        $lnameValid= check_value("lname", $_POST["lname"]);

        if($lnameValid) $lname = test_input($_POST["lname"]);
    }

    //street
    if(isset($_POST["street"]) && isset($_POST["streetnr"])) {
        $streetValid = check_value("street", $_POST["street"]);
        $streetnrValid = check_value("streetnr", $_POST["streetnr"]);
        
        //street number
        if($streetValid && $streetnrValid){
            $street = test_input($_POST["street"]);
            $streetnr = test_input($_POST["streetnr"]);

            //combining it to address
            $address = $street." ".$streetnr; 
        }
    }

    //zip
    if(isset($_POST["zip"])) {
        $zipValid = check_value("zip", $_POST["zip"]);
        if($zipValid) $zip = test_input($_POST["zip"]);
    }

    //city
    if(isset($_POST["city"])) {
        $cityValid = check_value("city", $_POST["city"]);

        if($cityValid) $city = test_input($_POST["city"]);
    }

    //email
    if(isset($_POST["email"])) {
        $emailValid = check_value("email", $_POST["email"]);
        if($emailValid) $email = test_input($_POST["email"]);
    }

    //username
    if(isset($_POST["uname"])) {
        $unameValid = check_value("uname", $_POST["uname"]);
        if($unameValid) $uname = test_input($_POST["uname"]);
    }

    //encrypt password
    if(isset($_POST["password"])) {
        $pwd = test_input($_POST["password"]);
        $pwd = hash("sha256", $pwd); 
    } 

    //dataValid is the sum of all valid variables
    $dataValid = $fnameValid && $lnameValid && $unameValid && $streetValid && $streetnrValid && $cityValid && $zipValid && $emailValid;
    try {

        //if all data is valid
        if($dataValid) {

            //checking if username or email exists
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

            //errors
            if($unameExists || $emailExists) {
                if($unameExists) throw new Exception("Username already exisits.", 409); 
                if($emailExists) throw new Exception("Email already exists", 409); 
            } 
            
            //if neither exists
            else {

                //insert user into users
                $stmt = $db_obj->prepare($insert_users); 
                $stmt -> bind_param("sssissss", $fname, $lname, $address, $zip, $city, $email, $uname, $pwd); 
                $stmt -> execute();
                $stmt -> close(); 
                echo json_encode(
                    array(
                        'message' => "Success.",
                        'status_code' => 200
                    )
                );

                //getting user id
                $uidQuery = "SELECT ID from users WHERE uname=?"; 

                $arr =""; 
                $stmt = $db_obj->prepare($uidQuery); 
                $stmt->bind_param("s", $uname); 
                $stmt->execute(); 
                $stmt->bind_result($uid);
                while($stmt->fetch()) {
                    $arr = array(
                        'message' => $uid,
                        'status_code' => 9
                    ); 
                    }
                $stmt->close();   


                //setting userstatus to activated and userrights to 2 (default = not admin)
                $statusQuery = "INSERT INTO userstatus(uid) VALUES (?);";

                $userright = "INSERT INTO userrights(uid, rid) VALUES (?,?);";


                $stmt = $db_obj->prepare($statusQuery);
                $stmt->bind_param("i", $uid);
                $stmt->execute(); 
                $stmt->close();

                $i = 2; 
                
                $stmt = $db_obj->prepare($userright);
                $stmt->bind_param("ii", $uid, $i);
                $stmt->execute(); 
                $stmt->close();
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

//checking values
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

//checking if value is only letters
function isLetters($value) {
    return preg_match("/^[a-zA-Z]{1}[a-zA-ZäöüßÄÖÜ]*$/", $value) === 1 ? true : false;
}

//checking if value is only numbers
function isNumbers($value) {
    return preg_match("/[0-9]*$/", $value) === 1 ? true : false; 
}

//checking if value is between two values
function isBetween($value) {
    return (strlen($value) > 3 && strlen($value) < 25) ? true : false; 
}

//checking if email is valid
function emailValid($value) {
    return filter_var($value, FILTER_VALIDATE_EMAIL); 
}
?>