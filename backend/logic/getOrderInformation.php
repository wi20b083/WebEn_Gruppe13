<?php


include "../config/dbconnect.php";

if($_SERVER["REQUEST_METHOD"] == "GET"){
    $oid  = $_GET['oid'];
    $uid = $_GET['uid'];

    $datas = Array();

    try{
    
        $stmt = $db_obj->prepare('SELECT fname, lname, address, zip, city, email FROM users WHERE ID = ?'); 
            
       
    
        if($stmt !== FALSE){
            $stmt -> bind_param('i',$uid);
            $stmt -> execute(); 

            $stmt->bind_result( $fname, $lname, $address, $zip, $city, $email);

            
            
            while($stmt->fetch()) {

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
    $query =  $db_obj->prepare('SELECT pid, qty FROM productorders WHERE oid = ?');
        
        if($query !== FALSE){
            $query -> bind_param('i',$oid);
            $query -> execute(); 
            $query -> bind_result($pid, $qty);
            
            
    
            while($query->fetch()) {

                array_push($data, array(

                    "pid" => $pid, 
                    "qty" => $qty
                    
                ));


            }


            $query->close();
            $s = $db_obj->prepare('SELECT id, product_name, product_price FROM product WHERE id = ?');


            $daten = Array();

            if($s !== FALSE){
                

                foreach($data as $value){

                

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