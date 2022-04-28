<?php
//setting up database access

//TODO: Pfad
require_once ('C:/xampp/htdocs/WebProjekt/utility/dbaccess.php');
$db_obj = new mysqli($host, $user, $password, $database);

//if there is a connection error, echo a message and exit
if ($db_obj->connect_error) {
    echo "Connection Error: " . $db_obj->connect_error;
    exit();
}
?>