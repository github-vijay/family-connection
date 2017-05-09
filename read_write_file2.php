<?php
	//session_start();
	include 'session.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<script src="scripts/ajaxTimer.js"></script>
	<script type="text/javascript">
		function logout() {
			window.location = "logout.php";
			alert("Logging out");
		}
	</script>
</head>
<body>
<form id="form1" name="form1">
	<div id="send">
		<div name="chat_messages" id="chat_messages" disabled>
			<?php	include('read_json_from_file.php');	?>
		</div>
		<div><input type="text" name="text_to_send" id="text_to_send"></div>
		<div><input type="submit" name="submit" value="submit"></div>
		<button onclick="logout()"></button>
	</div>
</form>
<a href="logout.php"><button type="button" name="logout">Logout</button></a>
<script src="scripts/sendMessage.js"></script>
</body>
</html>