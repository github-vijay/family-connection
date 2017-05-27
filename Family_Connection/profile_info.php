<?php 
	include 'connection.php'; 
	include 'session.php';

	$id = $_GET['id'];
	$_SESSION['grp_frnd_id'] = $id;
	$type = $_GET['type'];
	$user_type = null;
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
		margin-bottom: 20px;
		border: 1px solid white;
		border-radius: 5px;
		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	}

	.group-name{
		margin-top: 20px;
	}

	.group-name label{
		font-size: 20px;
	}
	input[type='text']{
		border-radius: 5px;
		width:200px;
	}
	#leave-group{
		float: right;
	}
	.profile-image{
		margin-top: 15px;
		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
		border: 1px solid white;
		border-radius: 5px;
  		text-align: center;
	}
	.members{
		margin-top: 20px;
	}
	/*.add-members{
		
	}*/
	a{
		text-decoration: none;
	}
	.glyphicon-plus-sign{
		font-size: 15px;
	}
	.add-members{
		margin-bottom: 20px;
	}
	#Delete{
		margin-top: 20px;
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
<div class="modal fade" id="confirm-leave" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <p>Are you sure, you want to leave this group ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Oops! No</button>
        <button type="button" class="btn btn-primary" id="leave_done" group="<?php echo $id;?>" usertype = "<?php echo $user_type;?>">Yeah! Enough</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- Modal for making admin-->
<div class="modal fade" id="make_admin_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h3 id="admin-text"></h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Are you mad?</button>
        <button type="button" class="btn btn-primary" id="admin-done">Deserving</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal for kicking -->
<div class="modal fade" id="kickModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h4 id="kick-text"></h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Oops! Sorry</button>
        <button type="button" class="btn btn-primary" id="kick-done">Enough! Kick</button>
      </div>
    </div>
  </div>
