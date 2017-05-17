<?php 
	include("dbconnect.php");
	if(isset($_POST['upload_status_image'])){
		$userStatus=$_POST['user_status'];
		$image = addslashes(file_get_contents($_FILES['file_img']['tmp_name']));
		$umob=$_SESSION['umobile'];
		$username=$_SESSION['uname'];
		$userdob=$_SESSION['udob'];
		$usergender=$_SESSION['ugender'];

		

		$sql4statusImage="INSERT INTO `status_image_upload`(`user_name`,`user_mob_number`,`user_dob`,`user_gender`,`upload_time`,`status`,`image`)VALUES ('$username','$umob','$userdob','$usergender',NOW(),'$userStatus','$image')";
		
		$res4statusImage=mysqli_query($conn,$sql4statusImage);
		
		if ($res4statusImage) 
			header('Location:designTest2.php');
		else
			die("".mysqli_error($conn));
	}
?>