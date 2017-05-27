<?php
	include 'connection.php';
	include 'session.php';

	$user_id = $_POST['ID'];
	$sql = "SELECT latitude,longitude FROM `user` where `ID`='$user_id'";
	$rs = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($rs);
	$latitude = $row['latitude'];
	$longitude = $row['longitude'];
	echo $latitude.",".$longitude;
?>