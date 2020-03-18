<?php
$servername = "localhost";
$username = "squart300kg";
$password = "squart300";
$dbname = "squart300kg";

$db = mysqli_connect($servername, $username, $password, $dbname) or die("mysqli_connect fail...");

$replyno = $_POST['replyno'];

$sql_select_rereply = "SELECT * FROM rereply WHERE replyno = $replyno";
$result_select_rereply = mysqli_query($db, $sql_select_rereply);

$cnt = 0;
$arr = array();
while($row_select_rereply = mysqli_fetch_array($result_select_rereply)){
    $count = $cnt;
    $arr[$count]['nickname'] = $row_select_rereply['nickname'];
    $arr[$count]['email'] = $row_select_rereply['email'];
    $arr[$count]['contents'] = $row_select_rereply['contents'];
    $arr[$count]['rereplyno'] = $row_select_rereply['rereplyno'];

    $email = $row_select_rereply['email'];
    // echo $email;
    $sql_profileImage = "SELECT profile_image FROM trainner WHERE email = '$email'";
    // echo $sql_profileImage;
    $result_profileImage = mysqli_query($db, $sql_profileImage);
    $row_profileImage = mysqli_fetch_array($result_profileImage);

    $arr[$count]['profile_image'] = base64_encode($row_profileImage['profile_image']);
    $cnt++;
}
print json_encode($arr);
 ?>
