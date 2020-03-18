<?php
$servername = "localhost";
$username = "squart300kg";
$password = "squart300";
$dbname = "squart300kg";

$db = mysqli_connect($servername, $username, $password, $dbname) or die("mysqli_connect fail...");

$email = $_POST['email'];
$password = $_POST['password'];

//아이디가 존재하는지 확인한다.
//아이디가 존재한다면
//비밀번호가 맞는지 검사한다.
//틀리다면? 에러메시지.

$sql_1 = "SELECT COUNT(*) FROM trainner WHERE email = '$email' AND pwd = '$password'";
$result_1 = mysqli_query($db, $sql_1);
$row_1 = mysqli_fetch_array($result_1);

$checker = $row_1[0];

if($checker == 0){
  echo "login fail";
}else{
  echo "login success";
}

mysqli_close($db);
?>
