<?php
$servername = "localhost";
$username = "squart300kg";
$password = "squart300";
$dbname = "squart300kg";

$db = mysqli_connect($servername, $username, $password, $dbname) or die("mysqli_connect fail...");

$email = $_POST['email'];

$sql_select_contents_history = "SELECT * FROM views WHERE email = '$email'";
$result_select_contents_history = mysqli_query($db, $sql_select_contents_history);

$cnt = 0;
$arr = array();
while($row_select_contents_history = mysqli_fetch_array($result_select_contents_history)){
  $count = $cnt;

  $arr[$count]['subject'] = mysqli_real_escape_string($db, $row_select_contents_history['subject']);
  $subject = mysqli_real_escape_string($db, $row_select_contents_history['subject']);
  $arr[$count]['views'] = (int)$row_select_contents_history['views'];

  $sql_select_contents = "SELECT * FROM contents WHERE subject = '$subject'";
  $result_select_contents = mysqli_query($db, $sql_select_contents);
  $row_select_contents = mysqli_fetch_array($result_select_contents);

  $arr[$count]['thumbnail_url'] = $row_select_contents['thumbnail_url'];
  $arr[$count]['contents_url'] = $row_select_contents['contents_url'];

  $cnt ++;
}
print(json_encode($arr));
 ?>
