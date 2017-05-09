<?php
include('connection.php');


$user_id = $_POST['user_id'];
$sql = "SELECT latitude,longitude FROM `location` where user_id=$user_id";
$rs = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($rs);
$latitude = $row['latitude'];
$longitude = $row['longitude'];
echo $latitude.",".$longitude;
?>