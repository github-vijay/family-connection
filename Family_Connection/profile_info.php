<?php 
	include 'connection.php'; 
	include 'session.php';

	$id = $_GET['id'];
	$type = $_GET['type'];
	$result_from_group = null;
	$result_from_user = null;
	$result_from_friend = null;
	if($type == 'group'){
		$sql_for_user = "SELECT `User_ID` from `group_members` where `Group_ID` = '$id'";
		$query_for_user = mysqli_query($conn,$sql_for_user);
		$sql_for_admin = "SELECT `User_ID` from `group_admin` where `Group_ID` = '$id'";
		$query_for_admin = mysqli_query($conn,$sql_for_admin);
		$sql_for_group = "SELECT * from `group` where ID = '$id'";
		$query_for_group = mysqli_query($conn,$sql_for_group);
		$result_from_group = mysqli_fetch_array($query_for_group);
		$result_from_admin = mysqli_fetch_array($query_for_admin);
	}
	else if($type == 'friend'){
		$sql_for_friend = "SELECT * from `user` where `ID` = '$id'";
		$query_for_friend = mysqli_query($conn,$sql_for_friend);
		$result_from_friend = mysqli_fetch_array($query_for_friend);
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" type="text/css" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="bootstrap-3.3.7-dist/css/profile_css.css">
	<link rel="stylesheet" href="bootstrap-3.3.7-dist/bootstrap-multiselect-master/dist/css/bootstrap-multiselect.css">
	<script src="bootstrap-3.3.7-dist/js/jquery-3.2.1.min.js"></script>
	<script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
	<script src="bootstrap-3.3.7-dist/bootstrap-multiselect-master/dist/js/bootstrap-multiselect.js"></script>

	<style type="text/css">
		.main_content{
		margin-top: 60px;
		border: 1px solid #DCDCDC;
		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	}

	.profile-image{
		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  		text-align: center;
	}
	</style>


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
      <a class="navbar-brand" href="Chat_main.php">FAMILY CONNECTION</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">        
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
        <li><a href="designTest2.php">Timeline</a></li>
        <li><a href="chat.php">Chat</a></li>
        <li><a href="friends.php">Friends</a></li>
        <li><a href="Logout.php"><span class="glyphicon glyphicon-log-out" style="font-size:15px;"></span>&nbsp;Logout</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<form action="" enctype="multipart/form-data">
	<div class="container-fluid">
		<div class="col-md-offset-3 col-md-6 main_content">
		<?php
		if($type == 'group'){?>
		<div class="profile-image">
			<img src="<?php echo $result_from_group['Profile_Pic'];?>" alt="<?php echo $result_from_group['Profile_Pic'];?>" class="img-responsive">
		</div>
		<br>
		<label>Change Profile Picture:</label>
			<input type="file" name="profile">
		<div class="">
			<label>Members:</label>
			<table class="table table-hover table-condensed">
				<tr>
					<td id="add_members">
						<a><span class="glyphicon glyphicon-plus-sign"> Add Members</span></a>
						<select id="all-friends" multiple="multiple">
	                    <?php
	                        $sql = "SELECT `ID`,`First_Name`,`Middle_Name`,`Last_Name`,`Profile_Pic` from `user` where `ID` IN (SELECT `Friend_ID` from `friends` where `User_ID` = '".$_SESSION['u_info']['ID']."') ";
								$query_for_friend = mysqli_query($conn,$sql);
								if(mysqli_num_rows($query_for_friend)>0){
									
									while($result = mysqli_fetch_array($query_for_friend)){
										
										if($result['Middle_Name']){
										?>
											<option value="<?php echo $result['ID'];?>"><?php echo ''.$result['First_Name']." ".$result['Last_Name'];?></option>
	                                    <?php
										}
									  	else{
											?>
									  		<option value="<?php echo $result['ID'];?>"><?php echo ''.$result['First_Name']." ".$result['Middle_Name']." ".$result['Last_Name'];?></option>
										<?php	
										}
									}
								}
	                    ?>
                		</select>
					</td>
				</tr>
				<?php 
				if(mysqli_num_rows($query_for_user) > 0){
					while($result_from_user = mysqli_fetch_array($query_for_user)){
						?>
						<tr>
							<td id="members">
								<a>
									<span>
										<?php 
										$sql = "SELECT First_Name,Middle_Name,Last_Name,Profile_Pic from `user` where `ID` = '".$result_from_user['User_ID']."'";
										$query = mysqli_query($conn,$sql);
										$result = mysqli_fetch_array($query);
										?>
										<img src="<?php echo $result['Profile_Pic'];?>" alt = "<?php echo $result['Profile_Pic'];?>" width = "30" height = "30">&nbsp;&nbsp;
										<?php 
										if($result['Middle_Name'] == ""){
											?><span><?php	echo $result['First_Name']." ".$result['Last_Name'];?></span><?php
										}
										else{
										  	?><span><?php	echo $result['First_Name']." ".$result['Middle_Name']." ".$result['Last_Name'];?> </span>
		                                	<?php 
		                                } ?>
	                                </span>
	                            </a>
	                            </td>
	                           
	                                <span>
	                                
	                                	<td>
	                                	<?php
	                                	$done = 0;
	                                	if($result_from_user['User_ID'] == $result_from_group['Created_By']){
	                                		echo '<h5>Head Admin</h5>';
	                                		$done = 1;
	                                	}
	                                	else{
	                                		while($result_from_admin = mysqli_fetch_array($query_for_admin)){
	                                			if($result_from_user['User_ID'] == $result_from_admin['User_ID']){
	                                				echo '<h5>Admin</h5>';
	                                				$done = 1;
	                                			}
	                                		}
	                                	}
	                                	?>
                                		</td>
                                		<td>
                                		<?php
                                		if($done == 0)
                            			{
                            			?>
                            				<button type="button" id="<?php echo $result_from_user['User_ID']; ?>" class="btn btn-success"> Make Admin </button>
                            			<?php
                            			}
	                                	?>
	                                	</td>
	                                	<td>
	                                		<button type="button" class="btn btn-danger">Kick</button>
	                                	</td>
	                                </span>
                                
							
						</tr>
						<?php
					}
				}
				else
					echo 'No members till now.';
				?>
			</table>
		</div>
		<?php }?>
		<?php if($type == 'friend'){?>
			<div class="profile-image">
				<img src="<?php echo $result_from_friend['Profile_Pic'];?>" alt="<?php echo $result_from_friend['Profile_Pic'];?>">
				<label>Change Profile Picture:</label>
				<input type="file" name="profile">
			</div>
			<div class="">
				<img src="<?php echo $result_from_friend['Cover_Pic'];?>" alt="<?php echo $result_from_friend['Cover_Pic'];?>">
				<label>Change Cover Image</label>
				<input type="file" name="cover">
			</div>
		<?php 
		}
		?>
	</div>
	</div>
	
</form>
<script type="text/javascript">
        /*var request = $.ajax({
          url: "profilePictureLoad.php",
          method: "POST",
          data : {'data' : 'user_image'}
        });
         
        request.done(function( response ) {
           $('#profile-photo').css("background-image", "url("+ response +")"); 
        });
         
        request.fail(function( jqXHR, textStatus ) {
          console.log("Could not successfully complete AJAX request.");
        });*/
	
</script>
<!-- Making changes!!! 10/5/2017 -->
<script type="text/javascript">
$(document).ready(function(){
	$('#all-friends').multiselect({
            //buttonContainer: '',
      includeSelectAllOption: true,
            enableFiltering: true,
      onChange: function() {
          
        friends = $('#all-friends').val();
      //console.log(friend_id);
      }
            
  });
});

       /*var request = $.ajax({
          url: "profilePictureLoad.php",
          method: "POST",
          data : {'data' : 'user_cover_image'}
        });
         
        request.done(function( response ) {
           $('#cover-photo').css("background-image", "url("+ response +")"); 
        });
         
        request.fail(function( jqXHR, textStatus ) {
          console.log("Could not successfully complete AJAX request!");
        });*/
	
</script>

</body>
</html>