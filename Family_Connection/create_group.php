<?php

	include 'connection.php';
	include 'session.php';
	
	$grp_name = $_POST['Group_Name'];
	$friend_id = $_POST['Friend_ID'];
	$profile_pic_path = "Profile/group_default.jpg";
	
	$file_name = "chatfiles/chat_group_".$_SESSION['u_info']['ID']."_".date('Ymdhis').".txt";
			
	$chat_file = fopen($file_name,'w') or die('Cannot open file');
	fclose($chat_file);
	
	$sql = "INSERT into `chat` (FilePath) values ('$file_name')";    // insertion in chat table
	if(mysqli_query($conn,$sql)){
		$lastid = mysqli_insert_id($conn);
		$time=time();
		$sql = "INSERT into `group` (`Name`,`Creation_Date`,`Created_By`,`Profile_Pic`,`Chat_ID`) values ('$grp_name','$time','".$_SESSION['u_info']['ID']."','$profile_pic_path','$lastid')";   // Insertion in group table
		if(mysqli_query($conn,$sql)){
			$last_id = mysqli_insert_id($conn);
			$i=0;
			$sql = "INSERT into `group_members` (`Group_ID`,`User_ID`) values ('$last_id','".$_SESSION['u_info']['ID']."')";
			if(mysqli_query($conn,$sql)){
				//echo ();
				while($i<count($friend_id)){
					
					$sql = "INSERT into `group_members` (`Group_ID`,`User_ID`) values ('$last_id','".$friend_id[$i]."')";  // Insertion in group_members table
					if(mysqli_query($conn,$sql)){
						$i++;
					}
					else{
						die(mysqli_error($conn));
					}
				}
				$sql_admin = "INSERT into `group_admin` (`Group_ID`,`User_ID`) values ('$last_id','".$_SESSION['u_info']['ID']."')";     //Insertion in admin table
				if(mysqli_query($conn,$sql_admin))
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