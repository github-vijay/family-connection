<?php
include 'session.php';
include 'connection.php';

$user= $_SESSION['u_info']['ID'];

$ChatFile = $_SESSION['ChatFile'];

if ( 0 == filesize($ChatFile)){
	echo 'No conversations yet.';
}
else{
	if($_SESSION['type'] == 'friend'){	
		$friend = $_SESSION['F_ID']['FriendID'];
		$file_contents = file_get_contents($ChatFile);
		$file_json_objects = explode("+,+",$file_contents);
		$chat_message_info = "";

		foreach ($file_json_objects as $key => $value) {
			$str = json_decode($value,true);
			if($str['user'] == $user){
			?>
			<span class="right"><?php echo $str['message'];?></span><br/>
			<?php
			}
			else if($str['user'] == $friend){
				?><span class="left"><?php echo $str['message'];?></span><br>
			<?php
			}
		}
	}
	else if($_SESSION['type'] == 'group'){
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
			else{
				
				if($str['user'] != null){
				?><span style="float:left;"><?php echo $_SESSION['F_ID'][$str['user']].": ".$str['message'];?></span><br>  <!-- Sending name of the user along with the messages-->
			<?php
				}
			}	
		}
	}
}
?>