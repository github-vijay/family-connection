<?php
$file_contents = file_get_contents('people.txt');
$file_json_objects = explode("+,+",$file_contents);
$chat_message_info = "";
$str = "";
foreach ($file_json_objects as $key => $value) {
	$chat_message_info = json_decode($value,true);
	if($str == "")
		$str = $chat_message_info["message"];
	else
		$str = $str."<br>".$chat_message_info["message"];
}
echo $str;
?>