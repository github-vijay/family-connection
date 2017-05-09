<?php
	include 'session.php';
	include 'connection.php';
	
	if(isset($_REQUEST['submit'])){
	
	$number = $_POST['phone'];
	
	$sql = "SELECT ID, First_Name, Middle_Name, Last_Name, Profile_Pic from `user` where `Phone` = '$number'";
	
	$request = mysqli_query($conn,$sql);
	
	echo "<table><caption><u>Search Result</u></caption>";
	if(mysqli_num_rows($request)>0){
		
		while($result = mysqli_fetch_array($request)){
			
			$fid = $result['ID'];
			$uid = $_SESSION['u_info']['ID'];
			
			$query_from_blockedUser = "SELECT * from `blocked_user` where `To_User` = '$uid' and `From_User` = '$fid'";
			
			$req_from_block = mysqli_query($conn,$query_from_blockedUser);
			
			if(mysqli_num_rows($req_from_block) > 0){
				echo 'No records found.';
			}
			else{
			
				$query_from_friends = "SELECT * from `friends` where User_ID = '$uid' and Friend_ID = '$fid'";  //checks whether user is already friend with the searched user
				
				$req1 = mysqli_query($conn,$query_from_friends);
				
				$query_from_frequest = "SELECT * from `friend_request` where `From_User` = '$uid' and `To_User` = '$fid'";   // checks whether the user has already sent the request in the past
				
				$req2 = mysqli_query($conn,$query_from_frequest);
				
				
				if(mysqli_num_rows($req1)>0){
				
					echo "<tr><td>";
					$name = $result['First_Name']." ".$result['Middle_Name']." ".$result['Last_Name'];
					?><img src="<?php echo $result['Profile_Pic'];?>" alt="<?php echo $name ;?>" width="50" height="50">
					<?php
					echo $name;
					?>
					&nbsp;&nbsp; <span>Already friend.</span>
					<?php
					echo "</td></tr>";
				}
				else if(mysqli_num_rows($req2)>0){
					echo "<tr><td>";
					$name = $result['First_Name']." ".$result['Middle_Name']." ".$result['Last_Name'];
					?><img src="<?php echo $result['Profile_Pic'];?>" alt="<?php echo $name ;?>" width="50" height="50">
					<?php
					echo $name;
					?>
					&nbsp;&nbsp; <span>Request already sent.</span>
					<?php
					echo "</td></tr>";
				}
				else{
					echo "<tr><td>";
					$name = $result['First_Name']." ".$result['Middle_Name']." ".$result['Last_Name'];
					?><img src="<?php echo $result['Profile_Pic'];?>" alt="<?php echo $name; ?>" width="50" height="50">
					<?php
					echo $name;
					?>
					<button type="button" id="<?php echo $result['ID'];?>" onclick="sendRequest(<?php echo $result['ID'];?>)">Send Request</button>
					<?php
					echo "</td></tr>";
				}
			}
		}
	}
	else{
		echo "No records found.";
	}
	echo "</table>";
	}

?>
