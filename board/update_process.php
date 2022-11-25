<?php    
require_once("../db/connect.php");
$connEntity = new Connect();
$conn = $connEntity->load_connect();
$boardId = $_POST['boardId'];
$title = $_POST['title'];
$content = $_POST['content'];
 
$response = Array();

$sql = "
  UPDATE board_tb SET
  BOARD_TITLE = '$title',
  BOARD_CONTENT = '$content',
  BOARD_UPDATEDATE = NOW()
  WHERE BOARD_ID = '$boardId'
";    

$result = mysqli_query($conn, $sql);  

if ($result) {
    $response['result'] = 'success';
  } else {
    $response['result'] = 'fail'; 
  }
  echo json_encode($response);

?>