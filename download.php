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

  $sql = "SELECT * FROM `MyGuests` ORDER BY `MyGuests`.`my_id` ASC LIMIT 0, 30 ";
  $result = $conn->query($sql);
  echo $result;

  $conn->close();
 ?>
