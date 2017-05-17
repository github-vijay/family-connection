<?php 
	include("dbconnect.php");
	if(isset($_POST['upload_status_image'])){
		$userStatus=$_POST['user_status'];
		$filetmp = $_FILES["file_img"]["tmp_name"];
		$filename = $_FILES["file_img"]["name"];
		$filetype = $_FILES["file_img"]["type"];
		$filepath = "/home/prabind/Desktop/Documents/uploadedImages/".$filename;

		$umob=$_SESSION['usermobile'];

		$uploadFile=move_uploaded_file($filetmp,$filepath);
		if($uploadFile)
			echo "image uploaded";
		else
			die(" ".mysqli_error($conn));

		$sql4statusImage="INSERT INTO `status_image_upload`(`user_mob_number`,`upload_time`,`status`,`image_name`,`image_path`,`image_type`)VALUES ('$umob',NOW(),'$userStatus','$filename','$filepath','$filetype')";
		
		$res4statusImage=mysqli_query($conn,$sql4statusImage);
		
		if ($res4statusImage) 
			header('Location:timeline.php');
		else
			die("".mysqli_error($conn));
	}
?>