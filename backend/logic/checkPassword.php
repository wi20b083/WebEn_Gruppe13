<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
include "../config/dbconnect.php";

//check if Seesion uname is sett and if yes  get the value 
if(isset($_SESSION["uname"])){
    $uname = $_SESSION['uname']; 
    
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    //encrypt the password 
    $password = hash("sha256", test_input($_POST["password"]));
}




try{
    

    //gets the user with the enterd pw ..and the Session uname 
    $stmt = $db_obj->prepare( "SELECT * FROM users WHERE uname = ? AND pwd = ?"); 

    
    if($stmt !== FALSE)
    {
        $stmt -> bind_param('ss',$uname, $password); 
        $stmt -> execute(); 
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        //if it is not empty -- User exists and password is entered right  -- else User does not exist with Session name and entered password 
        if(!empty($row)) {
            $dataValid["valid"] = true;  

        } else {
            $dataValid["valid"] = false;
        }

        //echo the output 
        echo json_encode($dataValid);
        
        $db_obj->close();
        $stmt->close();
           

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

//help functio for hashing the password 
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}





?>