<?php

$servername = "localhost";
$username = "squart300kg";
$password = "squart300";
$dbname = "squart300kg";

$db = mysqli_connect($servername, $username, $password, $dbname) or die("mysqli_connect fail...");

$nickname = $_POST['nickname'];
$contentsText = $_POST['contentsText'];
$image1 = $_POST['image1'];
$image2 = $_POST['image2'];
$image3 = $_POST['image3'];
$image4 = $_POST['image4'];
$image5 = $_POST['image5'];

$data1 = base64_decode($image1);
$data2 = base64_decode($image2);
$data3 = base64_decode($image3);
$data4 = base64_decode($image4);
$data5 = base64_decode($image5);

$escaped_values1 = mysqli_real_escape_string($db, $data1);
$escaped_values2 = mysqli_real_escape_string($db, $data2);
$escaped_values3 = mysqli_real_escape_string($db, $data3);
$escaped_values4 = mysqli_real_escape_string($db, $data4);
$escaped_values5 = mysqli_real_escape_string($db, $data5);

$sql_boardInsert = "INSERT INTO board VALUES (0, '$contentsText', '$nickname',0, '$escaped_values1', '$escaped_values2', '$escaped_values3', '$escaped_values4', '$escaped_values5')";
// $sql_boardInsert = "INSERT INTO board VALUES (0, '$contentsText', '$nickname', '$image1')";
// $sql_boardInsert = "INSERT INTO board VALUES (0, '$contentsText', '$nickname')";
echo "$sql_boardInsert";
$result = mysqli_query($db, $sql_boardInsert);

if($result == true){
  echo "board insert success";
  // echo "$nickname" . "$contentsText" . "$image1" . "$image2" . "$image3" . "$image4" . "$image5";
} else {
  echo "board insert fail";
  // echo "$nickname" . "$contentsText" . "$image1" . "$image2" . "$image3" . "$image4" . "$image5";
}

 ?>
