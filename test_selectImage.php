<?php
$servername = "localhost";
$username = "squart300kg";
$password = "squart300";
$dbname = "squart300kg";

$db = mysqli_connect($servername, $username, $password, $dbname) or die("mysqli_connect_Error");

$sql = "SELECT profile_image FROM trainner WHERE email = '1234'";
$result = mysqli_query($db, $sql);


$row = mysqli_fetch_array($result);
$image = base64_encode($row[0]);

print(json_encode($image));
mysqli_close($db);
