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
$writter_nickname = $_POST['writter_nickname'];

$sql_rereply_insert = "INSERT INTO rereply VALUES (0, '$contents', '$nickname', '$email', $replyno)";
$result_rereply_insert = mysqli_query($db, $sql_rereply_insert);


$sql_select_device_token = "SELECT device_token FROM trainner WHERE nickname = '$writter_nickname'";
$result_select_device_token = mysqli_query($db, $sql_select_device_token);
$row_select_device_token = mysqli_fetch_array($result_select_device_token);

//대댓글 번호를 뱉자
$sql_select_rereplyno = "SELECT rereplyno FROM rereply WHERE contents = '$contents' AND nickname = '$nickname' AND email = '$email' AND replyno = $replyno";
$result_select_rereplyno = mysqli_query($db, $sql_select_rereplyno);
$row_select_rereplyno = mysqli_fetch_array($result_select_rereplyno);

$rereplyno = $row_select_rereplyno[0];
if($result_rereply_insert == true){
  $device_token = $row_select_device_token[0];
  echo $replyno . "AND" . $device_token . "AND" . $rereplyno;
} else {
  echo "대댓글 등록 에러...ㅠ";
}
 ?>
