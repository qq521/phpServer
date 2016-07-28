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

  while ($row = mysqli_fetch_assoc($result))
  {
    echo "question_title : {$row['my_id']} <br>";
  }
  echo json_encode($result->num_rows);

 $conn->close();
 ?>
