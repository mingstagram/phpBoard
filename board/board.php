<?php 
class Board {
    // public $conn; 
    // function __construct() {
    //     require_once('./db/config.php');
    //     $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

    //     if ($conn->connect_error) {
    //     die("Connection failed: " . $conn->connect_error);
    //     }
    // } 

    function select_board(){
        $sql = "SELECT * FROM board_tb"; 
        $result = mysqli_query($this->conn, $sql);
        $list = Array();
        while($row = mysqli_fetch_array($result)){
            $list .= $row;
        }
        return $list;
    }
}

?>