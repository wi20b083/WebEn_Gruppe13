<?php
include $GLOBALS["path"]."/backend/config/dbconnect.php"; 



/*TODO: 

Daten Validieren

Daten in JSON packen

Daten im Backend empfangen

Daten in DB eintragen

Weiterleiten 

*/
    // REGISTER USER
if(isset($_POST['submit'])) {
    // receive all input values from the form
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confpassword = $_POST['confpassword'];
    $email = $_POST['mail'];
    $street = $_POST['street'];
    $streetn = $_POST['streetn'];
    $loc = $_POST['loc'];
    $zip =  $_POST['zip'];
    $stat = "1"; 

  
    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $_SESSION["errors"] array
    if ($password != $confpassword) {
      array_push($_SESSION["errors"], "The two passwords do not match");
    }
  
    // first check the database to make sure 
    // a user does not already exist with the same username
    $user_check_query = "SELECT * FROM users WHERE username=?";

    $statement=$db->prepare($user_check_query);
    $statement-> bind_param("s",$username); 
    $statement->execute();
    $result=$statement->get_result();
    $numb_rows=mysqli_num_rows($result);
    $statement->close();
    if (mysqli_num_rows($result) > 0){
        array_push($_SESSION["errors"], "Username Exists");
    
    } 
    if (count($_SESSION["errors"]) == 0) {
        $password = password_hash($password, PASSWORD_BCRYPT); //encrypt the password before saving in the database
        // Finally, register user if there are no errors in the form
        $query = "INSERT INTO users (name, lastname, mail, street, strnumber, loc, zip, password, username, stat) VALUES(?,?,?,?,?,?,?,?,?,?)";
        $statement=$db->prepare($query);
        $statement->bind_param("ssssisissi", $name, $lastname, $email, $street, $streetn, $loc, $zip, $password, $username, $stat);
        $statement->execute();
        $statement->close();
                    
    
        header("Location: http://localhost/WebEnProject/frontend/index.html");
        exit;     
    }else{
      //TODO: span mit error in form einfügen...


    }
  



}
    
    
    
  

?>