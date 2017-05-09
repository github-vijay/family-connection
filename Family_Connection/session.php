<?php
	session_start();
	if(empty($_SESSION['u_info'])){
		header('location:Login.php?msg=Login First');
		exit;
	}
?>