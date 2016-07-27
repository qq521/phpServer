<?php
header('content-type:text/json');
 $servername = "localhost";
 $username = "u849025525_mydb";
 $password = "qq1314521";
 $dbname = "u849025525_mydb";

 $conn = new mysqli($servername, $username, $password, $dbname);

 if ($conn->connect_error) {
     die("&#36830;&#25509;&#22833;&#36133;: " . $conn->connect_error);
 }

$postData =  file_get_contents("php://input");
$obj = json_decode($postData,true);
$dataArray =  $obj["data"];

foreach ($dataArray as $key => $value) {
  $sql = "INSERT INTO MyGuests (my_id,my_title,my_userName,my_pwd,my_loginURL) VALUES ('".$value["loginId"]."' ,'".$value["title"]."','".$value["userName"]."','".$value["password"]."','".$value["loginURL"]."');";
  echo $sql;
  $result = $conn->query($sql);
  echo $result;
}
 $conn->close();
 ?>
