<?php


include "../config/dbconnect.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $uid  = $_POST['id'];
    

    

}

try{
    //gets all order from the user which is currently logged in 
    $stmt = $db_obj->prepare('SELECT * FROM orders WHERE uid = ?'); 
        
    $datas = Array();

    if($stmt !== FALSE){
        $stmt -> bind_param('i',$uid);
        $stmt -> execute(); 
        
        $result = $stmt->get_result();
        //parsing order data in datas variable 
        while($row = $result->fetch_assoc()) {
            $datas[] = $row;   
        }

        $db_obj->close();
        $stmt->close();
        //echoing the output 
        echo json_encode($datas);
    
        
        
            

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

