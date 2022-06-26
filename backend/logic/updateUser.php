<?php


include "../config/dbconnect.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    //Getting all user data
    $uid  = $_POST['id'];
    $uname =$_POST['uname'];
    $fname =$_POST['fname'];
    $lname =$_POST['lname'];
    $email = $_POST['email'];
    $street = $_POST['street'];
    $streetnr = $_POST['streetnr'];
    $address = $street . " " . $streetnr;
    $city =$_POST['city'];
    $zip = $_POST['zip'];


    

}

try{
    
    //query
    $stmt = $db_obj->prepare('UPDATE users SET fname = ?, lname= ?, email = ?, address = ?, city = ?, zip = ? WHERE id = ?'); 
        

    //execute
    if($stmt !== FALSE){
        $stmt -> bind_param('sssssii',$fname, $lname, $email, $address, $city, $zip, $uid);
        $stmt -> execute(); 
        
        echo " User " . $uname . " hab been updated!" ;
        
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


?>

