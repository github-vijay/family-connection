<?php

	include 'connection.php';
	include 'session.php';
	
	$grp_name = $_POST['grp_name'];
	
	$file_name = $_FILES['grp_image']['name'];
	$file_type = $_FILES['grp_image']['type'];
	$file_size = $_FILES['grp_image']['size'];
		
	if($file_name == "")
		$profile_pic_path = "Profile/group_default.png";
	else
		$profile_pic_path = "Profile/".rand(00000,99999)."_".microtime(TRUE)."_".$file_name;
	
	$file_name = "chat_group_".$_SESSION['u_info']['ID']."_".date('Ymdhis').".txt";
			
	$chat_file = fopen($file_name,'w') or die('Cannot open file');
	fclose($chat_file);
	
	$sql = "INSERT into `chat` (FilePath) values ('$file_name')";    // insertion in chat table
	if(mysqli_query($conn,$sql)){
		$lastid = mysql_insert_id($conn);
		$sql = "INSERT into `group` values ('$grp_name',NOW(),'".$_SESSION['u_info']['ID']."','$profile_pic_path','$lastid')";   // Insertion in group table
		if(mysqli_query($conn,$sql)){
			$last_id = mysqli_insert_id($conn);
			$i=0;
			$sql = "INSERT into `group_members` values ('$last_id','".$_SESSION['u_info']['ID']."')";
			if(mysqli_query($conn,$sql)){
				while($i<=count($_POST['friends'])){
					
					$sql = "INSERT into `group_members` values ('$last_id','".$_POST['friends'][$i]."')";  // Insertion in group_members table
					if(mysqli_query($conn,$sql)){
						$i++;
					}
					else{
						die(mysqli_error($conn));
					}
				}
				$sql = "INSERT into `group_admin` values ('$last_id','".$_SESSION['u_info']['ID']."')";     //Insertion in admin table
				if(mysqli_query($conn,$sql))
					echo 'Group Created Successfully';
				else
					die(mysqli_error($conn));
			}
			else
				die(mysqli_error($conn));
		}
		else
			die(mysqli_error($conn));
	}
	else
		die(mysqli_error($conn));
?>