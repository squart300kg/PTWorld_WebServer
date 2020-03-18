<?php
$servername = "localhost";
$username = "squart300kg";
$password = "squart300";
$dbname = "squart300kg";

$db = mysqli_connect($servername, $username, $password, $dbname) or die("mysqli_connect fail...");

$type = $_POST['type'];

$type = mysqli_real_escape_string($db, $type);

$sql = "SELECT * FROM contents WHERE type = '$type'";

$result = mysqli_query($db, $sql);
$cnt = 0;
$arr =array();
while($row = mysqli_fetch_array($result)){
  $count = $cnt;
  $arr[$count]['subject'] = $row['subject'];
  $arr[$count]['thumbnail_url'] = $row['thumbnail_url'];
  $arr[$count]['contents_url'] = $row['contents_url'];
  $cnt++;
}

print(json_encode($arr));
 ?>
