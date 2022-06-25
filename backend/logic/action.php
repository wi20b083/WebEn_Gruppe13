<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../config/dbconnect.php';

//add to cart
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $response = ""; 
    if(isset($_POST["method"])) {
        $method = $_POST["method"]; 
        switch($method) {
            case "add": {
                if (isset($_POST['pid']) 
                && isset($_POST['pname']) 
                && isset($_POST['pprice']) 
                && isset($_POST['pimage']) 
                && isset($_POST['pcode']) 
                && isset($_POST['pqty'])) {

                    if(isset($_SESSION["uname"])) {
                        //getting all product information
                        $pid = $_POST['pid'];
                        $pname = $_POST['pname'];
                        $pprice = $_POST['pprice'];
                        $pimage = $_POST['pimage'];
                        $pcode = $_POST['pcode'];
                        $pqty = $_POST['pqty'];
                        $total_price = $pprice * $pqty;

                        $sql = 'SELECT ID FROM users WHERE uname=?'; 
                        $stmt = $db_obj->prepare($sql); 
                        $stmt->bind_param('s', $_SESSION["uname"]); 
                        $stmt->execute(); 
                        $res = $stmt->get_result(); 
                        $r = $res->fetch_assoc(); 
                        $userID = $r['ID']; 
                        $stmt->close(); 
                        
                        $sql = 'SELECT product_code FROM cart WHERE product_code=? AND userID=?'; 
                        $stmt = $db_obj->prepare($sql);
                        $stmt->bind_param('si',$pcode, $userID);
                        $stmt->execute();
                        $res = $stmt->get_result();
                        $r = $res->fetch_assoc();
                        $code = $r['product_code'] ?? '';
                        $stmt->close();

                        //if it hasn't been added to the cart yet
                        if (!$code) {
                            $sql = 'INSERT INTO cart (pid, product_name,product_price,product_image,qty,total_price,product_code,userID) VALUES (?,?,?,?,?,?,?,?)'; 
                            $query = $db_obj->prepare($sql);
                            $query->bind_param('issssssi',$pid, $pname,$pprice,$pimage,$pqty,$total_price,$pcode,$userID);
                            $query->execute();
                            $query->close(); 

                            $response = array( 
                                "message" => "Item has been added to your cart.");
                        } else {
                            $response = array( 
                                "message" => "Item has already been added to your cart.");
                        }

                    } else {
                        $response = array(
                            "message" => "Please log in to continue."
                        );
                    }
                } else {
                    $response = array(
                        "message" => "Invalid data."
                    );
                }
                break; 
            }

            case "update": {
                if (isset($_POST['qty'])) {
                    $sql = 'SELECT ID FROM users WHERE uname=?'; 
                    $stmt = $db_obj->prepare($sql); 
                    $stmt->bind_param('s', $_SESSION["uname"]); 
                    $stmt->execute(); 
                    $res = $stmt->get_result(); 
                    $r = $res->fetch_assoc(); 
                    $userID = $r['ID']; 
                    $stmt->close();

                    $qty = $_POST['qty'];

                    if($qty > 0) {
                    $pid = $_POST['pid'];
                    $pprice = $_POST['pprice'];
              
                    $tprice = $qty * $pprice;
              
                    $stmt = $db_obj->prepare('UPDATE cart SET qty=?, total_price=? WHERE id=? AND userID=?');
                    $stmt->bind_param('isii',$qty,$tprice,$pid,$userID);
                    $stmt->execute();
                    }
                  } 
                  break;              
            }

            default: {
                $response = array(
                    "message" => "Invalid method."
                );
                break; 
            }
        }
    } else {
        $response = array(
            "message" => "Invalid method."
        ); 
    }

    echo json_encode($response); 
} else if($_SERVER["REQUEST_METHOD"] == "GET") {   
    

    if(isset($_SESSION["uname"]) && !isset($_GET["remove"]) && !isset($_GET["method"])) {
        $sql = 'SELECT * FROM users WHERE uname=?'; 
        $stmt = $db_obj->prepare($sql); 
        $stmt->bind_param('s', $_SESSION["uname"]); 
        $stmt->execute(); 
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();  
        $userID = $row["ID"];   
        $stmt->close(); 

        $sql = 'SELECT * FROM cart WHERE userID=?'; 
        $stmt = $db_obj->prepare($sql);
        $stmt->bind_param('i', $userID);
        $stmt->execute();
        $stmt->bind_result($id, $pid, $product_name, $product_price, $product_image, $qty, $total_price, $product_code, $userID);
        $count = 0; 
        $product_arr = array(); 
        while($stmt->fetch()) {
            array_push(
                $product_arr,
                array(
                   "id" => $id,
                   "pid" => $pid,
                   "product_name" => $product_name, 
                   "product_price" => $product_price, 
                   "product_image" => $product_image, 
                   "qty" => $qty,
                   "total_price" => $total_price,
                   "product_code" => $product_code, 
                   "userID" => $userID
                )
            );
            $count = $count + $qty; 
        }
        $stmt->close(); 
        $response = array("uname" => $_SESSION["uname"], "userID" => $userID, "count" => $count, "data" => $product_arr); 
        echo json_encode($response); 

    } else if(isset($_SESSION["uname"]) && isset($_GET["remove"]) && !isset($_GET["method"])) {
            $sql = 'SELECT * FROM users WHERE uname=?'; 
            $stmt = $db_obj->prepare($sql); 
            $stmt->bind_param('s', $_SESSION["uname"]); 
            $stmt->execute(); 
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();  
            $userID = $row["ID"];   
            $stmt->close();

            $remove = $_GET["remove"]; 
            if($remove === "all") {
                $stmt = $db_obj->prepare('DELETE FROM cart WHERE userID=?');
                $stmt->bind_param('i',$userID);
                $stmt->execute();
            } else if(is_numeric($remove)) {
                $id = $_GET['remove'];
                $stmt = $db_obj->prepare('DELETE FROM cart WHERE id=? AND userID=?');
                $stmt->bind_param('ii',$id, $userID);
                $stmt->execute();
            } 
        }
    }
?>