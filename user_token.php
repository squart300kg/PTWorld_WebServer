<?php
$servername = "localhost";
$username = "squart300kg";
$password = "squart300";
$dbname = "squart300kg";

$db = mysqli_connect($servername, $username, $password, $dbname) or die("mysqli_connect fail...");

$token = $_POST['token'];
$email = $_POST['email'];

//토큰값이 중복되는지 먼저 확인한다.
$sql_tokenDupCheck = "SELECT count(device_token) FROM trainner WHERE device_token = '$token'";
$result_tokenDupCheck = mysqli_query($db, $sql_tokenDupCheck);
$row_tokenDupCheck = mysqli_fetch_array($result_tokenDupCheck);
if($row_tokenDupCheck[0] == 1){
  //중복된 토큰값이 있다. -> 해당 토큰 값을 지워준다.
  $sql_deleteDupToken = "UPDATE trainner SET device_token = 'null' WHERE device_token = '$token'";
  $result_deleteDupToken = mysqli_query($db, $sql_deleteDupToken);
  if($result_deleteDupToken == true){
    //토큰을 성공적으로 지웠다면! -> 토큰을 다시 넣어준다.
    $sql_updateToken = "UPDATE trainner SET device_token = '$token' WHERE email = '$email'";
    $result_updateToken = mysqli_query($db, $sql_updateToken);
    if($result_updateToken == true){
      //쿼리문이 성공적으로 작동!
      echo "FCM토큰값 갱신 성공!";
    } else {
      echo "FCM토큰값 갱신 실패!";
    }
  }
}else if($row_tokenDupCheck[0] == 0) {
  //중복된 토큰 값이 없다.
  $sql_updateToken = "UPDATE trainner SET device_token = '$token' WHERE email = '$email'";
  $result_updateToken = mysqli_query($db, $sql_updateToken);
  if($result_updateToken == true){
    //쿼리문이 성공적으로 작동!
    echo "FCM토큰값 갱신 성공!";
  } else {
    echo "FCM토큰값 갱신 실패!";
  }
}


 ?>
