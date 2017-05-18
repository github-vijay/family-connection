<?php 
	include("connection.php");
	include 'session.php';
	if(isset($_POST['upload_status_image'])){
		$userStatus=$_POST['user_status'];
		$image = addslashes(file_get_contents($_FILES['file_img']['tmp_name']));
		/*$umob=$_SESSION['umobile'];
		$username=$_SESSION['uname'];
		$userdob=$_SESSION['udob'];
		$usergender=$_SESSION['ugender'];*/

		

		$sql4statusImage="INSERT INTO `status_image_upload` (`User_ID`,`Upload_Time`,`Status`,`Image`)VALUES ('".$_SESSION['u_info']['ID']."',NOW(),'$userStatus','$image')";
		
		$res4statusImage=mysqli_query($conn,$sql4statusImage);
		
		if ($res4statusImage) 
			header('Location:designTest2.php');
		else
			die("".mysqli_error($conn));
	}
?>