<?php

include 'connection.php';
include 'session.php';

$friends = $groups = array();

$friends = $_POST['friends'];
$groups = $_POST['groups'];

$i = 0;

while($i < count($friends)){
	$sql = "INSERT into `location_access_to_user` values ('','".$_SESSION['u_info']['ID']."','".$friends[$i]."')";
	if(mysqli_query($conn,$sql)){
		$i++;
	}
	else{
		die(mysqli_error());
	}

}

?>
	

