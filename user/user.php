<?php 
class User {
    
    public $conn ;
    function __construct (){
        require_once('../db/config.php');
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
    }
    
    function select_info($data){ 

        $sql = "SELECT * FROM user_tb WHERE USER_EMAIL = {$data['email']} AND USER_PASSWORD = {$data['password']} LIMIT 1"; 
        $result = mysqli_query($this->conn, $sql);
        
        $row = $result->fetch_assoc();
        return $row;
        
    }

}

?>