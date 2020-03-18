<?php
$servername = "localhost";
$username = "squart300kg";
$password = "squart300";
$dbname = "squart300kg";

$db = mysqli_connect($servername, $username, $password, $dbname) or die("mysqli_connect fail...");

$type = $_POST['type'];
$my_nickname = $_POST['my_nickname'];
$your_nickname = $_POST['your_nickname'];

$sql_user_email = "SELECT email FROM trainner WHERE nickname = '$your_nickname'";
$result_user_email = mysqli_query($db, $sql_user_email);
$row_user_email = mysqli_fetch_array($result_user_email);
$your_email = $row_user_email['email'];

// echo "$my_nickname";
$sql_user_email = "SELECT email FROM trainner WHERE nickname = '$my_nickname'";
$result_user_email = mysqli_query($db, $sql_user_email);
$row_user_email = mysqli_fetch_array($result_user_email);
$my_email = $row_user_email['email'];

// echo "$your_email";
if($type == "follow"){
  //팔로우를 신청한 경우
  $sql_goToFollow = "INSERT INTO follow VALUES ('$my_email', '$your_email')";
  $result_goToFollow = mysqli_query($db, $sql_goToFollow);
  echo "follow";
} else if ($type == "unfollow"){
  //팔로우를 끊은 경우
  $sql_goToUnFollow = "DELETE FROM follow WHERE my_email = '$my_email' AND your_email = '$your_email'";
  $result_goToUnFollow = mysqli_query($db, $sql_goToUnFollow);
  echo "unfollow";
} else if ($type == "eachfollow"){
  $sql_goToFollow = "INSERT INTO follow VALUES ('$my_email', '$your_email')";
  $result_goToFollow = mysqli_query($db, $sql_goToFollow);
  echo "eachfollow";
} else {
  echo "error";
}
 ?>
