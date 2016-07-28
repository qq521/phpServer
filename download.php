<?php
header('content-type:text/json');
$postData =  file_get_contents("php://input");
$obj = json_decode($postData,true);
$dbInfo = $obj["dbInfo"];

 $servername = $dbInfo["servername"];
 $username = $dbInfo["username"];
 $password = $dbInfo["password"];
 $dbname = $dbInfo["dbname"];

 $conn = new mysqli($servername, $username, $password, $dbname);

 if ($conn->connect_error) {
     die("打开失败: " . $conn->connect_error);
 }

  $sql = "SELECT my_id,my_title,my_userName,my_pwd,my_loginURL FROM MyGuests ;";
  $result = $conn->query($sql);
  $arr = array();
  while ($row = mysqli_fetch_assoc($result))
  {
    $array_push($row);
  }
  echo json_encode($arr);

 $conn->close();
 ?>
