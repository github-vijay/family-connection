<?php
include('connection.php');

$userID = intval($_POST['user']);
$latitude = floatval($_POST['lat']);
$longitude = floatval($_POST['long']);

$sql = "UPDATE `location` SET latitude=$latitude,longitude=$longitude where user_id=$userID";
if(mysqli_query($conn,$sql))
	echo $latitude."  ".$longitude;
else
	print_r($_POST);

?>