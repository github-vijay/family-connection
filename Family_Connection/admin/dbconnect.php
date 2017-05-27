<?php
	$server="localhost";
	$user="root";
	$pwd="";
	$db="family_connection";

	$conn=mysqli_connect($server,$user,$pwd,$db);
	if(! $conn){
		die(" ".mysqli_error($conn));
	}
	else
		session_start();
	
	?>