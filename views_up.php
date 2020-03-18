<?php
$servername = "localhost";
$username = "squart300kg";
$password = "squart300";
$dbname = "squart300kg";

$db = mysqli_connect($servername, $username, $password, $dbname) or die("mysqli_connect fail...");

$email = $_POST['email'];
$subject = $_POST['subject'];

$email = mysqli_real_escape_string($db, $email);
$subject = mysqli_real_escape_string($db, $subject);

//우선 첫번째로 해당 사용자가 해당 게시물을 본적이 있는지 조회한다.

$sql_isView = "SELECT COUNT(*) FROM views WHERE email = '$email' AND subject = '$subject'";
$result_sql_isView = mysqli_query($db, $sql_isView);
$row_sql_isView = mysqli_fetch_array($result_sql_isView);
if($row_sql_isView[0] == 0){
  //해당 사용자가 만약 해당 게시물을 조회한적이 없다면
  //조회수를 1로하는 행을 INSERT시켜준다.
  $sql_viewInsert = "INSERT INTO views VALUES ('$email', '$subject', 1)";
  $result_sqlViewInsert = mysqli_query($db, $sql_viewInsert);
  echo "view Insert Success";
}else{
  //조회한적이 있다면
  $sql_viewUpdate = "UPDATE views SET views = views + 1 WHERE email = '$email' AND subject = '$subject'";
  $result_sql_viewUpdate = mysqli_query($db, $sql_viewUpdate);
  //원래 콘텐츠에 값을 1 증가시켜준다.
  echo "view Update Success";
}


 ?>
