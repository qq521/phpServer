<?php
header('content-type:text/json');
$postData =  file_get_contents("php://input");
$obj = json_decode($postData,true);
$dataArray =  $obj["data"];
$dbInfo = $obj["dbInfo"];

 $servername = $dbInfo["servername"];
 $username = $dbInfo["username"];
 $password = $dbInfo["password"];
 $dbname = $dbInfo["dbname"];

 $conn = new mysqli($servername, $username, $password, $dbname);

 if ($conn->connect_error) {
     die("打开失败: " . $conn->connect_error);
 }

foreach ($dataArray as $key => $value) {
  $sql = "INSERT INTO MessageList (id,content) VALUES ($value[messageId],'$value[content]');";

  $totalSQL =$sql;
  $result = $conn->query($totalSQL);
  if ($result == false) {
    $response = array ("succeed"=>0,"sql"=>$totalSQL);
    echo json_encode($response);
    return;
  }
}
$response = array ("succeed"=>1);
echo json_encode($response);
 $conn->close();
 ?>