</div>

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
		if($type == 'group'){

			while($result_from_admin = mysqli_fetch_array($query_for_admin)){
			if($_SESSION['u_info']['ID'] == $result_from_admin['User_ID'])
				$user_type = 'admin';
			}

			if($_SESSION['u_info']['ID'] == $result_from_group['Created_By']){
				$user_type = 'head-admin';
			}
			elseif($user_type == ''){
				$user_type = 'member';
			}

		?>
		<div class="group-name">
			<label>Group Name:</label>
			<input type="text" name="group_name" required value="<?php echo $result_from_group['Name'];?>" required>
			<button type="button" class="btn btn-primary change" action="change_name">Change Name</button>
			<button type="button" class="btn btn-default leave" id="leave-group" data-toggle="modal" data-target="#confirm-leave">Leave this group</button>
		</div>
		<hr>
		<div class="profile-image">
			<img src="<?php echo $result_from_group['Profile_Pic'];?>" alt="<?php echo $result_from_group['Profile_Pic'];?>" class="img-responsive">
		</div>
		<br>
		<label>Change Profile Picture:</label>
		<form type="post" action="profile_action.php" enctype="form-data/multipart">
			<input type="file" name="profile">
			<input type="hidden" name="grp_id" value="<?php echo $id;?>">
			<input type="submit" class="btn btn-success" name="change_profile_img" value="Change">
		</form>
		<hr>
		<div class="members">
			<h3>Members:</h3>
				<?php 
					if($user_type == 'head-admin' || $user_type == 'admin'){?>
					<div class="add-members">
						<span class="glyphicon glyphicon-plus-sign"></span> &nbsp;Add Members:
						&nbsp; &nbsp; &nbsp; &nbsp;
						<select id="all-friends" multiple="multiple">
	                    <?php
	                        $sql = "SELECT `ID`,`First_Name`,`Middle_Name`,`Last_Name` from `user` where `ID` IN (SELECT `Friend_ID` from `friends` where `User_ID` = '".$_SESSION['u_info']['ID']."') ";
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
                	</div>
                <?php
                }
                ?>
				<table class="table table-hover table-condensed">	
				<?php 
				if(mysqli_num_rows($query_for_user) > 0){
					while($result_from_user = mysqli_fetch_array($query_for_user)){
						?>
						<tr>
							<td>
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
											?><span><?php echo $result['First_Name']." ".$result['Last_Name']; ?></span><?php
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
                                		if(($user_type == 'head-admin' || $user_type == 'admin') && $done == 0)
                            			{
                            			?>
                            				<button type="button" data="<?php echo $result_from_user['User_ID']; ?>" data-name="<?php echo $result['First_Name'];?>" class="btn btn-success make-admin" data-toggle="modal" data-target="#make_admin_modal"> Make Admin </button>
                            			<?php
                            			}
	                                	?>
	                                	</td>
	                                	<td>
	                                	<?php
	                                	if($user_type == 'head-admin' || $user_type == 'admin')
                            			{
                            			?>	
	                                		<button type="button" class="btn btn-danger kick" data="<?php echo $result_from_user['User_ID']?>" data-name="<?php echo $result['First_Name'];?>" data-toggle="modal" data-target="#kickModal">Kick</button>
	                                	<?php 
	                                	}
	                                	?>
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
			<?php
			if($user_type == 'head-admin'){?>
				<hr>
				<div id="Delete" class="col-md-offset-5">
					<button type="button" class="btn btn-danger">Delete this group</button>
				</div>
			<?php
			}
			?>
		</div>
		<?php
		}
		if($type == 'friend'){?>
			<div class="profile-image">
				<h3>Profile Image</h3>
				<img src="<?php echo $result_from_friend['Profile_Pic'];?>" alt="<?php echo $result_from_friend['Profile_Pic'];?>" class="img-responsive">
			</div>
			<div class="profile-image">
				<h3>Cover Image</h3>
				<img src="<?php echo $result_from_friend['Cover_Pic'];?>" alt="<?php echo $result_from_friend['Cover_Pic'];?>" class="img-responsive">
			</div>
			<div id="user-details">
				<h3><u>User Details</u>:</h3>
				<?php 
					$sql = "SELECT * from `user` where `ID` = '$id'";
					$exec_query = mysqli_query($conn,$sql);
					if(mysqli_num_rows($exec_query) > 0){
						while($details = mysqli_fetch_array($exec_query)){
							if($details['Middle_Name']){
								$name_user = $details['First_Name']." ".$details['Last_Name'];
							}
							else{
								 $name_user = $details['First_Name']." ".$details['Middle_Name']." ".$details['Last_Name'];
                            }
							echo '<b>Name:</b> '.$name_user.'<br>
							<b>Gender:</b> '.$details['Gender'].'<br>
							<b>Date of Birth:</b> '.$details['DOB'].'<br>
							<b>E-mail:</b> '.$details['Email'].'<br>
							<b>Phone:</b> '.$details['Phone'];
						}

					}
				?>
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

	$('.leave_done').click(function(event){
		event.preventDefault();
		var id = $(this).attr('group');
		var type = $(this).attr('usertype');
		var action = $(this).attr('action');
		request = $.ajax({
			url: "profile_action.php",
			method: "post",
			data: {"ID" : id, "Type" : type, "Action" : "leave-group"}
		});
		request.done(function(response,jqXHR,textStatus){
			$('#confirm-leave').modal('hide');
			console.log(response);
			window.close();
		});
		request.fail(function(jqXHR,textStatus,errorThrown){
			console.error(
	            "The following error occurred: "+
	            textStatus, errorThrown
	        );
		});
	});

	$('.make-admin').click(function(event){
		event.preventDefault();
		var id = $(this).attr('data');
		var name = $(this).attr('data-name');

		$('#admin-text').text("Are you sure, you want to make " + name + " as a group admin ?");
		$('#admin-done').attr("user",id);

	});

	$('.kick').click(function(event){
		event.preventDefault();
		var id = $(this).attr('data');
		var name = $(this).attr('data-name');

		$('#kick-text').text("Are you sure, you want to kick " + name + " from this group ?");
		$('#kick-done').attr("user",id);

	});


	$('#admin-done').click(function(event){
		event.preventDefault();
		var id = (this).attr('user');
		request = $.ajax({
			type: "post",
			url: "profile_action.php",
			data: {"ID" : id, Action: "make-admin"}
		});
		request.done(function(response,jqXHR,textStatus){
			('#kickModal').modal('hide');
			console.log(response);
			window.load();
		});
		request.fail(function(jqXHR,textStatus,errorThrown){
			console.error(
	            "The following error occurred: "+
	            textStatus, errorThrown
	        );
		});
	});


	$('#kick-done').click(function(event){
		event.preventDefault();
		var id = (this).attr('user');
		request = $.ajax({
			type: "post",
			url: "profile_action.php",
			data: {"ID" : id, Action: "kick"}
		});
		request.done(function(response,jqXHR,textStatus){
			('#kickModal').modal('hide');
			console.log(response);
			window.load();
		});
		request.fail(function(jqXHR,textStatus,errorThrown){
			console.error(
	            "The following error occurred: "+
	            textStatus, errorThrown
	        );
		});
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