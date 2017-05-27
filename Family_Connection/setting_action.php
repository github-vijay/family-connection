<?php
	include 'connection.php';
	include 'session.php';

	
	if(isset($_POST['change_profile_img'])){
		$file_name = $_FILES['profile_img']['name'];
		$file_type = $_FILES['profile_img']['type'];
		$file_size = $_FILES['profile_img']['size'];

		if($file_name == "")
			$profile_pic_path = "Profile/user_default.png";
		else
			$profile_pic_path = "Profile/".rand(00000,99999)."_".microtime(TRUE)."_".$file_name;
		//echo $profile_pic_path;
		$fn = str_split($fname);
		
		
		if(move_uploaded_file($_FILES['profile_img']['tmp_name'],$profile_pic_path)){
			$sql = "update `user` set `Profile_Pic` = '$profile_pic_path' where `ID` = '".$_SESSION['u_info']['ID']."'";
		
			if(mysqli_query($conn,$sql)){
				header('location:setting.php?msg=Successfully changed profile image!!');
			else
				header('location:setting.php?err=Some error has occurred');	
		}
		else{
			mysqli_error($conn);
			mysqli_close($conn);
		}
	}
	elseif(isset($_POST['change_cover_img'])){
		$file_name = $_FILES['cover_img']['name'];
		$file_type = $_FILES['cover_img']['type'];
		$file_size = $_FILES['cover_img']['size'];

		if($file_name == "")
			$profile_pic_path = "Profile/user_default.png";
		else
			$profile_pic_path = "Profile/".rand(00000,99999)."_".microtime(TRUE)."_".$file_name;
		//echo $profile_pic_path;
		$fn = str_split($fname);
		
		
		if(move_uploaded_file($_FILES['cover_img']['tmp_name'],$profile_pic_path)){
			$sql = "update `user` set `Cover_Pic` = '$profile_pic_path' where `ID` = '".$_SESSION['u_info']['ID']."'";
		
			if(mysqli_query($conn,$sql)){
				header('location:setting.php?msg=Successfully changed cover image!!');
			else
				header('location:setting.php?err=Some error has occurred');	
		}
		else{
			mysqli_error($conn);
			mysqli_close($conn);
		}
	}
	elseif (isset($_POST['pwd_change'])) {
		$oldpwd = $_POST['old_pwd'];
		$newpwd = $_POST['new_pwd'];
		$confirmpwd = $_POST['confirm_pwd'];

		$sql = "SELECT `Password` from `user` where `ID` = '".$_SESSION['u_info']['ID']."'";
		$query = mysqli_query($conn,$sql);
		if(mysqli_num_rows($query) > 0){
			$res = mysqli_fetch_array($query);
			if($res['Password'] == $oldpwd){
				if($newpwd == $confirmpwd){
					$sql_change_pwd = "UPDATE `user` set `Password` = '$newpwd' where `ID` = '".$_SESSION['u_info']['ID']."'";
					if(mysqli_query($conn,$sql_change_pwd)){
						header('location:setting.php?msg=Successfully changed your password!!!');
					}
				}
				else{
					header('location:setting.php?err=Passwords do not match.');
					mysqli_close($conn);
				}
			}
			else{
				header('location:setting.php?err=Old Password do not match.');
				mysqli_close($conn);
			}
		}
	}

?>