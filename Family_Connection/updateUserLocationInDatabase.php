<?php
include('connection.php');
include 'session.php';


$latitude = floatval($_POST['lat']);
$longitude = floatval($_POST['long']);

$sql = "UPDATE `user` SET latitude=$latitude,longitude=$longitude where `ID`='".$_SESSION['u_info']['ID']."'";
if(mysqli_query($conn,$sql))
	echo $latitude."  ".$longitude;
else
	print_r($_POST);

?>