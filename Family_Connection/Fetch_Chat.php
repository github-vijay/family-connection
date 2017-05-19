<?php
	include 'connection.php';
	include 'session.php';

	$user= $_SESSION['u_info']['ID'];
	$friend_group_ID = $_POST['Friend_Group_ID'];
	
	$_SESSION['type'] = $type = $_POST['Type'];
	if($type == "friend"){
		$_SESSION['F_ID']['FriendID'] = $friend_group_ID;
		$sql = "SELECT `Chat_ID` from `friends` where `User_ID` = '$user' and `Friend_ID` = '$friend_group_ID'";
		
		$query = mysqli_query($conn,$sql);
		
		if(mysqli_num_rows($query)>0){
			$result_from_friends = mysqli_fetch_array($query);
			
			$Chat_ID = $result_from_friends['Chat_ID'];
			
			$sql = "SELECT `FilePath` from `chat` where `ID` = '$Chat_ID'";
			$query = mysqli_query($conn,$sql);
			if(mysqli_num_rows($query)){
				$result_from_chat = mysqli_fetch_array($query);
				$file_path = $result_from_chat['FilePath'];
				
				$_SESSION['ChatFile'] = $file_path;
				
				if ( 0 == filesize($file_path)){
					echo 'No conversations yet.';
				}
				else{
					$file_contents = file_get_contents($file_path);
					$file_json_objects = explode("+,+",$file_contents);
			
					foreach ($file_json_objects as $key => $value) {
						$str = json_decode($value,true);
						if($str['user'] == $user){
						?>
						<span style="float:right;"><?php echo $str['message'];?></span><br/>
						<?php
						}
						else if($str['user'] == $friend_group_ID){
							?><span style="float:left;"><?php echo $str['message'];?></span><br>
						<?php
						}
					}
				}
			}
		}
	}
	else if($type == "group"){
		$sql = "SELECT `ID`,`Chat_ID` from `group` where `ID` = '$friend_group_ID'";
		
		$query = mysqli_query($conn,$sql);
		
		if(mysqli_num_rows($query)>0){
			$result_from_group = mysqli_fetch_array($query);
			
			$sql = "SELECT `User_ID` from `group_members` where `Group_ID` = '".$result_from_group['ID']."'";
			$query_for_user = mysqli_query($conn,$sql);
			
			// Counting the number of the user
			/*$sql = "SELECT max(*) from `group_members` where `Group_ID` = '".$result_from_group['ID']."'";
			$query_num = mysqli_query($conn,$sql);
			$number = mysqli_fetch_array($query_num);*/
			$User_ID_Name = array();
			// End of counting the number of user
			
			
			if(mysqli_num_rows($query_for_user)>0){
				
				$i = 0;
				while($result_for_user = mysqli_fetch_array($query_for_user)){
					$sql = "SELECT `ID`,`First_Name`,`Middle_Name`,`Last_Name` from `user` where `ID` = '".$result_for_user['User_ID']."'";
					$query_for_name = mysqli_query($conn,$sql);
					$res = mysqli_fetch_array($query_for_name);
					$_SESSION['F_ID'][$res['ID']] = $res['First_Name'];
					//echo $User_ID_Name[$res['ID']];    // Save ID of the user
					/*$Name_User[$i] = $res['First_Name'];   // Only first name taken into account, can take the middle name and the last name too.
					 $i++;*/
				}
			}
			
			$Chat_ID = $result_from_group['Chat_ID'];
			
			$sql = "SELECT `FilePath` from `chat` where `ID` = '$Chat_ID'";
			$query = mysqli_query($conn,$sql);
			if(mysqli_num_rows($query)){
				$result_from_chat = mysqli_fetch_array($query);
				$file_path = $result_from_chat['FilePath'];
				
				$_SESSION['ChatFile'] = $file_path;
				
				if ( 0 == filesize($file_path)){
					echo 'No conversations yet.';
				}
				else{
					$file_contents = file_get_contents($file_path);
					$file_json_objects = explode("+,+",$file_contents);
			
					foreach ($file_json_objects as $key => $value) {
						$str = json_decode($value,true);
						if($str['user'] == $user){
						?>
						<span style="float:right;"><?php echo $str['message'];?></span><br/>
						<?php
						}
						else{
							
							if($str['user'] != null){
							?><span style="float:left;"><?php echo $_SESSION['F_ID'][$str['user']].": ".$str['message'];?></span><br>  <!-- Sending name of the user along with the messages-->
						<?php
							}
						}
					}
				}
			}
		}
	}
?>