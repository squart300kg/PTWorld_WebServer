<?php
$servername = "localhost";
$username = "squart300kg";
$password = "squart300";
$dbname = "squart300kg";

$db = mysqli_connect($servername, $username, $password, $dbname) or die("mysqli_connect fail...");


$no = $_POST['no'];

$sql_like_list = "SELECT * FROM likes WHERE likeboardno = $no";
$result_like_list = mysqli_query($db, $sql_like_list);

$cnt = 0;
$arr =array();
while($row_like_list = mysqli_fetch_array($result_like_list)){
  $count = $cnt;
  $email = $row_like_list['email'];
  $sql_profileImage = "SELECT profile_image FROM trainner WHERE email = '$email'";
  $result_profileImage = mysqli_query($db, $sql_profileImage);
  $row_profileImage = mysqli_fetch_array($result_profileImage);
  $arr[$count]['profile_image'] = base64_encode($row_profileImage['profile_image']);

  $arr[$count]['email'] = $row_like_list['email'];
  $arr[$count]['nickname'] = $row_like_list['nickname'];
  $cnt ++;
}
print(json_encode($arr));
 ?>
