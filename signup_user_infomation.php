<?php
 $connect = mysql_connect("localhost", "squart300kg", "squart300");

 if(!$connect){
    die('Could not connect : '.mysql_error());
 }

 mysql_select_db("squart300kg", $connect);

 mysql_query("set names utf8");
 $hi = $_POST['hi'];
 $sql = "INSERT INTO test (hi) VALUES ('$hi')";

if(!mysql_query($sql, $connect){
     die('Error : '.mysql_error());
}
echo "fail..";
mysql_close($connect);
?>
