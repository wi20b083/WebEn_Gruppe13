<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }

include "../config/dbconnect.php";


if(isset($_SESSION["uname"])){
    $uname = $_SESSION['uname']; 
    
}

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $password = hash("sha256", test_input($_POST["password"]));
}




try{
    


    $stmt = $db_obj->prepare( "SELECT * FROM users WHERE uname = ? AND pwd = ?"); 

    
    if($stmt !== FALSE)
    {
        $stmt -> bind_param('ss',$uname, $password); 
        $stmt -> execute(); 
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if(!empty($row)) {
            $dataValid["valid"] = true;  

        } else {
            $dataValid["valid"] = false;
        }


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

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}





?>