<?php
include 'session.php';
include 'connection.php';

$user= $_SESSION['u_info']['ID'];
$friend = $_SESSION['FriendID'];
$ChatFile = $_SESSION['ChatFile'];

$file_contents = file_get_contents($ChatFile);
$file_json_objects = explode("+,+",$file_contents);
$chat_message_info = "";

foreach ($file_json_objects as $key => $value) {
	$str = json_decode($value,true);
	if($str['user'] == $user){
	?>
	<span style="float:right;"><?php echo $str['message'];?></span><br/>
	<?php
	}
	else if($str['user'] == $friend){
		?><span style="float:left;"><?php echo $str['message'];?></span><br>
	<?php
	}
}
?>