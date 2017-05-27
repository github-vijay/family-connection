<?php
include 'session.php';
include 'connection.php';

	$text_to_send = $_POST['text_to_send'];
	$date = date_create();
	
	$arr = array('user' => '', 'message' => '', 'timestamp' => '');
	$arr['user'] = $_SESSION['u_info']['ID'];
	$arr['message'] = $text_to_send;
	$arr['timestamp'] = date_timestamp_get($date);
	$json_obj = json_encode($arr);
	
	$file = $_SESSION['ChatFile'];
	
	file_put_contents($file, "+,+".$json_obj, FILE_APPEND | LOCK_EX);
	// if(file_put_contents($file, $json_obj, FILE_APPEND | LOCK_EX))
	// 	echo "Success";
	// else
	// 	echo "Failure";	


	//var_dump(json_decode($json, true)); try this sometime
	$obj = json_decode($json_obj, true);
	// print_r($obj);
	// echo "<br>";
	// echo $obj["user"];
	?><span class="right"><?php echo $obj['message'];?></span><?php
?>