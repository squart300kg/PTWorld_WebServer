<?php
$servername = "localhost";
$username = "squart300kg";
$password = "squart300";
$dbname = "squart300kg";

$db = mysqli_connect($servername, $username, $password, $dbname) or die("mysqli_connect fail...");

$nickname = $_POST['nickname'];

//한명이 유저 정보를 추출해온다
$sql_select_profile = "SELECT * FROM trainner WHERE nickname = '$nickname'";
$result_select_profile = mysqli_query($db, $sql_select_profile);

$cnt = 0;
$arr = array();
while($row_select_profile = mysqli_fetch_array($result_select_profile)){
  $count = $cnt;

  $arr[$count]['email'] = $row_select_profile['email'];
  $email = $row_select_profile['email'];
  $arr[$count]['nickname'] = $row_select_profile['nickname'];

  //한명의 유저가 가지고 있는 썸네일 이미지들을 모두 가져온다.
  $sql_contents_thumbnail = "SELECT image1 FROM board WHERE nickname = '$nickname'";
  $result_contents_thumbnail = mysqli_query($db, $sql_contents_thumbnail);

  $cnt2 = 0;
  $arr2 = array();
  while($row_contents_thumbnail = mysqli_fetch_array($result_contents_thumbnail)){
    $count2 = $cnt2;
    $arr2[$count2]['thumbnail_image'] = base64_encode($row_contents_thumbnail['image1']);
    $cnt2 ++;
  }
  $arr[$count]['thumbnail_image'] = $arr2;
  $arr[$count]['profile_image'] = base64_encode($row_select_profile['profile_image']);
  $arr[$count]['device_token'] = $row_select_profile['device_token'];

  //유저의 게시물 수를 가져온다.
  $sql_boardCount = "SELECT COUNT(*) FROM board WHERE nickname = '$nickname'";
  $result_boardCount = mysqli_query($db, $sql_boardCount);
  $row_boardCount = mysqli_fetch_array($result_boardCount);
  $arr[$count]['boardCount'] = (int)$row_boardCount[0];

  //유저의 팔로잉 수를 가져온다.
  $sql_followingCount = "SELECT count(my_email) FROM follow WHERE my_email = '$email'";
  $result_followingCount = mysqli_query($db, $sql_followingCount);
  $row_followingCount = mysqli_fetch_array($result_followingCount);
  $arr[$count]['followingCount'] = (int)$row_followingCount[0];

  //유저의 팔로워 수를 가져온다.
  $sql_followingCount = "SELECT count(your_email) FROM follow WHERE your_email = '$email'";
  $result_followingCount = mysqli_query($db, $sql_followingCount);
  $row_followingCount = mysqli_fetch_array($result_followingCount);
  $arr[$count]['followerCount'] = (int)$row_followingCount[0];
  $cnt ++;
}
print(json_encode($arr));
 ?>
