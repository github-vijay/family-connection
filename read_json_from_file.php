<?php
$file_contents = file_get_contents('people.txt');
$file_json_objects = explode("+,+",$file_contents);

foreach ($file_json_objects as $key => $value) {
	$str = json_decode($value,true);
	if($str['user'] == 'sender')
		echo $str['message']."<br/>";
}
?>