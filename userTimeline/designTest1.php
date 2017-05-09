<?php include("dbconnect.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<script src="assets/bootstrap/js/jquery.min.js"></script>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<div id="user-info">
	<div id="profile-photo"></div>
	<div id="cover-photo" class="img-responsive">
	</div>
	<span id="user-name">Vivek Panicker</span>
</div>
<div id="status">
	<form  method="post" action="statusImageBlobUpload.php" enctype="multipart/form-data">
		<div class="status-container">
			<label>Post a status or upload a photo!</label><br>
			<textarea name="user_status" id="user_status" placeholder="What's up"></textarea><br>
			<input type="file" name="file_img" accept="image/*"><br>
			<input type="Submit" name="upload_status_image" value="Upload">
		</div>
	</form>
</div>
<div id="feeds">
	<?php
	$sql = "SELECT * FROM `status_image_upload` ORDER BY `upload_id` DESC";
	$result = $conn->query($sql);

	if($result->num_rows > 0) {
    	// output data of each row
	    while($row = $result->fetch_assoc()) {
	    		if(strlen($row['image']))
	    			echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'" height="300" width="300"/>';
	    		$sql4comment="SELECT * FROM `comment_record` WHERE `uploadid_for_comment`='".$row['upload_id']."'";
	    		$result4comment = $conn->query($sql4comment);
	    		if($result4comment->num_rows>0){ 
	    			while($row4comment=$result4comment->fetch_assoc()){
	    				echo "<tr><td>".$row4comment["user_name"]." : ".$row4comment["comment"]." </td></tr>";
	    			}
	    		}
	    		echo "<form method='post' action='commentUpload.php'>
	    						<input type='hidden' name='uploadid' value='".$row["upload_id"]."'>
	    						<input type='text' name='comment' placeholder='Enter your comment'>
	    			  			<input type='Submit' name='submit_comment'value='Enter'>
	    			  		</form>";
    	}
    }
    else{
    	 echo "0 results";
    }    	
    $conn->close();
?>
	<div class="feed-box">
		<div class="feed-box-header">
			<div class="feed-box-header-image"></div>
			<div class="feed-box-user-name">
				<span><?php echo $row["user_name"];?></span>
				<span><?php echo $row["status"]?></span>
				<br>
				<span><?php echo $row["upload_time"];?></span>
			</div>
		</div>

		<div class="feed-box-image"></div>
		<div class="feed-box-text">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
		</div>
	</div>	
</div>
<script type="text/javascript">
        var request = $.ajax({
          url: "profilePictureLoad.php",
          method: "POST",
          //data : {umobile:<?php //echo $_SESSION['umobile'] ?>}
        });
         
        request.done(function( response ) {
           $('#profile-photo').css("background-image", "url("+ response +")"); 
        });
         
        request.fail(function( jqXHR, textStatus ) {
          console.log("Could not update user location in database!");
        });
	
</script>
</body>
</html>