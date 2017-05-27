<?php 
	include("connection.php"); 
	include 'session.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" type="text/css" href="assets/bootstrap-3.3.7-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<script src="assets/bootstrap-3.3.7-dist/js/jquery-3.2.1.min.js"></script>
	<script src="assets/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
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
<nav class="navbar navbar-inverse navbar-fixed-top" style="margin:0px;">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="designTest2.php">FAMILY CONNECTION</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">        
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
        <li><a href="designTest2.php">Timeline</a></li>
        <li><a href="chat.php">Chat</a></li>
        <li><a href="friends.php">Friends</a></li>
        <li><a href="Logout.php"><span class="glyphicon glyphicon glyphicon-off" style="color:red; font-size:12px;"></span></a>
</li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
    	
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
	<span id="user-name">
	<?php 
		if($_SESSION['u_info']['Middle_Name'] == "")
			echo $_SESSION['u_info']['First_Name']." ".$_SESSION['u_info']['Last_Name'];
		else
			echo $_SESSION['u_info']['First_Name']." ".$_SESSION['u_info']['Middle_Name']." ".$_SESSION['u_info']['Last_Name'];
	?>
    </span>
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
			<textarea name="user_status" id="user_status" placeholder="What's up?" required></textarea><br>
			<input type="file" name="file_img" accept="image/*"><br>
			<input type="Submit" name="upload_status_image" value="Upload">
		</div>
	</form>
</div>
<div id="feeds">
	<?php
	$sql = "SELECT * FROM `status_image_upload` where `User_ID` = '".$_SESSION['u_info']['ID']."' or `User_ID` IN (SELECT `Friend_ID` from `friends` where `User_ID` = '".$_SESSION['u_info']['ID']."') ORDER BY `ID` DESC";
	$result = mysqli_query($conn,$sql);

	if(mysqli_num_rows($result) > 0) {
    	// output data of each row
	    while($row = mysqli_fetch_array($result)) { ?>

			<div class="feed-box">
				<div class="feed-box-header">
					<div class="feed-box-header-image"></div>
					<div class="feed-box-user-name">
						<span>
						<?php 
							//echo $row["User_ID"];
							$sql = "SELECT `First_Name`,`Middle_Name`,`Last_Name` from `user` where `ID` = '".$row['User_ID']."'";
							$query_for_name = mysqli_query($conn,$sql);
							$name = mysqli_fetch_array($query_for_name);
							
							if($name['Middle_Name'] == "")
								echo $name['First_Name']." ".$name['Last_Name'];
			  				else
								echo $name['First_Name']." ".$name['Middle_Name']." ".$name['Last_Name'];
						
						
						?></span><br>
						<!-- <span><?php// echo $row["status"]?></span> -->
						<span>Posted on <?php echo $row["Upload_Time"];?></span>
					</div>
				</div>

				<div class="feed-box-text"><?php echo $row["Status"]?></div>

	    <?php

	    		if(strlen($row['Image']))
	    			echo '<div class="feed-box-image-div"><img class="img-responsive feed-box-image" src="data:image/jpeg;base64,'.base64_encode($row['Image']).'"/></div>';
	    			//echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'" height="300" width="300"/>';
	    		$sql4comment="SELECT * FROM `comment_record` WHERE `ID`='".$row['ID']."'";
	    		$result4comment = mysqli_query($conn,$sql4comment);
	    		echo '<div style="margin: 20px auto 10px;">Comments:</div>';
	    		if(mysqli_num_rows($result4comment)>0){ 
	    			while($row4comment = mysqli_fetch_array($result4comment)){
	    				//echo "<tr><td>".$row4comment["user_name"]." : ".$row4comment["comment"]." </td></tr>";
						$sql = "SELECT `First_Name`,`Middle_Name`,`Last_Name` from `user` where `ID` = '".$row['User_ID']."'";
							$query_for_name = mysqli_query($conn,$sql);
							$name = mysqli_fetch_array($query_for_name);
							
							if($name['Middle_Name'] == "")
								$comment_usr = $name['First_Name']." ".$name['Last_Name'];
			  				else
								$comment_usr = $name['First_Name']." ".$name['Middle_Name']." ".$name['Last_Name'];
						
	    				echo '<div class="feed-box-comments"><span>'.$comment_usr.'</span> : '.$row4comment["Comment"].'</div>';
	    			}
	    		}
	    		echo "<form class='form-comment-upload' method='post' action='commentUpload.php'>
	    						<input type='hidden' name='uploadid' value='".$row["ID"]."'>
	    						<input type='text' name='comment' placeholder='Enter your comment'>
	    			  			<input type='Submit' name='submit_comment'value='Enter'>
	    			  		</form>";
	    		echo '</div>';
    	}
    }
    else{
    	 echo "Start making friends or post status of your own to see something here.";
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