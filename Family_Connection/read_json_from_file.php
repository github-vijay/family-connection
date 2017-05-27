<?php

include('connection.php');

$file_contents = file_get_contents('people.txt');
$file_json_objects = explode("+,+",$file_contents);

$user = $_SESSION['u_info']['ID'];

foreach ($file_json_objects as $key => $value) {
	$str = json_decode($value,true);
	if($str['user'] == $user)?>
		<?php echo $str['message']."<br/>";?><?php
}

?>