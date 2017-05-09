<?php
	include 'session.php';
	include 'connection.php';
	
	if(isset($_POST['ID'])){
		$id = $_POST['ID'];
		
		$user = $_SESSION['u_info']['ID'];
		
		$date = date("Y-m-d h:i:s");
		
		$sql = "INSERT into `friend_request` (From_User,To_User,Time_of_Request,Status) values ('$user','$id','$date',0)";
		
		if(mysqli_query($conn,$sql)){
			
			echo "Friend Request Sent.";
			
		}
		else{
			echo "Error occurred during request sending.";
		}
	
	}
	else
		echo "Fatal Error occured";
	?>
