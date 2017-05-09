<?php
	session_start();
	if(empty($_SESSION['u_info'])){
		header('location:login.php?msg=Login First');
		exit;
	}
?>