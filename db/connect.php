<?php 
class Connect {
    function load_connect(){
        include('config.php');
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        return $conn;
    }
}


?>