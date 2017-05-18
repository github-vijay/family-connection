<?php 
include 'connection.php';
include 'session.php';


	if(isset($_POST['submit_comment'])){
		$uploadId=$_POST['uploadid'];
		$userMobNum=$_SESSION['umobile'];
		$username=$_SESSION['uname'];
		$comment=$_POST['comment'];
		$sql="INSERT INTO `comment_record`(`uploadid_for_comment`,`user_mob_number`,`user_name`,`comment`) VALUES ('$uploadId','$userMobNum','$username','$comment')";

		$res=mysqli_query($conn,$sql);

		if($res)
			header('Location:designTest2.php');
		else
			die(" ".mysqli_error($conn));

	}