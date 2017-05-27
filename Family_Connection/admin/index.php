<?php 
	include("dbconnect.php"); ?>
<!--<html>
<body>
<from method="POST" action="#">
	<input type="password" name="admin_pwd" placeholder="Enter Password">
	<input type="Submit" name="ok" value="Submit">

</from>



</body>
</html>

<?php 
	/*if(isset($_POST['ok'])){
		$admin_pwd=$_POST['admin_pwd'];
		if($admin_pwd=='123')
			header('Location:user.php');
		else
			die(" ".mysqli_error($conn));
	}*/

?>-->
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>admin</title>
<!--<link rel="shortcut icon" href="image/favicon.ico" type="image/ico">-->
<link rel="stylesheet" type="text/css" href="css/design.css">
</head>

<body background="image/social.jpg">
<table bgcolor="#C2C2C2" cellpadding="5"height="auto"align="center"style="border: 1px solid olive;border-radius: 10px;margin-top:200px;">
<tr colspan="2"><td>
<u><div class="l1">Social Network Admin</div></u></td></tr>
<tr><td>
<form method="POST" action="#">
<table>
<tr><th>Admin Login</th></tr>
<tr><td><input type="password" name="admin_pwd" placeholder="Enter password"></td></tr>
<tr><td><input type="submit" name="reg" value="Login"></td></tr></table></form></td>
</tr>
<tr><td colspan="2">
<?php

if(isset($_POST['reg'])){
	
		$admin_pwd=$_POST['admin_pwd'];
		if($admin_pwd=='123'){
			header('Location:user.php');
			session_start();
		}
	else{
		
		?><h3>Please enter correct password</h3><?php
	}
			
}

?>
</td></tr>
</table>
</body>
</html>