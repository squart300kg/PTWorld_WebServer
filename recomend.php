
<?php
$servername = "localhost";
$username = "squart300kg";
$password = "squart300";
$dbname = "squart300kg";

$db = mysqli_connect($servername, $username, $password, $dbname) or die("mysqli_connect fail...");

//모든 유저들의 이메일을 가져온다.
$sql = "SELECT DISTINCT email FROM views";
//쿼리를 실행시킨다.
$result = mysqli_query($db, $sql);

//클라이언트단에서 로그인중인 이메일을 받는다.
$user_email = $_POST['email'];
// echo "이메일은(Server)"."$user_email";
$cnt = 0;
$arr = array();
while($row = mysqli_fetch_array($result)){
  $count = $cnt;
  $email = $row['email'];
  //한사람 이메일에 대한 제목 조회수를 가져온다.
  $sql_one_email = "SELECT * FROM views WHERE email = '$email'";
  $result_one_email = mysqli_query($db, $sql_one_email);
  $cnt_one_email = 0;
  $arr_one_email = array();
  while($row_one_email = mysqli_fetch_array($result_one_email)){
    $count_one_email = $cnt_one_email;
    $subject = $row_one_email['subject'];
    $views = $row_one_email['views'];
    // $arr_one_email[$count_one_email]['subject'] = $subject;
    // $arr_one_email[$count_one_email]['views'] = $views;
    $arr_one_email["$subject"] = (int)$views;//한 유저가 본 콘텐츠 제목과 그에 받는 조회수를 저장한다.
    $cnt_one_email++;
  }
  $arr["$email"] = $arr_one_email;//한 유저가 본 모든 콘텐츠과 조회수를 저장한다.
  $cnt++;
}
$last_arr = array();//해당 데이터에 로그인중인 회원의 이메일도 전송하기 위함이다.
$last_arr['email'] = $user_email;
$last_arr['views'] = $arr;
$result = shell_exec('python ./recomend.py ' . escapeshellarg(json_encode($last_arr)));
// $result = shell_exec('python ./recomend.py ' . escapeshellarg(json_encode($arr)));

// echo $result;
$result = explode('\', \'',$result);
$count = count($result);
$arr = array();
for($i = 0 ; $i < $count ; $i ++){
  echo $result[$i] . " AND ";
}



 ?>
