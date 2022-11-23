<?php  
require_once('../db/connect.php');
$connEntity = new Connect();
$conn = $connEntity->load_connect();
 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

$email = $_POST['email'];
$password = $_POST['password'];
$username = $_POST['username'];

$sql = "
  INSERT INTO user_tb (
    USER_EMAIL
    , USER_PASSWORD
    , USER_NAME
    , USER_CREATEDATE
  ) VALUES (
    '$email'
    , '$password'
    , '$username'
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