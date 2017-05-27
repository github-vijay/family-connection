<?php

	include 'connection.php';
	include 'session.php';

	$sql = "DELETE from `location_access_to_user` where `User_ID` = '".$_SESSION['u_info']['ID']."'";
	if(mysqli_query($conn,$sql)){
		echo "Affected rows: ".mysqli_affected_rows($conn);
	}
	else
		die(mysqli_error($conn));
?>