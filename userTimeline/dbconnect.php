<?php
	$server="localhost";
	$user="root";
	$pwd="1234";
	$db="userTimeline";

	$conn=mysqli_connect($server,$user,$pwd,$db);
	if(! $conn){
		die(" ".mysqli_error($conn));
	}
	else
		session_start();
	
	?>