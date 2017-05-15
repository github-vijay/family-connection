<?php
include("dbconnect.php");
$onlineStatus = $_GET['onlineStatus'];
$userNo = $_SESSION['umobile'];
$sql = "UPDATE `user` SET `user_online_status`=".$onlineStatus." WHERE `user_no`=".$userNo."";
$conn->query($sql)
?>

