<?php
$servername = "localhost";
$username = "squart300kg";
$password = "squart300";
$dbname = "squart300kg";

$db = mysqli_connect($servername, $username, $password, $dbname) or die("mysqli_connect fail...");

$type = $_POST['type'];
$email = $_POST['email'];

if($type == "following"){
  //팔로잉하는 회원들을 가져온다.
  $sql_select_following = "SELECT your_email FROM follow WHERE my_email = '$email'";
  $result_select_following = mysqli_query($db, $sql_select_following);
  $cnt = 0;
  $arr = array();
  while($row_select_following = mysqli_fetch_array($result_select_following)){
    $count = $cnt;
    $following_email = $row_select_following[0];
    $sql_select_profile = "SELECT * from trainner WHERE email = '$following_email'";
    $result_select_profile = mysqli_query($db, $sql_select_profile);
    $row_select_profile = mysqli_fetch_array($result_select_profile);

    $arr[$count]['profile_image'] = base64_encode($row_select_profile['profile_image']);
    $arr[$count]['nickname'] = $row_select_profile['nickname'];
    $arr[$count]['email'] = $row_select_profile['email'];
    // echo $row_select_profile['nickname'] . $row_select_profile['email']
    $cnt++;
  }
print(json_encode($arr));
} else if ($type == "follower"){
  //팔로워하는 회원들을 가져온다.
  $sql_select_following = "SELECT my_email FROM follow WHERE your_email = '$email'";
  $result_select_following = mysqli_query($db, $sql_select_following);
  $cnt = 0;
  $arr = array();
  while($row_select_following = mysqli_fetch_array($result_select_following)){
    $count = $cnt;
    $following_email = $row_select_following[0];
    $sql_select_profile = "SELECT * from trainner WHERE email = '$following_email'";
    $result_select_profile = mysqli_query($db, $sql_select_profile);
    $row_select_profile = mysqli_fetch_array($result_select_profile);

    $arr[$count]['profile_image'] = base64_encode($row_select_profile['profile_image']);
    $arr[$count]['nickname'] = $row_select_profile['nickname'];
    $arr[$count]['email'] = $row_select_profile['email'];
    // echo $row_select_profile['nickname'] . $row_select_profile['email']
    $cnt++;
  }
print(json_encode($arr));
} else {
  echo "error";
}
 ?>
