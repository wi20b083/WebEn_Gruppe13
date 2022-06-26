<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once "../config/dbconnect.php"; 

if($_SERVER["REQUEST_METHOD"] === "GET" 
&& isset($_GET["method"])) {
    $id = $product_name = $product_price = $product_image = $product_code = $product_category = "";
    $product_arr = array(); 
    //switch for diffrent methods 
    switch($_GET["method"]) {
        //case all --> getting all products to display on main product page 
        case "all": { 
            $sql = "SELECT * FROM product"; 
            $stmt = $db_obj->prepare($sql);
            $stmt->execute(); 
            $stmt->bind_result($id, $product_name, $product_price, $product_image, $product_code, $product_category); 
            while($stmt->fetch()) {
                array_push(
                    $product_arr,
                    array(
                       "id" => $id,
                       "product_name" => $product_name, 
                       "product_price" => $product_price, 
                       "product_image" => $product_image, 
                       "product_code" => $product_code, 
                       "product_category" => $product_category
                    )
                );  
            }
            $stmt->close(); 
            echo json_encode($product_arr);
            break; 
        }
        //getting all the products where category = "Shirt" 
        case "shirt": {
            $sql = "SELECT * FROM product WHERE product_category = 'Shirt';"; 
            $stmt = $db_obj->prepare($sql);
            $stmt->execute(); 
            $stmt->bind_result($id, $product_name, $product_price, $product_image, $product_code, $product_category); 
            while($stmt->fetch()) {
                array_push(
                    $product_arr,
                    array(
                       "id" => $id,
                       "product_name" => $product_name, 
                       "product_price" => $product_price, 
                       "product_image" => $product_image, 
                       "product_code" => $product_code, 
                       "product_category" => $product_category
                    )
                );  
            }
            $stmt->close(); 
            echo json_encode($product_arr);
            break;
        }
        //getting all the products where category = "Pullover"
        case "sweater": {
            $sql = "SELECT * FROM product WHERE product_category = 'Pullover';";            
            $stmt = $db_obj->prepare($sql);
            $stmt->execute(); 
            $stmt->bind_result($id, $product_name, $product_price, $product_image, $product_code, $product_category); 
            while($stmt->fetch()) {
                array_push(
                    $product_arr,
                    array(
                       "id" => $id,
                       "product_name" => $product_name, 
                       "product_price" => $product_price, 
                       "product_image" => $product_image, 
                       "product_code" => $product_code, 
                       "product_category" => $product_category
                    )
                );  
            }
            $stmt->close(); 
            echo json_encode($product_arr);
            break;
        }
        //getting all the products where category = "Hose "
        case "pants": {
            $sql = "SELECT * FROM product WHERE product_category = 'Hose';"; 
            $stmt = $db_obj->prepare($sql);
            $stmt->execute(); 
            $stmt->bind_result($id, $product_name, $product_price, $product_image, $product_code, $product_category); 
            while($stmt->fetch()) {
                array_push(
                    $product_arr,
                    array(
                       "id" => $id,
                       "product_name" => $product_name, 
                       "product_price" => $product_price, 
                       "product_image" => $product_image, 
                       "product_code" => $product_code, 
                       "product_category" => $product_category
                    )
                );  
            }
            $stmt->close(); 
            echo json_encode($product_arr);
            break;
        }
    //default getting all the products where product name is like the searchterm   
    default: {
        $searchterm = $_GET['method']; 
        $sql = "SELECT * FROM product WHERE product_name LIKE '%{$searchterm}%';";            
        $stmt = $db_obj->prepare($sql);
        $stmt->execute(); 
        $stmt->bind_result($id, $product_name, $product_price, $product_image, $product_code, $product_category); 
        while($stmt->fetch()) {
            array_push(
                $product_arr,
                array(
                   "id" => $id,
                   "product_name" => $product_name, 
                   "product_price" => $product_price, 
                   "product_image" => $product_image, 
                   "product_code" => $product_code, 
                   "product_category" => $product_category
                )
            );  
        }
        $stmt->close(); 
        echo json_encode($product_arr);
        break;
        } 
    }
}
?>