<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }

include "../config/dbconnect.php";


if(isset($_SESSION["uname"])){
    $uname = $_SESSION['uname'];  
}

try{
    


    $stmt = $db_obj->prepare('SELECT * FROM users WHERE uname = ?'); 

    
    if($stmt !== FALSE)
    {
        $stmt -> bind_param('s',$uname); 
        $stmt -> execute(); 
        $result = $stmt->get_result();

            while($row = $result->fetch_assoc()) {
                $datas[] = $row;   
            }
            $stmt->close();
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