<?php
	include 'session.php';
	include 'connection.php';
	
	
	if(isset($_POST['requestID']) && isset($_POST['friendID']) && isset($_POST['type'])){
	
		$friendID = $_POST['friendID'];
		$type = $_POST['type'];
		$requestID = $_POST['requestID'];
		//echo $friendID.$type.$requestID;
		if($type == 1){
			
			$userID = $_SESSION['u_info']['ID'];
			
			$file_name = "chat_".$userID."_".$friendID."_".date('Ymdhis').".txt";
			
			//$file_path = "/chatfiles/".$file_name;
			//echo $file_path;	
			$chat_file = fopen($file_name,'w') or die('Cannot open file');
			fclose($chat_file);
			
			$sql = "INSERT into `chat` (FilePath) values ('$file_name')";
			
			if(mysqli_query($conn,$sql)){
				$last_id = mysqli_insert_id($conn);
				$sql = "INSERT into `friends` (User_ID,Friend_ID,Chat_ID) values ('$userID','$friendID','$last_id');";
				if(mysqli_query($conn,$sql)){
					$sql = "INSERT into `friends` (User_ID,Friend_ID,Chat_ID) values ('$friendID','$userID','$last_id');";
					if(mysqli_query($conn,$sql)){
						$sql = "UPDATE `friend_request` set status = '$type' where ID = '$requestID'";
						if(mysqli_query($conn,$sql)){
							echo 'Accepted';
						}
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
			
		}
		else if($type == 2){
			
			$sql = "UPDATE `friend_request` set status = '$type' where ID = '$requestID'";
			
			if(mysqli_query($conn,$sql)){
				echo 'Rejected';
			}
			else
				die(mysqli_error($conn));
			
		}
		else if($type == 3){
			$sql = "UPDATE `friend_request` set status = '$type' where ID = '$requestID'";
			
			if(mysqli_query($conn,$sql)){
				$date = date('Y-m-d h:i:s');
				$sql = "INSERT into `blocked_user` (From_User,To_User,Time) values ('$userID','$friendID','$date')";
				if(mysqli_query($conn,$sql)){
					echo 'Blocked';
				}
				else
					die(mysqli_error($conn));
			}
			else
				die(mysqli_error($conn));
		}
	
	}
	
	
	
?>