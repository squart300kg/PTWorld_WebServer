<?php
$servername = "localhost";
$username = "squart300kg";
$password = "squart300";
$dbname = "squart300kg";

$db = mysqli_connect($servername, $username, $password, $dbname) or die("mysqli_connect fail...");

$subject = $_POST['subject'];

$sql_select_content = "SELECT * FROM contents WHERE subject = '$subject'";
$result_select_content = mysqli_query($db, $sql_select_content);

$cnt = 0;
$arr =array();
while($row_select_content = mysqli_fetch_array($result_select_content)){
  $count = $cnt;
  $arr[$count]['subject'] = $row_select_content['subject'];
  $arr[$count]['thumbnail_url'] = $row_select_content['thumbnail_url'];
  $arr[$count]['contents_url'] = $row_select_content['contents_url'];
  $cnt++;
}
print(json_encode($arr));
 ?>
