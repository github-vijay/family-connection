<?php
	include("dbconnect.php");
	if(isset($_POST['login'])){
		$vmob=$_POST['verify_mailormob'];
		$vpwd=$_POST['pwd'];

		$sql="SELECT * FROM `user` WHERE `user_no`='$vmob' AND `upwd`='$vpwd'";

		$res=mysqli_query($conn,$sql);
		if ($res->num_rows > 0) {
    // output data of each row
    	while($row = $res->fetch_assoc()) {
			$_SESSION['umobile']=$vmob;
			$_SESSION['uname']=$row['username'];
			$_SESSION['umail']=$row['user_mail'];
			$_SESSION['udob']=$row['user_dob'];
			$_SESSION['ugender']=$row['user_gender'];
			$_SESSION['pwd']=$row['upwd'];
			}
			header('Location:timelineblob.php');
		}
		else
			echo "Please enter correct mobile number and password...If you are new user then Please Sign up yourself";
	}

?>
