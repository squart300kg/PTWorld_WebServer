<?php
$servername = "localhost";
$username = "squart300kg";
$password = "squart300";
$dbname = "squart300kg";

$db = mysqli_connect($servername, $username, $password, $dbname) or die("mysqli_connect fail...");

$no = (int)$_POST['no'];
$email = $_POST['email'];
$nickname = $_POST['nickname'];
$contents1 = $_POST['contents'];
$contents = mysqli_real_escape_string($db, $contents1);
$writter_nickname = $_POST['writter_nickname'];

$sql_reply_insert = "INSERT INTO reply VALUES ($no, '$email', '$nickname', '$contents', 0)";
$result_reply_insert = mysqli_query($db, $sql_reply_insert);

//기기토큰을 받아온다.
$sql_select_device_token = "SELECT device_token FROM trainner WHERE nickname = '$writter_nickname'";
$result_select_device_token = mysqli_query($db, $sql_select_device_token);
$row_select_device_token = mysqli_fetch_array($result_select_device_token);

//댓글번호를 받아온다.
$sql_select_replyno = "SELECT replyno FROM reply WHERE boardno = $no AND email = '$email' AND contents = '$contents' AND nickname = '$nickname'";
$result_select_replyno = mysqli_query($db, $sql_select_replyno);
$row_select_replyno = mysqli_fetch_array($result_select_replyno);
$replyno = $row_select_replyno[0];
if($result_reply_insert == true){
  $device_token = $row_select_device_token['device_token'];
  echo "$device_token" . "AND" . "$no" . "AND" . "$replyno";
} else {
  echo "댓글 등록 에러...ㅠ";
}
 ?>
