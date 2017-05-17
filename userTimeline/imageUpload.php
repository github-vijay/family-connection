<?php 
	
	include("dbconnect.php");
	if(isset($_POST['upload_image'])){
		$userImage=addslashes(file_get_contents($_FILES['pic']['tmp_name']));
		$umob=$_SESSION['usermobile'];

		$sql4image="INSERT INTO `image_record`(`user_mob_number`,`upload_time`,`image`)VALUES ('$umob',NOW(),'$userImage')";
	
		$res4image=mysqli_query($conn,$sql4image);

		if ($res4image) 
			echo (" image updated ");
		else
			die("".mysql_error());
	}

?>