<?php
$servername = "localhost";
$username = "squart300kg";
$password = "squart300";
$dbname = "squart300kg";

$db = mysqli_connect($servername, $username, $password, $dbname) or die("mysqli_connect fail...");

$nickname = $_POST['nickname'];

$sql = "SELECT * FROM noti_history WHERE targetNickname = '$nickname'";
$result = mysqli_query($db, $sql);

$cnt = 0;
$arr = array();
while($row = mysqli_fetch_array($result)){
  $count = $cnt;

  $fromNickname = $row['nickname'];
  $sql_profileImage = "SELECT profile_image FROM trainner WHERE nickname = '$fromNickname'";
  $result_profileImage = mysqli_query($db, $sql_profileImage);
  $row_profileImage = mysqli_fetch_array($result_profileImage);
  $arr[$count]['nickname'] = $row['nickname'];
  $arr[$count]['contents'] = $row['contents'];
  $arr[$count]['profile_image'] = base64_encode($row_profileImage['profile_image']);

  $cnt ++;
}
print(json_encode($arr));
 ?>
