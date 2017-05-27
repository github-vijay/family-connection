<?php
	$host = "localhost";
	$username = "root";
	$pwd = "";
	$db = "family_connection";
	$conn = mysqli_connect($host,$username,$pwd,$db);
	
	if(!$conn)
		die("Connection failed: ".mysqli_connect_error());
?>