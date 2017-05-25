<?php 
	include 'connection.php';
	include 'session.php';
	
	
	if(isset($_POST['change_cover_img'])){
		$filename = $_FILES['cover_img']['name'];
		$filetype = $_FILES['cover_img']['type'];
		
		if($filetype == 'jpg' || $filetype == 'jpeg' || $filetype == 'JPG' || $filetype == 'JPEG'){
			header('location:setting.php?msg=Only jpg ar jpeg format is supported');
		}
		else{
			$cover_img = "Profile/".rand(00000,99999)."_".microtime(TRUE)."_".$filename;

			$sql="UPDATE `user` SET `Cover_Pic`='$cover_img' WHERE `ID`='".$_SESSION['u_info']['ID']."'";
			$result=mysqli_query($conn,$sql);
			if($result)
				header('Location:setting.php?msg=Cover Image Successfully changed.');
				
			else
				die("".mysqli_error($conn));
			
		}
	}
	
	
	if(isset($_POST['change_profile_img'])){
		
		$filename = $_FILES['profile_img']['name'];
		$filetype = $_FILES['profile_img']['type'];
		
		if($filetype == 'jpg' || $filetype == 'jpeg'){
			header('location:setting.php?msg=Only jpg ar jpeg format is supported');
		}
		else{
			$profile_img = "Profile/".rand(00000,99999)."_".microtime(TRUE)."_".$filename;

			$sql="UPDATE `user` SET `Profile_Pic`='$profile_img' WHERE `ID`='".$_SESSION['u_info']['ID']."'";
			$result=mysqli_query($conn,$sql);
			if($result)
				header('Location:setting.php?msg=Profile Image Successfully changed.');
			else
				die("".mysqli_error($conn));
			
		}
	}
	
	if(isset($_POST['pwd_change'])){
		$old_pwd = $_POST['old_pwd'];
		$new_pwd = $_POST['new_pwd'];
		$confirm_pwd = $_POST['confirm_pwd'];
		
		$sql = "SELECT `Password` from `user` where `ID` = '".$_SESSION['u_info']['ID']."'";
		if($query = mysqli_query($conn,$sql)){
			if(mysqli_num_rows($query) > 0){
				header('setting.php?msg= Old Password do not match.');
			}
			else{
				if($old_pwd != $confirm_pwd){
					header('setting.php?msg= Confirmed password do not match with the new password.');
				}
				else{
					$sql = "UPDATE `user` set `Password` = '$new_pwd' where `ID` = '".$_SESSION['u_info']['ID']."'";
					if(mysqli_query($conn,$sql)){
						header('setting.php?msg=Password Reset.');
					}
					else
						die(mysqli_error($conn));
				}
			}
		}
		else
			die(mysqli_error($conn));
	}
?>