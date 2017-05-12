<?php include("dbconnect.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<script src="assets/bootstrap/js/jquery.min.js"></script>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<!-- <script type="text/javascript">
	  function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
      
        reader.onload = function (e) {
        $('#imagePreview').attr('src', e.target.result);
      }
            
      reader.readAsDataURL(input.files[0]);
      /*input.files[0].name; //displays the filename*/

    }
  }
  $("#prof-image-upload").change(function(){
    readURL(this);
});
</script> -->
</head>
<body style="position: relative;">
<div id="user-info">
	<div id="profile-photo">
		<!-- <form method="POST" action="coverImageAction.php" enctype="multipart/form-data">
			<input type="file" name="cover_img" accept="image/*" required>
			<input type="submit" name="change_cover_img" value="Update Cover Image">
			</form> -->
		<span>Change Profile Pic</span>
	</div>
	<div id="cover-photo">
	</div>
	<span id="change-cover">Change Cover Image</span>
	<span id="user-name"><?php echo $_SESSION['uname'];?></span>
</div>
<div id="personal-info" style="position: absolute;left: 0px;background-color: #fff;height: auto;width:250px;">
<?php
	// $sql4profile="SELECT * FROM `user` WHERE `user_no`='".$_SESSION['umobile']."'";
	// $result4profile=$conn->query($sql4profile);
	// if($result4profile->num_rows>0){
	// 	while($row4profile=$result4profile->fetch_assoc()){
	// 		echo "<span>My personal info : </span><br>";
	// 		echo "<span>My mobile no. : ".$row4profile['user_no']."</span><br>";
	// 		echo "<span>My e-mail ID : ".$row4profile['user_mail']."</span><br>";
	// 		echo "<span>My dob : ".$row4profile['user_dob']."</span><br>";
	// 		echo "<span>My gender : ".$row4profile['user_gender']."</span><br>";
	// 		echo "<span><a href='profile.php'><input type='submit' name='change_pwd' value='change password'></a></span>";
	// 	}
	// }
?>	
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
	    while($row = $result->fetch_assoc()) { ?>

			<div class="feed-box">
				<div class="feed-box-header">
					<div class="feed-box-header-image"></div>
					<div class="feed-box-user-name">
						<span><?php echo $row["user_name"];?></span><br>
						<!-- <span><?php// echo $row["status"]?></span> -->
						<span>Posted on <?php echo $row["upload_time"];?></span>
					</div>
				</div>

				<div class="feed-box-text"><?php echo $row["status"]?></div>

	    <?php

	    		if(strlen($row['image']))
	    			echo '<div class="feed-box-image-div"><img class="img-responsive feed-box-image" src="data:image/jpeg;base64,'.base64_encode($row['image']).'"/></div>';
	    			//echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'" height="300" width="300"/>';
	    		$sql4comment="SELECT * FROM `comment_record` WHERE `uploadid_for_comment`='".$row['upload_id']."'";
	    		$result4comment = $conn->query($sql4comment);
	    		echo '<div style="margin: 20px auto 10px;">Comments:</div>';
	    		if($result4comment->num_rows>0){ 
	    			while($row4comment=$result4comment->fetch_assoc()){
	    				//echo "<tr><td>".$row4comment["user_name"]." : ".$row4comment["comment"]." </td></tr>";
	    				echo '<div class="feed-box-comments"><span>'.$row4comment["user_name"].'</span> : '.$row4comment["comment"].'</div>';
	    			}
	    		}
	    		echo "<form class='form-comment-upload' method='post' action='commentUpload.php'>
	    						<input type='hidden' name='uploadid' value='".$row["upload_id"]."'>
	    						<input type='text' name='comment' placeholder='Enter your comment'>
	    			  			<input type='Submit' name='submit_comment'value='Enter'>
	    			  		</form>";
	    		echo '</div>';
    	}
    }
    else{
    	 echo "0 results";
    }    	
    $conn->close();
?>


		<!-- <div class="feed-box-image"></div> -->
		<!-- <div class="feed-box-text"> -->
		<!-- </div> -->
	<!-- </div> -->


</div>
<script type="text/javascript">
        var request = $.ajax({
          url: "profilePictureLoad.php",
          method: "POST",
          data : {'data' : 'user_image'}
        });
         
        request.done(function( response ) {
           $('#profile-photo').css("background-image", "url("+ response +")"); 
        });
         
        request.fail(function( jqXHR, textStatus ) {
          console.log("Could not successfully complete AJAX request.");
        });
	
</script>
<!-- Making changes!!! 10/5/2017 -->
<script type="text/javascript">
        var request = $.ajax({
          url: "profilePictureLoad.php",
          method: "POST",
          data : {'data' : 'user_cover_image'}
        });
         
        request.done(function( response ) {
           $('#cover-photo').css("background-image", "url("+ response +")"); 
        });
         
        request.fail(function( jqXHR, textStatus ) {
          console.log("Could not successfully complete AJAX request!");
        });
	
</script>

</body>
</html>