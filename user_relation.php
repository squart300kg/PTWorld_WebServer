<?php
$servername = "localhost";
$username = "squart300kg";
$password = "squart300";
$dbname = "squart300kg";

$db = mysqli_connect($servername, $username, $password, $dbname) or die("mysqli_connect fail...");

$your_nickname = $_POST['your_nickname'];
$my_nickname = $_POST['my_nickname'];

$sql_user_email = "SELECT email FROM trainner WHERE nickname = '$your_nickname'";
$result_user_email = mysqli_query($db, $sql_user_email);
$row_user_email = mysqli_fetch_array($result_user_email);
$your_email = $row_user_email['email'];

$sql_user_email = "SELECT email FROM trainner WHERE nickname = '$my_nickname'";
$result_user_email = mysqli_query($db, $sql_user_email);
$row_user_email = mysqli_fetch_array($result_user_email);
$my_email = $row_user_email['email'];

// echo $your_email . $my_email;
if($my_email == $your_email){
  echo "me";
  exit();
}
$sql_relation_follow = "SELECT COUNT(*) FROM follow WHERE my_email = '$my_email' AND your_email = '$your_email'";
$result_relation_follow = mysqli_query($db, $sql_relation_follow);
$row_relation_follow = mysqli_fetch_array($result_relation_follow);

$sql_relation_follower = "SELECT COUNT(*) FROM follow WHERE my_email = '$your_email' AND your_email = '$my_email'";
$result_relation_follower = mysqli_query($db, $sql_relation_follower);
$row_relation_follower = mysqli_fetch_array($result_relation_follower);

if($row_relation_follow[0] == 1 && $row_relation_follower[0] == 1){
  //서로 팔로우 한다.
  echo "each other";
} else if ($row_relation_follow[0] == 1 && $row_relation_follower[0] == 0){
  //나만 상대를 팔로우 한다.
  echo "follow";
} else if ($row_relation_follow[0] == 0 && $row_relation_follower[0] == 1){
  //상대만 나를 팔로우 한다.
  echo "follower";
} else if ($row_relation_follow[0] == 0 && $row_relation_follower[0] == 0){
  //서로 팔로울 안한다.
  echo "no";
} else {
  //에러.
  echo "error...";
}

 ?>
