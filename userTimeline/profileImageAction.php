<?php include("dbconnect.php");
	if(isset($_POST['change_profile_img'])){
		$profile_img=addslashes(file_get_contents($_FILES['profile_img']['tmp_name']));
		$user_mobile=$_SESSION['umobile'];
		$username=$_SESSION['uname'];
		$userdob=$_SESSION['udob'];
		$usergender=$_SESSION['ugender'];

		$sql="UPDATE `user` SET `user_image`='$profile_img' WHERE `user_no`='$user_mobile'";
		$result=mysqli_query($conn,$sql);
		if($result){
			$sql4profileImage="INSERT INTO `status_image_upload`(`user_name`,`user_mob_number`,`user_dob`,`user_gender`,`upload_time`,`status`,`image`) VALUES ('$username','$user_mobile','$userdob','$usergender',NOW(),'$username' ' updated his profile picture' ,'$profile_img')";
		
			$res4profileImage=mysqli_query($conn,$sql4profileImage);
		
			if ($res4profileImage) 
				header('Location:timeline2.php');
			else
				die("".mysqli_error($conn));

		}
		else{
			die(" ".mysqli_error($conn));
		}
	}