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


  $sql = "INSERT INTO MyGuests (my_title,my_userName,my_pwd,my_loginURL) VALUES ('".$value["title"]."','".$value["userName"]."','".$value["password"]."','".$value["loginURL"]."') ON DUPLICATE KEY UPDATE my_id = '".$value["loginId"]."';";
  echo $sql;
  $result = $conn->query($sql);
  echo $result;
}
 $conn->close();
 ?>
