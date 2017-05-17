<?php
include('dbconnect.php');

$sql  = "SELECT `last_seen` from `user` WHERE user_no=".$_SESSION['umobile'];
$rs = $conn->query($sql);
$row = $rs->fetch_assoc();
$current_time = $_GET['current_time'];
// $last_seen = $row['last_seen'];
$last_seen = 1494709078;

$sql = "SELECT * FROM `chat_record` WHERE `message_time` >= $last_seen AND `group_id`=1"; //considering there is only 1 group
$rs = $conn->query($sql);
$unseen_messages_count = $rs->num_rows;
echo $unseen_messages_count;

// INSERT INTO chat_record VALUES(1,9883480380,"What?",1494709093);