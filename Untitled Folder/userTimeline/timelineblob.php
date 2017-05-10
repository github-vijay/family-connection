<?php include("dbconnect.php"); ?>
<html>
<body>
	<table><tr><td><a href="timelineblob.php">Home</a></td></tr></table>
		<?php 
			$umobile=$_SESSION['umobile'];
			$query4coverImage=$conn->query("SELECT `user_cover_image` FROM `user` WHERE `user_no`='$umobile'");
			if($query4coverImage->num_rows>0){
				while($userCoverRow=$query4coverImage->fetch_assoc()){
					echo "<div>".'<img src="data:image/jpeg;base64,'.base64_encode($userCoverRow['user_cover_image']).'" height="40%" width="100%"/>'."</div>";
				}
			}
		?>
		<div><form method="POST" action="coverImageAction.php" enctype="multipart/form-data">
			<input type="file" name="cover_img" accept="image/*" required>
			<input type="submit" name="change_cover_img" value="Update Cover Image">
		</form></div>
		<?php 
			
			$exe_query=$conn->query("SELECT `user_image` FROM `user` WHERE `user_no`='$umobile'");
			if($exe_query->num_rows>0){
				while($userRow=$exe_query->fetch_assoc()){
					echo "<div>".'<img src="data:image/jpeg;base64,'.base64_encode($userRow['user_image']).'" height="50" width="50"/>'."</div>";
				}
			}
			?>
		<div><form method="POST" action="profileImageAction.php" enctype="multipart/form-data">
			<input type="file" name="profile_img" accept="image/*" required>
			<input type="submit" name="change_profile_img" value="upload/change Profile Image">
		</form></div>
		<div>User infromation<?php echo(" ".$_SESSION['uname']) ?></div>
			<div><form method="post" action="statusImageBlobUpload.php" enctype="multipart/form-data">
					<textarea name="user_status" id="user_status" placeholder="What's up" row="8" cols="50">
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
	<div float="left">
			<table>
				
				<?php
					$sql4profile="SELECT * FROM `user` WHERE `user_no`='".$_SESSION['umobile']."'";
					$result4profile=$conn->query($sql4profile);
					if($result4profile->num_rows>0){
						while($row4profile=$result4profile->fetch_assoc()){
							echo "<tr><td>".$row4profile['user_no']."</td></tr>";
							echo "<tr><td>".$row4profile['user_mail']."</td></tr>";
							echo "<tr><td>".$row4profile['user_dob']."</td></tr>";
							echo "<tr><td>".$row4profile['user_gender']."</td></tr>";
							echo "<tr><td><a href='profile.php'><input type='submit' name='change_pwd' value='change password'></a></td></tr>
							</table>";
						}
					}
				?>
				
		</div>
		<div flioat="left">

	<?php
	$sql = "SELECT * FROM `status_image_upload` ORDER BY `upload_id` DESC";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	echo"<table border='1'>";
    		$_SESSION['user_mob4_profile']=$row['user_mob_number'];
    		echo "<tr><td><a href='profile.php'>".$row["user_name"]."</a></td></tr>";
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
	</div>
  
</body>
</html>