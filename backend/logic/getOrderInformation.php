<?php


include "../config/dbconnect.php";

if($_SERVER["REQUEST_METHOD"] == "GET"){
    $oid  = $_GET['oid'];
    $uid = $_GET['uid'];

    $datas = Array();

    try{
        //statement to get the user information for the order 
        $stmt = $db_obj->prepare('SELECT fname, lname, address, zip, city, email FROM users WHERE ID = ?'); 
            
       
    
        if($stmt !== FALSE){

            //binding params for the ? id 
            $stmt -> bind_param('i',$uid);
            $stmt -> execute(); 

            $stmt->bind_result( $fname, $lname, $address, $zip, $city, $email);

            
            
            while($stmt->fetch()) {
                //putting the user data in an Array  
                array_push($datas, array(

                    "fname" => $fname, 
                    "lname" => $lname, 
                    "adress" => $address, 
                    "zip" => $zip, 
                    "city" => $city, 
                    "email" => $email


                ));


            }

           
            $stmt->close();
            
                
    
        }else{
            echo "no";
        }

    $data = Array();
    //getting products id and the qtys of the products with the help of the Orderid 
    $query =  $db_obj->prepare('SELECT pid, qty FROM productorders WHERE oid = ?');
        
        if($query !== FALSE){
            //binding the params of the statement  ? oid 
            $query -> bind_param('i',$oid);
            $query -> execute(); 
            $query -> bind_result($pid, $qty);
            
            
    
            while($query->fetch()) {
                    //
                array_push($data, array(

                    "pid" => $pid, 
                    "qty" => $qty
                    
                ));


            }


            $query->close();

            //getting the Productname and Productprice with the product ids of the Statement before 
            $s = $db_obj->prepare('SELECT id, product_name, product_price FROM product WHERE id = ?');


            $daten = Array();

            if($s !== FALSE){
                
                //getting the products name and price for each entry in data which was used to store Product id and product qty 
                foreach($data as $value){

                
                    //binding params of the statement pid = ? 
                $s -> bind_param('i', $value["pid"]);
                $s -> execute(); 
                $result = $s -> get_result();
                $r = $result -> fetch_assoc(); 

                     
                array_push($daten, array(
                    "pid" => $r["id"],
                    "pname"=>$r["product_name"], 
                    "pprice"=>$r["product_price"]
                ));


               }


            }

            $s -> close();

            //after getting all the necessary data we give all the arrays a key and put it in an single Array which contains all the information we need to display the orders 
            echo json_encode(array("user" => $datas, "po" => $data, "product" => $daten ));
            
            
            
            
        }

        
     
    
    }catch(Exception $e) {
        echo json_encode(
            array(
                'message' => $e -> getMessage(),
                'status_code' => $e -> getCode()
            )
        );
    }
    

}




?>