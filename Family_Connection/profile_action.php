<?php
	include 'connection.php';
	include 'session.php';

	if(isset($_POST['change_profile_img']){
		$grp_id = $_POST['grp_id'];


		$file_name = $_FILES['profile']['name'];
		$file_type = $_FILES['profile']['type'];
		$file_size = $_FILES['profile']['size'];

		if($file_name == "")
			$profile_pic_path = "Profile/group_default.jpg";
		else
			$profile_pic_path = "Profile/".rand(00000,99999)."_".microtime(TRUE)."_".$file_name;
		//echo $profile_pic_path;
		$fn = str_split($fname);
		
		
		if(move_uploaded_file($_FILES['profile']['tmp_name'],$profile_pic_path)){
			$sql = "update `group` set `Profile_Pic` = '$profile_pic_path' where `ID` = '$grp_id'";
		
			if(mysqli_query($conn,$sql)){
				header('location:profile_info.php?msg=Successfully changed group image!!');
			else
				header('location:profile_info.php?err=Some error has occurred');	
		}
		else{
			mysqli_error($conn);
			mysqli_close($conn);
		}
		
	}
	
	$action = $_POST['Action'];
	if($action == 'leave_group'){
		$id = $_POST['ID'];
		
		$type = $_POST['Type'];
		if($type == 'admin' || $type == 'head-admin'){
			$sql = "DELETE from `group_admin` where `User_ID` = '".$_SESSION['u_info']['ID']."' and `Group_ID` = '$id'";
			$query_admin = mysqli_query($conn,$sql))
			echo mysqli_rows_affected($conn);
			$sql = "DELETE from `group_members` where `Group_ID` = '$id' and `User_ID` = '".$_SESSION['u_info']['ID']."'";
			$query_user = mysqli_query($conn,$sql);
			echo mysqli_rows_affected($conn);
		}
		else{
			$sql = "DELETE from `group_members` where `Group_ID` = '$id' and `User_ID` = '".$_SESSION['u_info']['ID']."'";
			$query_user = mysqli_query($conn,$sql);
			echo mysqli_rows_affected($conn);
		}
	}
	elseif ($action == 'make-admin') {
		$sql = "INSERT into `group_admin` (User_ID,Group_ID) values ('$id',)";
		if($exec_query($conn,$sql)){
			echo 'Made Admin';
		}
		else
			die("",mysqli_error($conn));

	}
	elseif ($action == 'kick') {
		$user = $_POST['ID'];
		$sql_check_for_admin = "SELECT * from `group_members` where `Group_ID` = '".$_SESSION['grp_frnd_id']."' and `User_ID` = '$user'";
		$res = mysqli_query($conn,$sql);
		if(mysqli_num_rows($res)>0){
			$sql_delete_from_admin = "DELETE from `group_admin` where `User_ID` = '$user' and `Group_ID` = '".$_SESSION['grp_frnd_id']."'";
			if(mysqli_query($conn,$sql_delete_from_adminl)){
				$num_delete_from_admin = mysqli_rows_affected($conn);
				$sql = "DELETE from `group_members` where `User_ID` = '$user' and `Group_ID` = '".$_SESSION['grp_frnd_id']."'";
				if(mysqli_query($con,$sql_delete_from_members)){
					echo 'Rows affected: Group Admin: '.$num_delete_from_admin.' Group Members: '.mysqli_rows_affected($conn);
				}
				else
					die("",mysqli_error($conn));
			}
			else
				die("",mysqli_error($conn));
		}
		else
			echo 'Not the member';
	}
?>