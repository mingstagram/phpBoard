<?php  
require_once('../db/config.php');
error_reporting(E_ALL);
    ini_set("display_errors", 1);
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

$title = $_POST['title'];
$content = $_POST['content'];
$response = Array();

$sql = "
  INSERT INTO board_tb (
    BOARD_TITLE
    , BOARD_CONTENT 
    , BOARD_CREATEDATE
  ) VALUES (
    '$title'
    , '$content' 
    , NOW()
  )
";   
$result = mysqli_query($conn, $sql); 
if ($result) {
    $response['result'] = 'success';
  } else {
    $response['result'] = 'fail';
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  echo json_encode($response);

?>