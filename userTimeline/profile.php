<?php include("dbconnect.php");?>
<html><BODY>
<a href="timelineblob.php">Home</a>
<form method="POST" action="#">
<INPUT TYPE="TEXT" name="old_pwd" placeholder="Enter your old password" required>
	<input type="text" name="new_pwd" placeholder="Enter your new password" required>
	<input type="submit" name="change_pwd" value="update">
</form>
</BODY> 
<?php 
	if(isset($_POST['change_pwd'])){
		$oldpwd=$_POST['old_pwd'];
		$newpwd=$_POST['new_pwd'];
			$sql4newPassword="UPDATE `user` SET `upwd`='$newpwd' WHERE `user_no`='".$_SESSION['umobile']."'";
			$res=mysqli_query($conn,$sql4newPassword);
			if($res)
				header('Location:timelineblob.php');
			else
				die(" ".mysqli_error($conn));
		
	}
	else
		die(" ".mysqli_error($conn));
?>
</html>
