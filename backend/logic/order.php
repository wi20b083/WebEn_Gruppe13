<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once "../config/dbconnect.php"; 
if($_SERVER["REQUEST_METHOD"] == "GET"){ 
    if (isset($_SESSION["uname"])) {   
        $sql = 'SELECT ID, fname, lname, address, zip, city, email FROM users WHERE uname=?'; 
        $stmt = $db_obj->prepare($sql); 
        $stmt->bind_param('s', $_SESSION["uname"]); 
        $stmt->execute(); 
        $res = $stmt->get_result(); 
        $r = $res->fetch_assoc(); 
        $userID = $r['ID']; 
        $stmt->close();

        echo "UID: ". $userID." "; 

        $sql="INSERT INTO orders (id, uid, timestamp) VALUES (null,?, null);"; 
        $stmt = $db_obj->prepare($sql);
        $stmt->bind_param('i', $userID);
        $stmt->execute(); 
        $stmt->close();
        
        $sql="SELECT MAX(id) FROM orders WHERE uid =?;"; 
        $stmt = $db_obj->prepare($sql);
        $stmt->bind_param('i', $userID);
        $stmt->execute(); 
        $res = $stmt->get_result(); 
        $r = $res->fetch_assoc(); 
        $oid = $r["MAX(id)"];  
        $stmt->close();

        echo "OID: ". $oid." ";  

        $arr = array(); 

        $sql = 'SELECT * FROM cart WHERE userID=?'; 
        $stmt = $db_obj->prepare($sql);
        $stmt->bind_param('i', $userID);
        $stmt->execute();
        $stmt->bind_result($pid, $product_name, $product_price, $product_image, $qty, $total_price, $product_code, $userID);
        while($stmt->fetch()) {
             array_push(
                $arr,
                array(
                    "pid" => $pid, 
                    "qty" => $qty,
                )
             ); 
        } 

        $stmt->close();  

        print_r($arr);
        $sql = "INSERT INTO productorders (id, pid, qty, oid) VALUES (null, ?, ?, ?)";
        $stmt=$db_obj->prepare($sql);
        foreach($arr as $product){
            $stmt->bind_param("iii", $product["pid"], $product["qty"], $oid); 
            $stmt->execute(); 
        }

        $stmt->close();
    
    }
}
    ?>