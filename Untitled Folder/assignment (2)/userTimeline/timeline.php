<?php include("dbconnect.php"); ?>
<html>
<body>
		<div>User infromation<?php echo(" ".$_SESSION['usermobile']) ?></div>
			<div><form method="post" action="statusImageUpload.php" enctype="multipart/form-data">
					<textarea name="user_status" id="user_status" placeholder="What's up" row="8" cols="50">
					</textarea></br>
					<input type="file" name="file_img" accept="image/*">
					<input type="Submit" name="upload_status_image" value="Upload status">
				</form>
			</div>
		
		
		
			
			<!--<div><form method="post" action="imageUpload.php" enctype="multipart/form-data">
					<input type="file" name="pic" accept="image/*">
					<input type="Submit" name="upload_image" value="Upload photo">
				</form>
			</div>-->

		

</body>
</html>