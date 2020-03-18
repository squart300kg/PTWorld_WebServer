<?php
$servername = "localhost";
$username = "squart300kg";
$password = "squart300";
$dbname = "squart300kg";

$db = mysqli_connect($servername, $username, $password, $dbname) or die("mysqli_connect fail...");

$type = $_POST['type'];
$no = (int)$_POST['no'];
$email = $_POST['email'];
$nickname = $_POST['nickname'];

if($type == 'like'){
  $sql_like = "UPDATE board SET likes = likes + 1 WHERE no = $no";
  $sql_insert_like = "INSERT INTO likes VALUES ('$email', '$nickname', $no)";
  $result_insert_like = mysqli_query($db, $sql_insert_like);


}else if($type == 'dislike'){
  $sql_like = "UPDATE board SET likes = likes - 1 WHERE no = $no";
  $sql_delete_like = "DELETE FROM likes WHERE likeboardno = $no AND email = '$email'";
  $result_delete_like = mysqli_query($db, $sql_delete_like);

}else{
  echo "좋아요 하는 과정에서 이상한 값이 들어왔다우...";
}
$result_like = mysqli_query($db, $sql_like);

//또한 변경된 좋아요 갯수를 반환해 준다.
$sql_like_count = "SELECT likes FROM board WHERE no = $no";
$result_like_count = mysqli_query($db, $sql_like_count);
$row_like_count = mysqli_fetch_array($result_like_count);
$likes = $row_like_count['likes'];
// echo "$likes";//좋아요의 갯수를 가져온다.



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
$arr = array();
$arr[0]['likeCount'] = (int)$likes;
$arr[0]['isLike'] = $isLike;
print(json_encode($arr));
// echo "$sql_like_count";
// if($result_like == true){
//   echo "$likes";
// } else {
//   echo "좋아여 변동 에러...";
// }
 ?>
