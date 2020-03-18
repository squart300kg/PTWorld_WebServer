<?php
$servername = "localhost";
$username = "squart300kg";
$password = "squart300";
$dbname = "squart300kg";

$db = mysqli_connect($servername, $username, $password, $dbname) or die("mysqli_connect fail...");

$contents = $_POST['contents'];
$nickname = $_POST['nickname'];
$TYPE = $_POST['TYPE'];
$targetNickname = $_POST['targetNickname'];

$sql = "INSERT INTO noti_history VALUES (0, 'id', '$nickname', '$contents', '$TYPE', '$targetNickname')";
$result = mysqli_query($db, $sql);

if($result == true)
{
  echo "노티 삽입 성공";
}
else {
  echo "노티 삽입 실패";
}

 ?>
