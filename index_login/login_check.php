<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();
require_once('../db/connect.php');
$connEntity = new Connect();
$conn = $connEntity->load_connect();

$email = $_POST['email'];
$password = $_POST['password'];

$data = array(
    'email'=>$email,
    'password'=>$password
); 
$response = Array();
$sql = "SELECT * FROM user_tb WHERE USER_EMAIL = '{$data['email']}' AND USER_PASSWORD = '{$data['password']}' LIMIT 1"; 
$result = mysqli_query($conn, $sql); 
$row = $result->fetch_assoc();  
if($row){ 
    $_SESSION['session_id'] = "session_".$row['USER_ID']; 
    $response['result'] = "success";
} else {  
    $response['result'] = "fail";
}
echo json_encode($response);

?>