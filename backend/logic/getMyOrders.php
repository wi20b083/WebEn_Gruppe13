<?php


include "../config/dbconnect.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $uid  = $_POST['id'];
    

    

}

try{
    
    $stmt = $db_obj->prepare('SELECT * FROM orders WHERE uid = ?'); 
        
    $datas = Array();

    if($stmt !== FALSE){
        $stmt -> bind_param('i',$uid);
        $stmt -> execute(); 
        
        $result = $stmt->get_result();

        while($row = $result->fetch_assoc()) {
            $datas[] = $row;   
        }

        echo json_encode($datas);
    
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


?>

