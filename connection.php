<?php
	$host = "localhost";
	$username = "root";
	$pwd = "1234";
	$db = "family_connection";
	$conn = mysqli_connect($host,$username,$pwd,$db);
	
	if(!$conn)
		die("Connection failed: ".mysqli_connect_error());
?>