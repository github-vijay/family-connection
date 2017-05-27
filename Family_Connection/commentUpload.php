<?php 
include 'connection.php';
include 'session.php';


	if(isset($_POST['submit_comment'])){
		$uploadId=$_POST['uploadid'];
		$userid=$_SESSION['u_info']['ID'];
		$comment=$_POST['comment'];
		$sql="INSERT INTO `comment_record`(`Upload_ID`,`User_ID`,`Comment`) VALUES ('$uploadId','$userid','$comment')";

		$res=mysqli_query($conn,$sql);

		if($res)
			header('Location:designTest2.php');
		else
			die(" ".mysqli_error($conn));

	}