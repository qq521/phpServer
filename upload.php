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
  $sql = "INSERT INTO MyGuests (my_id,my_title,my_userName,my_pwd,my_loginURL) VALUES (".$value["loginId"].",'".$value["title"]."','".$value["userName"]."','".$value["password"]."','".$value["loginURL"]."') ";

  $updateSql = " ON DUPLICATE KEY UPDATE my_title = '".$value["title"]."',my_userName = '".$value["userName"]."',my_pwd = '".$value["password"]."',my_loginURL = '".$value["loginURL"]."';";

  $totalSQL =$sql.$updateSql;

  $result = $conn->query($totalSQL);
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
