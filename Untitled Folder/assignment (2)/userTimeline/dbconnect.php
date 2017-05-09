<?php
	$server="localhost:3306";
	$user="root";
	$pwd="123";
	$db="timeline";

	$conn=mysqli_connect($server,$user,$pwd,$db);
	if(! $conn){
		die(" ".mysqli_error($conn));
	}
	else
		session_start();
	
	?>