<?php
$servername = "localhost";
$username = "squart300kg";
$password = "squart300";
$dbname = "squart300kg";

$db = mysqli_connect($servername, $username, $password, $dbname) or die("mysqli_connect fail...");

$email = $_POST['email'];
$password = $_POST['password'];
$passwordConfirm = $_POST['passwordConfirm'];
$nickname = $_POST['nickname'];
$place = $_POST['place'];
$prize = $_POST['prize'];
$profile_image = $_POST['profile_image'];

//일단 중복된 이메일이 있는지 확인한다.
$sql_emailDupCheck = "SELECT email FROM trainner WHERE email = '$email'";
$result_emailDupCheck = mysqli_query($db, $sql_emailDupCheck);
$row = mysqli_fetch_array($result_emailDupCheck);

$checker = $row[0];
if(isset($checker)){
  echo "duplicate email";
  exit;
}

//이메일 중복여부를 확인했으면 비밀번호와 비밀번호 확인이 일치하는지 확인한다.
if($password != $passwordConfirm){
  echo "wrong password";
  exit;
}


$data = base64_decode($profile_image);
$escaped_values = mysqli_real_escape_string($db, $data);

$sql = "INSERT INTO trainner VALUES ('$email', '$password', '$nickname', '$place', '$prize', '$escaped_values')";

echo "$sql";

$result = mysqli_query($db, $sql);
if($result == true){
echo "trainner insert success";
} else {
echo "trainne insert fail...";
}
mysqli_close($db);
?>
