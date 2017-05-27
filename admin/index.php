<?php 
include("dbconnect.php"); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>admin</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/design.css">
<style type="text/css">
body, html {
    height: 100%;
    margin: 0;
    background-color: #00b88a;
background-image: url("https://www.transparenttextures.com/patterns/egg-shell.png");
/* This is mostly intended for prototyping; please download the pattern and re-host for production environments. Thank you! */
}

.bg {
    /*background-image: url("image/social.jpg");*/
    height: 100%; 
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
.jumbotron-mod{
	background-color: rgba(0,0,0,0.2);
	color: #fff;
	box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
}
.jumbotron h1{
	font-weight: bold;
}
#cont{
	position: relative;
	width: 500px;
	padding: 30px;
	padding-top: 60px;
	margin: 50px auto 0;
	border: 1px solid #000;
	background-color: rgba(255,255,255,0.5);
	box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
}
h3{
	color: #000;
}
#admin-login-header{
	/*background-color: red;*/
	font-size: 24px;
	font-weight: bold;
	text-align: center;
	border-radius: 4px;
	margin: 10px 0 0;
}
#admin-image{
	background-image: url('image/admin.png');
	width: 70px;
	height: 70px;
	position: absolute;
	top: 0%;
	left: 50%;
	transform: translate(-50%,-50%);
	background-position: center;
	background-size: contain;
	border-radius: 50%;
	background-color: #fed130;
	box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
}
.input-group-mod{
	margin: 20px 0;
}
.btn-mod{
	margin: 0 auto;
	display: block;
}
@media only screen and (max-width: 768px){
	#cont{
		width: 400px;
	}
}
@media only screen and (max-width: 480px){
	#cont{
		width: 100%;
	}
}
</style>
</head>
<body>
<div class="bg"></div>

<div style="position: absolute;top: 0;left: 0;width: 100%;">
	<div class="jumbotron text-center jumbotron-mod">
	  <h1>Family Connection Admin Page</h1>
	</div>
	<div id="cont">
		<div id="admin-image"></div>
		<div id="admin-login-header">Admin Login</div>
  		<form  method="POST" action="#">
    		<div class="input-group input-group-mod">
      			<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
      			<input id="email" type="text" class="form-control" name="email" placeholder="Email">
    		</div>
    		<div class="input-group input-group-mod">
      			<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
      			<input id="password" type="password" class="form-control" name="admin_pwd" placeholder="Password">
    		</div>
    		<input class="btn btn-primary btn-md btn-mod" type="submit" name="reg" value="Login">
  		</form>
	</div>
</div>



<!-- 
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
 -->
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
<!-- 
</td></tr>
</table>
 -->
</body>
</html>