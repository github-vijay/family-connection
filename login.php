<?php 
	session_start();
	include 'connection.php';
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<style type="text/css">
	div{
		margin:100px auto;
		width:350px;
	}
</style>
</head>

<body>
<div>
	<form method="post">
    	<label>E-mail ID</label>
    	<input type="text" name="uname"><br>
        <label>Password</label>
        <input type="password" name="pwd"><br>
        <input type="submit" name="Submit" value="Login">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="reset" name="Reset" value="Clear">
    </form>

    <br/>
    <a href="signUp.php"><button type="button">SIGN UP</button></a>
</div>  
    <?php
		if(isset($_POST['Submit'])){
			$uname = $_POST['uname'];
			$pwd = $_POST['pwd'];
			
			$sql = "select * from `user` where `Email` = '$uname' and `Password` = '$pwd'";
			$result = mysqli_query($conn,$sql);
			
			if(mysqli_num_rows($result) > 0){
				$user = mysqli_fetch_array($result);
				$_SESSION['u_info'] = $user;
				//echo $_SESSION['u_info']['Email'];
				$date = date("Y-m-d h:i:s");
				
				$id = $_SESSION['u_info']['ID'];
				
				$sql = "update `user` set `Last_Seen` = '$date' where `ID` = '$id'";
				
				if(mysqli_query($conn,$sql))
					header('location:read_write_file2.php?msg=Logged In Successfully!!');
					
				mysqli_close($conn);
				exit;
			}
			else
				header('location:login.php?err=Username or Password incorrect');
		}
			
	?>
</body>
</html>