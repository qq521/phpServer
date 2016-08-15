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

  $sql = "SELECT id,content FROM MessageList ;";
  $result = $conn->query($sql);
  if ($result == false) {
    $response = array ("succeed"=>0);
    echo json_encode($response);
    return;
  }
  $resultArr = array();
  while ($row = mysqli_fetch_assoc($result))
  {
    $array = is_object($row) ? get_object_vars($obj) : $row;
    array_push($resultArr,$array);
  }
  $response = array ("succeed" => 1,"infoList"=>$resultArr);
  echo json_encode($response);

 $conn->close();
 ?>
