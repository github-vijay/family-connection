<?php 
	include 'connection.php';
	include 'session.php';
	if(isset($_POST['upload_status_image'])){
		$userStatus=$_POST['user_status'];
		//$image = $_FILES['file_img']['tmp_name']));
		$file_name = $_FILES['file_img']['name'];
		$file_type = $_FILES['file_img']['type'];
		$file_size = $_FILES['file_img']['size'];
		
		if($file_name == "")
			$profile_pic_path = "";
		else
			$profile_pic_path = "Status_Image/".rand(00000,99999)."_".microtime(TRUE)."_".$file_name;

		$time=time();
		if(move_uploaded_file($_FILES['file_img']['tmp_name'],$profile_pic_path)){
			$sql4statusImage="INSERT INTO `status_image_upload` (`User_ID`,`Upload_Time`,`Status`,`Image`) VALUES ('".$_SESSION['u_info']['ID']."',$time,'$userStatus','$profile_pic_path')";
			$res4statusImage=mysqli_query($conn,$sql4statusImage);
		
			if ($res4statusImage) 
				header('Location:designTest2.php');
			else
				die("".mysqli_error($conn));
		}
		else{
				die("".mysqli_error($conn));
				mysqli_close($conn);
		}		
	}
?>