<?php
$servername = "localhost";
$username = "squart300kg";
$password = "squart300";
$dbname = "squart300kg";

$db = mysqli_connect($servername, $username, $password, $dbname) or die("mysqli_connect fail...");

$no = (int)$_POST['no'];

$sql_select_reply = "SELECT * FROM reply WHERE boardno = $no";
$result_select_reply = mysqli_query($db, $sql_select_reply);

$cnt = 0;
$arr = array();
while($row_select_reply = mysqli_fetch_array($result_select_reply)){
  $count = $cnt;
  $arr[$count]['boardno'] = $row_select_reply['boardno'];
  $arr[$count]['email'] = $row_select_reply['email'];
  $email = $row_select_reply['email'];
  $sql_profileImage = "SELECT profile_image, device_token FROM trainner WHERE email = '$email'";
  $result_profileImage = mysqli_query($db, $sql_profileImage);
  $row_profileImage = mysqli_fetch_array($result_profileImage);

  $arr[$count]['device_token'] = $row_profileImage['device_token'];
  $arr[$count]['profile_image'] = base64_encode($row_profileImage['profile_image']);
  $arr[$count]['nickname'] = $row_select_reply['nickname'];
  $arr[$count]['contents'] = $row_select_reply['contents'];
  $arr[$count]['replyno'] = $row_select_reply['replyno'];
  $arr[$count]['boardno'] = $no;
  $cnt ++;
}
print(json_encode($arr));
 ?>
