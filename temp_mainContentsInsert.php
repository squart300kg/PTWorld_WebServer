<?php
$servername = "localhost";
$username = "squart300kg";
$password = "squart300";
$dbname = "squart300kg";

$db = mysqli_connect($servername, $username, $password, $dbname) or die("mysqli_connect fail...");

$subject = $_POST['subject'];
$thumbnail_url = $_POST['thumbnail_url'];
$contents_url = $_POST['contents_url'];
$type = $_POST['type'];

$subject = mysqli_real_escape_string($db, $subject);
$type = mysqli_real_escape_string($db, $type);
$thumbnail_url = mysqli_real_escape_string($db, $thumbnail_url);
$contents_url = mysqli_real_escape_string($db, $thumbnail_url);

$sql = "INSERT INTO contents VALUES (0, '$subject', '$thumbnail_url', '$contents_url', '$type')";
$result = mysqli_query($db, $sql);

if($result == true){
  echo "dataInsert success";
} else {
  echo "$sql";
}
mysqli_close($db);
 ?>
