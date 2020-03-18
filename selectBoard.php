<?php
$servername = "localhost";
$username = "squart300kg";
$password = "squart300";
$dbname = "squart300kg";

$db = mysqli_connect($servername, $username, $password, $dbname) or die("mysqli_connect fail...");

$sql_allBoard = "SELECT * FROM board";
$email = $_POST['email'];

$result_allBoard = mysqli_query($db, $sql_allBoard);

$cnt = 0;
$arr =array();
while($row_allBoard = mysqli_fetch_array($result_allBoard)){
  $count = $cnt;
  $arr[$count]['no'] = $row_allBoard['no'];
  $arr[$count]['nickname'] = $row_allBoard['nickname'];
  $nickname = $arr[$count]['nickname'];
  $sql_profileImage = "SELECT profile_image, device_token FROM trainner WHERE nickname = '$nickname'";
  $result_profileImage = mysqli_query($db, $sql_profileImage);
  $row_profileImage = mysqli_fetch_array($result_profileImage);

  $arr[$count]['profile_image'] = base64_encode($row_profileImage['profile_image']);
  $arr[$count]['device_token']= $row_profileImage['device_token'];
  $arr[$count]['contentsText'] = $row_allBoard['contentsText'];
  $arr[$count]['image1'] = base64_encode($row_allBoard['image1']);
  $arr[$count]['image2'] = base64_encode($row_allBoard['image2']);
  $arr[$count]['image3'] = base64_encode($row_allBoard['image3']);
  $arr[$count]['image4'] = base64_encode($row_allBoard['image4']);
  $arr[$count]['image5'] = base64_encode($row_allBoard['image5']);
  $arr[$count]['like'] = $row_allBoard['likes'];

  //이제 로그인중인 사용자가 좋아요를 눌렀는지 검사한다.
  $no = $row_allBoard['no'];
  $sql_isLike = "SELECT count(*) FROM likes WHERE likeboardno = $no AND email = '$email'";
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
  $sql_reply_count = "SELECT count(*) FROM reply WHERE boardno = $no";
  $result_reply_count = mysqli_query($db, $sql_reply_count);
  $row_reply_count = mysqli_fetch_array($result_reply_count);
  $arr[$count]['replycount'] = (int)$row_reply_count[0];
  $cnt++;
}
print(json_encode($arr));

 ?>
