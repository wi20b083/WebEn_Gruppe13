<?php


include "../config/dbconnect.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $uid  = $_POST['id'];
    
    $pwd = test_input($_POST["password"]);
    $pwd = hash("sha256", $pwd); 
    

}

try{
    
    $stmt = $db_obj->prepare('UPDATE users SET pwd = ? WHERE id = ?'); 
        


    if($stmt !== FALSE){
        $stmt -> bind_param('si',$pwd, $uid);
        $stmt -> execute(); 
        
        echo "Password changed successfully!" ;
        
        $stmt->close();    

    }else{
        echo "Something went wrong!";
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

