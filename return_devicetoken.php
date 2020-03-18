<?php
$servername = "localhost";
$username = "squart300kg";
$password = "squart300";
$dbname = "squart300kg";

$db = mysqli_connect($servername, $username, $password, $dbname) or die("mysqli_connect fail...");

$nickname = $_POST['nickname'];

$sql = "SELECT device_token FROM trainner WHERE nickname = '$nickname'";
$result = mysqli_query($db, $sql);

$device_token;
while($row = mysqli_fetch_array($result)){
  $device_token = $row['device_token'];
}
echo $device_token;
 ?>
