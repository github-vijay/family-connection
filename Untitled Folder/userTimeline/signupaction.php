<?php
	include("dbconnect.php");
	if(isset($_POST['signup']))
	{
		$uname=$_POST['username'];
		$umob=$_POST['mobile_no'];
		$umail=$_POST['mail'];
		$udob=$_POST['dob'];
		$ugender=$_POST['gender'];
		$pwd=$_POST['pwd'];

		$sql="INSERT INTO `user`(`username`,`user_no`,`user_mail`,`user_dob`,`user_gender`,`upwd`) 
						VALUES ('$uname','$umob','$umail','$udob','$ugender','$pwd')";

		$res=mysqli_query($conn,$sql);
		if($res){
			$_SESSION['umobile']=$umob;
			$_SESSION['uname']=$uname;
			$_SESSION['umail']=$umail;
			$_SESSION['udob']=$udob;
			$_SESSION['ugender']=$ugender;
			$_SESSION['pwd']=$pwd;


			header('Location:timelineblob.php');
		}
		else
			die("".mysqli_error($conn));
	}

?>
