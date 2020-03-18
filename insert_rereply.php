<?php
$servername = "localhost";
$username = "squart300kg";
$password = "squart300";
$dbname = "squart300kg";

$db = mysqli_connect($servername, $username, $password, $dbname) or die("mysqli_connect fail...");

$replyno = (int)$_POST['replyno'];
$email = $_POST['email'];
$nickname = $_POST['nickname'];
$contents1 = $_POST['contents'];
$contents = mysqli_real_escape_string($db, $contents1);

$sql_rereply_insert = "INSERT INTO rereply VALUES ('$contents', '$nickname', '$email', $replyno,  0)";
$result_rereply_insert = mysqli_query($db, $sql_rereply_insert);

if($result_rereply_insert == true){
  echo $replyno;
} else {
  echo "대댓글 등록 에러...ㅠ";
}
 ?>
