<?php
$servername = "localhost";
$username = "squart300kg";
$password = "squart300";
$dbname = "squart300kg";

$db = mysqli_connect($servername, $username, $password, $dbname) or die("mysqli_connect fail...");

$email = $_POST['email'];

$sql = "SELECT * FROM trainner WHERE email = '$email'";
$result = mysqli_query($db, $sql);

$arr = array();
while($row = mysqli_fetch_array($result)){
  $arr[0]['email'] = $row['email'];
  $arr[0]['pwd'] = $row['pwd'];
  $arr[0]['nickname'] = $row['nickname'];
  $arr[0]['place'] = $row['place'];
  $arr[0]['prize'] = $row['prize'];
  $arr[0]['image'] = base64_encode($row['profile_image']);
}
print(json_encode($arr));
?>
