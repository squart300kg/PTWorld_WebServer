<?php
$servername = "localhost";
$username = "squart300kg";
$password = "squart300";
$dbname = "squart300kg";

$db = mysqli_connect($servername, $username, $password, $dbname) or die("mysqli_connect fail...");

$boardno = $_POST['boardno'];

$sql_select_content = "SELECT * FROM board WHERE no = $boardno";
$result_select_content = mysqli_query($db, $sql_select_content);

// echo "$boardno";
$cnt = 0;
$arr =array();
while($row_select_content = mysqli_fetch_array($result_select_content)){
  $count = $cnt;
  $arr[$count]['no'] =$boardno;
  $arr[$count]['nickname'] = $row_select_content['nickname'];
  $nickname = $row_select_content['nickname'];
  // echo "$row_select_content['nickname']";
  $sql_profileImage = "SELECT profile_image, device_token, email FROM trainner WHERE nickname = '$nickname'";
  $result_profileImage = mysqli_query($db, $sql_profileImage);
  $row_profileImage = mysqli_fetch_array($result_profileImage);

  $arr[$count]['device_token'] = $row_profileImage['device_token'];
  $arr[$count]['profile_image'] = base64_encode($row_profileImage['profile_image']);
  $arr[$count]['contentsText'] = $row_select_content['contentsText'];
  $arr[$count]['image1'] = base64_encode($row_select_content['image1']);
  $arr[$count]['image2'] = base64_encode($row_select_content['image2']);
  $arr[$count]['image3'] = base64_encode($row_select_content['image3']);
  $arr[$count]['image4'] = base64_encode($row_select_content['image4']);
  $arr[$count]['image5'] = base64_encode($row_select_content['image5']);
  $arr[$count]['like'] = $row_select_content['likes'];

  //이제 로그인중인 사용자가 좋아요를 눌렀는지 검사한다.
  $email = $row_profileImage['email'];
  $sql_isLike = "SELECT count(*) FROM likes WHERE likeboardno = $boardno AND email = '$email'";
  $result_isLike = mysqli_query($db, $sql_isLike);
  $row_isLike = mysqli_fetch_array($result_isLike);
  if($row_isLike[0] == 1){
    $isLike = "yes";
  } else if($row_isLike[0] == 0){
    $isLike = "no";
  } else {
    $isLike = "error";
  }
  $arr[$count]['isLike'] = $isLike;

  //한 게시물의 총 댓글 갯수를 구한다.
  $sql_reply_count = "SELECT count(*) FROM reply WHERE boardno = $boardno";
  $result_reply_count = mysqli_query($db, $sql_reply_count);
  $row_reply_count = mysqli_fetch_array($result_reply_count);
  $arr[$count]['replycount'] = (int)$row_reply_count[0];
  $cnt++;
}
print(json_encode($arr));
 ?>
