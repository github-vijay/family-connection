<?php include("dbconnect.php"); ?>
<html>
<title></title>
<link rel="stylesheet" type="text/css" href="assets/css/style.css">
<body>
	<div id="user-info">
		<?php 
			$umobile=$_SESSION['umobile'];
			$exe_query=$conn->query("SELECT `user_image` FROM `user` WHERE `user_no`='$umobile'");
			if($exe_query->num_rows>0){
				while($userRow=$exe_query->fetch_assoc()){
					echo "<div>".'<img src="data:image/jpeg;base64,'.base64_encode($userRow['user_image']).'" height="50" width="50"/>'."</div>";
				}
			}
		?>
		<div><?php echo(" ".$_SESSION['uname']) ?></div>
		<div>
			<form method="POST" action="profileImageAction.php" enctype="multipart/form-data">
				<input type="file" name="profile_img" accept="image/*" required placeholder="No">
				<input type="submit" name="change_profile_img" value="upload/change Profile Image">
			</form>
		</div>
	</div>
		
		
		
			<div>
				<form method="post" action="statusImageBlobUpload.php" enctype="multipart/form-data">
					<textarea name="user_status" id="user_status" placeholder="What's up">
					</textarea></br>
					<input type="file" name="file_img" accept="image/*">
					<input type="Submit" name="upload_status_image" value="Upload">
				</form>
			</div>
		
		
		
			
			<!--<div><form method="post" action="imageUpload.php" enctype="multipart/form-data">
					<input type="file" name="pic" accept="image/*">
					<input type="Submit" name="upload_image" value="Upload photo">
				</form>
			</div>-->

	<?php
	$sql = "SELECT * FROM `status_image_upload` ORDER BY `upload_id` DESC";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	echo"<table border='1'>";
    		
    		echo "<tr><td>".$row["user_name"]."</td></tr>";
    		echo "<tr><td>".$row["upload_time"]."</td></tr>";
    		echo "<tr><td>".$row["status"]."</td></tr>";
    		if(strlen($row['image']))
    		echo "<tr><td>".'<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'" height="500" width="500"/>'."</td></tr>";
    		$sql4comment="SELECT * FROM `comment_record` WHERE `uploadid_for_comment`='".$row['upload_id']."'";
    	$result4comment = $conn->query($sql4comment);
    	if($result4comment->num_rows>0){ 
    		while($row4comment=$result4comment->fetch_assoc()){
    			echo "<tr><td>".$row4comment["user_name"]." : ".$row4comment["comment"]." </td></tr>";
    		}
    	}
    		echo "<tr><td><form method='post' action='commentUpload.php'>
    						<input type='hidden' name='uploadid' value='".$row["upload_id"]."'>
    						<input type='text' name='comment' placeholder='Enter your comment'>
    			  			<input type='Submit' name='submit_comment'value='Enter'>
    			  		</form></td></tr>";
    	echo "</table>";
    	echo "<br>";
    	}
    }
    else{
    	 echo "0 results";
    }

    	
    
    $conn->close();
?>

  
</body>
</html>