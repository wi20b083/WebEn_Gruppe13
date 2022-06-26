<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once "../config/dbconnect.php"; 
if($_SERVER["REQUEST_METHOD"] == "GET"){ 
    if (isset($_SESSION["uname"])) {   

        //getting the  user data where uname = Session Uname 
        $sql = 'SELECT ID, fname, lname, address, zip, city, email FROM users WHERE uname=?'; 
        $stmt = $db_obj->prepare($sql); 
        $stmt->bind_param('s', $_SESSION["uname"]); 
        $stmt->execute(); 
        $res = $stmt->get_result(); 
        $r = $res->fetch_assoc(); 
        $userID = $r['ID']; 
        $stmt->close();

        
        //inserting into the orders table + timestamp 
        $sql="INSERT INTO orders (id, uid, timestamp) VALUES (null,?, null);"; 
        $stmt = $db_obj->prepare($sql);
        //binding params with the above gained uid 
        $stmt->bind_param('i', $userID);
        $stmt->execute(); 
        $stmt->close();
        //getting the last order whre uid = ?
        $sql="SELECT MAX(id) FROM orders WHERE uid =?;"; 
        $stmt = $db_obj->prepare($sql);
        $stmt->bind_param('i', $userID);
        $stmt->execute(); 
        $res = $stmt->get_result(); 
        $r = $res->fetch_assoc(); 
        $oid = $r["MAX(id)"];  
        $stmt->close();

        

        $arr = array(); 
        //getting all the  items of the cart where user id = ?
        $sql = 'SELECT * FROM cart WHERE userID=?'; 
        $stmt = $db_obj->prepare($sql);
        //binding params
        $stmt->bind_param('i', $userID);
        $stmt->execute();
        $stmt->bind_result($id, $pid, $product_name, $product_price, $product_image, $qty, $total_price, $product_code, $userID);
        while($stmt->fetch()) {
            //reading out the needed information and putting it into an array 
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
        //inserting the product id , prodcuts qty and order id 
        $sql = "INSERT INTO productorders (id, pid, qty, oid) VALUES (null, ?, ?, ?)";
        $stmt=$db_obj->prepare($sql);
        foreach($arr as $product){
            //binding params 
            $stmt->bind_param("iii", $product["pid"], $product["qty"], $oid); 
            $stmt->execute(); 
        }

        $stmt->close();
    
    }
}
    ?>