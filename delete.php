<?php
header('content-type:text/json');
$postData =  file_get_contents("php://input");
$obj = json_decode($postData,true);
$dbInfo = $obj["dbInfo"];
$dataArray =  $obj["data"];

$servername = $dbInfo["servername"];
$username = $dbInfo["username"];
$password = $dbInfo["password"];
$dbname = $dbInfo["dbname"];

 $conn = new mysqli($servername, $username, $password, $dbname);

 if ($conn->connect_error) {
     die("打开失败: " . $conn->connect_error);
 }

foreach ($dataArray as $key => $value) {
  $sql = "DELETE FROM MyGuests WHERE my_id = " .$value;
  $result = $conn->query($sql);
  if ($result == false) {
    $response = array ("succeed"=>0);
    echo json_encode($response);
    return;
  }
}

$response = array ("succeed"=>1);
echo json_encode($response);
 $conn->close();
 ?>
