<?php 
include 'session.php';
include 'connection.php';
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Chat</title>
<link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
<link rel="stylesheet" href="bootstrap-3.3.7-dist/bootstrap-multiselect-master/dist/css/bootstrap-multiselect.css">
<link rel="stylesheet" href="Chat_css.css">
<script src="bootstrap-3.3.7-dist/js/jquery-3.2.1.min.js"></script>
<script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script src="bootstrap-3.3.7-dist/bootstrap-multiselect-master/dist/js/bootstrap-multiselect.js"></script>
<link href="https://fonts.googleapis.com/css?family=Kalam:300,400,700" rel="stylesheet">
<style type="text/css">
body{
	position: relative;
	background-image: url('background5.jpg');
	background-repeat: no-repeat;
	background-size: cover;
	background-position: center;
	/*width: 100vw;*/
	height: 100vh;
	background-color: #000;
}
	#text_to_send{
		position: relative;
		overflow-y: scroll;
		font-size: 20px;
		color: #000;
	}
	input[type="submit"]{
		position: absolute;
		bottom: -35px;
		right: 16px;
		height: 35px;
	}
	#chat_messages{
		border: 1px solid #eee;
		padding: 20px;
	}
	.navbar-brand-mod{
		 font-family: 'Kalam', cursive;
		 font-weight: bold;
		 font-size: 28px;
	}
	#chat_messages span{
		max-width: 75%;
		/*border:1px solid #000;*/
		border-radius: 10px;
		padding: 6px;
		box-shadow: 1px 1px 1px #000;
    margin: 2px 0px;
    color:#000;
    position: relative;
    font-size: 16px;
		/*padding: 10px;*/
	}
	#send{
		background-color: rgba(16,7,1,0.8);
	}
	#chat_messages span.right{
		box-shadow: 1px 1px 1px #000;
		clear:both;
		float:right;
		background-color: #46f25a;
	}
	#chat_messages span.left{
    	box-shadow: -2px 2px 1px #000;
    	clear:both;
    	float:left;
    	background-color: #FF7;
	}
	#chat_messages span.right::before{
		content: '';
	    width: 0;
	    height: 0;
	    position: absolute;
	    top: 0px;
	    right: -10px;
	    border-top: 13px solid #46f25a;
	    border-left: 5px solid transparent;
	    border-right: 15px solid transparent;
	    border-bottom: 0px solid transparent;
	}
	#chat_messages span.left::before{
	    content: '';
	    width: 0;
	    height: 0;
	    position: absolute;
	    top: 0px;
	    left: -11px;
	    border-top: 13px solid #ff7;
	    border-left: 15px solid transparent;
	    border-right: 5px solid transparent;
	    border-bottom: 0px solid transparent;
	}
	/*input[type="text"]{
		
	}*/

.bigEntrance{
	animation-name: bigEntrance;
	-webkit-animation-name: bigEntrance;	

	animation-duration: 1.6s;	
	-webkit-animation-duration: 1.6s;

	animation-timing-function: ease-out;	
	-webkit-animation-timing-function: ease-out;	

	visibility: visible !important;			
}

@keyframes bigEntrance {
	0% {
		transform: scale(0.3) rotate(6deg) translateX(-30%) translateY(30%);
		opacity: 0.2;
	}
	30% {
		transform: scale(1.03) rotate(-2deg) translateX(2%) translateY(-2%);		
		opacity: 1;
	}
	45% {
		transform: scale(0.98) rotate(1deg) translateX(0%) translateY(0%);
		opacity: 1;
	}
	60% {
		transform: scale(1.01) rotate(-1deg) translateX(0%) translateY(0%);		
		opacity: 1;
	}	
	75% {
		transform: scale(0.99) rotate(1deg) translateX(0%) translateY(0%);
		opacity: 1;
	}
	90% {
		transform: scale(1.01) rotate(0deg) translateX(0%) translateY(0%);		
		opacity: 1;
	}	
	100% {
		transform: scale(1) rotate(0deg) translateX(0%) translateY(0%);
		opacity: 1;
	}		
}

@-webkit-keyframes bigEntrance {
	0% {
		-webkit-transform: scale(0.3) rotate(6deg) translateX(-30%) translateY(30%);
		opacity: 0.2;
	}
	30% {
		-webkit-transform: scale(1.03) rotate(-2deg) translateX(2%) translateY(-2%);		
		opacity: 1;
	}
	45% {
		-webkit-transform: scale(0.98) rotate(1deg) translateX(0%) translateY(0%);
		opacity: 1;
	}
	60% {
		-webkit-transform: scale(1.01) rotate(-1deg) translateX(0%) translateY(0%);		
		opacity: 1;
	}	
	75% {
		-webkit-transform: scale(0.99) rotate(1deg) translateX(0%) translateY(0%);
		opacity: 1;
	}
	90% {
		-webkit-transform: scale(1.01) rotate(0deg) translateX(0%) translateY(0%);		
		opacity: 1;
	}	
	100% {
		-webkit-transform: scale(1) rotate(0deg) translateX(0%) translateY(0%);
		opacity: 1;
	}				
}
</style>
</head>
<body>


<!-- Start of the location modal -->
<div class="modal fade" id="ask_share">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Select all those friends and groups whom you want to share your location with:</h4>
            </div>
            <div class="modal-body">
              <p style="color: red;">* Your selection will be added with the previous ones. Press `Clear Previous Selection` to clear the previous selections.</p>

                <button type="button" class="btn btn-danger" id="clear_previous">Clear Previous Selection</button><br><br>
            	Friends:
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
                <br><br>
                
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-success" id="share-location">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<!-- End of the location modal -->



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
      <a class="navbar-brand navbar-brand-mod" href="#">Family Connection</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
      	<li><a href="timeline2.php">Timeline</a></li>
        <li><a href="Chat_main.php">Chat</a></li>
        <li><a href="friends.php">Friends</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Options <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a data-toggle="modal" data-target="#group_create">Create a Group</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Settings</a></li>
            <li role="separator" class="divider"></li>
            <li><a data-toggle="modal" data-target="#ask_share">Share Your Location</a></li>
          </ul>
        </li>
        <li><a href="Logout.php"><span class="glyphicon glyphicon-log-out" style="font-size:20px;"></span>&nbsp;Logout</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div style="width:100%;height:500px;margin-top:60px;animation: bigEntrance 2s;">

<div class="container-fluid">

	<!-- Friend List -->

	<div class="panel-group col-md-6" id="accordion" role="tablist" aria-multiselectable="true">
      <div class="panel panel-default">
      	<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsefriend" aria-expanded="false" aria-controls="collapsefriend" style="text-decoration:none;">
        	<div class="panel-heading" role="tab" id="headingTwo">
          		<h3 class="panel-title">
                <?php 
					$user = $_SESSION['u_info']['ID'];
					$sql = "select count(*) as total from `friends` where `User_ID` = '$user'";
					$query = mysqli_query($conn,$sql);
					$total_result = mysqli_fetch_array($query);
				?>
              		Friends <span class="badge"><?php echo $total_result['total'];?></span>
          		</h3>
             </div>  
         </a>
        <div id="collapsefriend" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
          <div class="panel-body">
          		<ul style="list-style-type:none; padding:0px;">
        <?php
			$user = $_SESSION['u_info']['ID'];
			$sql = "SELECT * from `friends` where `User_ID` = '$user'";   // order by UNIX_TIMESTAMP('Last_Chat') DESC
			$query = mysqli_query($conn,$sql);
			if(mysqli_num_rows($query)>0){
				while($result = mysqli_fetch_array($query)){ 
					$friendID = $result['Friend_ID'];
					$sql_from_user = "SELECT `ID`,`First_Name`,`Middle_Name`,`Last_Name`,`Profile_Pic` from `user` where `ID` = '$friendID'";
					$query_from_user = mysqli_query($conn,$sql_from_user);
					$result_from_user = mysqli_fetch_array($query_from_user);
		?>
					<a id = "<?php echo $result_from_user['ID'];?>" data = "friend" info="<?php echo $result_from_user['First_Name'];?>" pic_info="<?php echo $result_from_user['Profile_Pic'];?>" style="text-decoration:none;">
                    	<li>
                        	<div class="chip">
                            	<img src="<?php echo $result_from_user['Profile_Pic'];?>" alt="<?php echo $result_from_user['First_Name']; ?>" width="70" height="70" style="border-radius:35px;">
                            	<?php if($result_from_user['Middle_Name']){
										?><span><?php	echo $result_from_user['First_Name']." ".$result_from_user['Last_Name'];?></span><?php
								}
								  	  else{
								  		?><span><?php	echo $result_from_user['First_Name']." ".$result_from_user['Middle_Name']." ".$result_from_user['Last_Name'];?> </span>
                                        <?php } ?>
                        	</div>
                    	</li>
                    </a>    
            		<hr>  								
				<?php
                }
			
			}
			else{
				echo 'No friends yet. First make some friends...';
			}
		?>
        	
        </ul>
          </div>
        </div>
      </div>
  	</div>
    
    <!-- Group List -->

    
    <div class="panel-group col-md-6" id="accordion" role="tablist" aria-multiselectable="true">
      <div class="panel panel-default">
      	<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsegroup" aria-expanded="false" aria-controls="collapsegroup" style="text-decoration:none;">
        	<div class="panel-heading" role="tab" id="headingTwo">
          		<h3 class="panel-title">
                <?php 
					
					$sql = "select count(*) as total from `group_members` where `User_ID` = '$user'";
					$query = mysqli_query($conn,$sql);
					$total_result = mysqli_fetch_array($query);
				?>
              		Groups <span class="badge"><?php echo $total_result['total'];?></span>
          		</h3>
             </div>  
         </a>
        <div id="collapsegroup" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
          <div class="panel-body">
          	
          		<ul style="list-style-type:none; padding:0px;">
        <?php
			
			$sql = "SELECT `Group_ID` from `group_members` where `User_ID` = '$user'";   // order by UNIX_TIMESTAMP('Last_Chat') DESC
			$query = mysqli_query($conn,$sql);
			if(mysqli_num_rows($query)>0){
				while($result = mysqli_fetch_array($query)){ 
					//$grp_ID = $result['Group_ID'];
					$sql_for_group = "SELECT * from `group` where `ID` = '".$result['Group_ID']."'";
					$query_from_group = mysqli_query($conn,$sql_for_group);
					$result_from_group = mysqli_fetch_array($query_from_group);
		?>
					<a id = "<?php echo $result_from_group['ID'];?>" data = "group" info="<?php echo $result_from_group['Name'];?>" pic_info="<?php echo $result_from_group['Profile_Pic'];?>" data-trigger="hover" data-toggle="popover" data-placement="bottom" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." style="text-decoration:none;">
                    	<li>
                            	<img src="<?php echo $result_from_group['Profile_Pic'];?>" alt="<?php echo $result_from_group['Name']; ?>" width="70" height="70" style="border-radius:35px;">
                            	<span class="text_name"><?php	echo $result_from_group['Name'];?></span>
                    	</li>
                    </a>    
            		<hr>  								
				<?php
                }
			
			}
			else{
				echo 'You are not a member of any group...';
			}
		?>
        	
        </ul>
        
          </div>
        </div>
      </div>
  	</div>

    
</div>

	
    <div class="col-md-offset-2 col-md-8">
    	<div id="chat_head">
        	<div class="container-fluid">
            	<img id="info_pic" src="" alt="" width="50" height="45" style="border-radius:35px;">
                &nbsp;&nbsp;<span id="info_name"></span>
                <a target="_blank" class="btn btn-primary" id="profile_info" style="float: right; margin-top: 7px;">Click here to get info</a>
            </div>
        </div>
    	<form id="form1" name="form1">
			<div id="send">
				<div name="chat_messages" id="chat_messages" disabled>
				</div>
                <div><input type="text" name="text_to_send" id="text_to_send" autocomplete="off" placeholder="Enter message here..." required="required"></div>
                <div><input class="btn btn-primary" type="submit" name="submit" value="Send"></div>
			</div>
		</form>
    </div>
    
</div>






<!-- Modal for group creation -->

<!-- Modal -->
<div class="modal fade" id="group_create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Create a Group</h4>
      </div>
      <form class="form-horizontal" method="post" id="create_grp">
      <div class="modal-body">
        	<div class="form-group">
                <label for="grp_name" class="col-sm-2 control-label">Group Name:</label>
                <div class="col-sm-10">
                  <input type="text" name="grp_name" class="form-control" id="grp_name" placeholder="Group Name" style="width:400px;height:50px" required>
                </div>
             </div>
             <div class="form-group">
             
                <label for="grp_name" class="col-sm-2 control-label">Select Members:</label>
                <div class="col-sm-10">
                
                	<select id="select_multiple_friends" name="friends[]" multiple="multiple">
                    	<?php
                        $sql = "SELECT `ID`,`First_Name`,`Middle_Name`,`Last_Name`,`Profile_Pic` from `user` where `ID` IN (SELECT `Friend_ID` from `friends` where `User_ID` = '".$_SESSION['u_info']['ID']."') ";
							$query_for_friend = mysqli_query($conn,$sql);
							if(mysqli_num_rows($query_for_friend)>0){
								
								while($result = mysqli_fetch_array($query_for_friend)){
									
									if($result['Middle_Name']){
									?>
										<option value="<?php echo $result['ID'];?>" style="background-image:url('<?php echo $result['Profile_Pic'];?>')"><?php echo ''.$result['First_Name']." ".$result['Last_Name'];?></option>
                                    <?php
									}
								  	else{
										?>
								  		<option value="<?php echo $result['ID'];?>" style="background-image:url('<?php echo $result['Profile_Pic'];?>')"><?php echo ''.$result['First_Name']." ".$result['Middle_Name']." ".$result['Last_Name'];?></option>
									<?php	
									}
								}
							}
                        ?>
                    </select>
                </div>
             </div>
             <!--<div class="form-group">
                <label for="grp_image" class="col-sm-2 control-label">Group Image:</label>
                <div class="col-sm-10">
                	<input type="file" id="grp_image" name="grp_image">
                </div>
             </div>-->
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary create_group" name="create_group">Create Group</button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- End of modal -->

<!-- Snackbar for confirmation -->
<div id="snackbar"></div>


<script>
function callAjax(){
	window.setInterval(sendAjaxReq,3000);	
}
function call_on_load(){
	document.getElementById("chat_messages").innerHTML = "<h4 style='color:#fff;'>Nothing to display. Select any friend or group to start chatting.</h4>";
	document.getElementById('text_to_send').disabled = true;
	//document.getElementById('profile_info').disabled = true;
}

function popSnackbar() {
	var x = document.getElementById("snackbar");
	x.className = "show";
	setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}

$(document).ready(function(){

	var friend_id = friends = groups = [];  // variable for storing friends id's while creating group
	var file;
	
  //$('[data-toggle="popover"]').popover();    // for toggling pop-overs

	$("#form1").submit(function(event){
	    
	    event.preventDefault();

	    var $form = $(this);

	    var $inputs = $form.find("input, button, textarea, div");

	    var serializedData = $form.serialize();

	    $inputs.prop("disabled", true);
	    request = $.ajax({
	        url: "send.php",
	        type: "post",
	        data: serializedData
	    });

	    request.done(function (response, textStatus, jqXHR){
	       var prev_messages = document.getElementById("chat_messages").innerHTML;
	       var new_messages = prev_messages+"<br>"+response;
	       document.getElementById("chat_messages").innerHTML = new_messages;
		   document.getElementById('chat_messages').scrollTop = document.getElementById('chat_messages').scrollHeight;
	       document.getElementById("text_to_send").value = null;
	    });

	    request.fail(function (jqXHR, textStatus, errorThrown){
	        console.error(
	            "The following error occurred: "+
	            textStatus, errorThrown
	        );
	    });

	    request.always(function () {
	        $inputs.prop("disabled", false);
	    });

	});
	
	
	$('.panel-body ul a').click(function(event){
		event.preventDefault();
		document.getElementById('text_to_send').disabled = false;
		//document.getElementById('profile_info').disabled = false;
		var id = $(this).attr('id');
		var type = $(this).attr('data');
		var name = $(this).attr('info');
		var pic = $(this).attr('pic_info');
		//alert(pic);
		$('#info_pic').attr('src',pic);
		$('#info_pic').attr('alt',name);
		$('#info_name').text(name);
		$("#info_name").css("font-size", "24px");

		$('#profile_info').attr("href","profile_info.php?id="+id+"&type="+type);
		
		request = $.ajax({
			type: "POST",
			url: "Fetch_Chat.php",
			contentType:"application/x-www-form-urlencoded; charset=utf-8",
			data:{"Friend_Group_ID": id, "Type": type},
			dataType:"text",		
		});
		request.done(function(response, textStatus, jqXHR){
			document.getElementById("chat_messages").innerHTML = response;
			document.getElementById('chat_messages').scrollTop = document.getElementById('chat_messages').scrollHeight;
			callAjax();
		});
		request.fail(function (jqXHR, textStatus, errorThrown){
	        console.error(
	            "The following error occurred: "+
	            textStatus, errorThrown
	        );
	    });
	});
	
	
	
	$('.group-create').click(function() {
		var grp_name = $('#grp_name').val();
		//var frnd_name = friend_id;
		//console.log(friend_id);
		request = $.ajax({
		  type: "POST",
		  url: "create_group.php",
		  data: {"Group_Name":grp_name, "Friend_ID": friend_id}
		});
		request.done(function(response, textStatus, jqXHR){
			console.log(response);
			var res = document.createElement('div');
			res.innerHTML = this.response;
			document.getElementById('snackbar').appendChild(res);
			$('#group_create').modal('hide');
			popSnackbar();
			
			
		});
		request.fail(function (jqXHR, textStatus, errorThrown){
	        console.error(
	            "The following error occurred: "+
	            textStatus, errorThrown
	        );
	    });
	
	});

	$('#share-location').click(function(event){
		event.preventDefault();
	    request = $.ajax({
	        type:"POST",
	        url:"select_friend_group_location.php",
	        data:{"friends":friends, "groups":groups}
	    });
	    request.done(function(response,textStatus,jqXHR){
	      console.log(response);
	      $('#ask_share').modal('hide');
	      window.location.href = "mapsdemo.html"
	    });
	    request.fail(function(jqXHR,textStatus,errorThrown){
	      console.error(
	        "The following error occured: "+ textStatus,errorThrown
	      );
	    });
	});

	$('#select_multiple_friends').multiselect({      //to store the variable friend_id from modal group
      includeSelectAllOption: true,
            enableFiltering: true,
    	onChange: function() {
      	friend_id = $('#select_multiple_friends').val();
      //console.log(friend_id);
    	}
  	});

	$('#all-friends').multiselect({
            //buttonContainer: '',
      includeSelectAllOption: true,
            enableFiltering: true,
      onChange: function() {
          
        friends = $('#all-friends').val();
      //console.log(friend_id);
      }
            
  });
  $('#all-groups').multiselect({
            //buttonContainer: '',
      includeSelectAllOption: true,
            enableFiltering: true,
      onChange: function() {
          
        groups = $('#all-groups').val();
      //console.log(friend_id);
      }
  });

  $('#clear_previous').click(function(){
      request = $.ajax({
        type:"post",
        url:"clear_location_record.php"
      });
      request.done(function(response,jqxhr,textStatus){
        console.log(response);
        var res = document.createElement('div');
        res.innerHTML = "Cleared previous records";
        document.getElementById('snackbar').appendChild(res);
        popSnackbar();
      });
  });
    
});

function sendAjaxReq(){
	
		request = $.ajax({
	        url: "read_json_from_file2.php",
	        type: "post"
	    });
	    request.done(function (response, textStatus, jqXHR){
	        // Log a message to the console
	       console.log("Ajax req successful!");
	       var $file_contents = response;
	       document.getElementById("chat_messages").innerHTML = $file_contents;
	    });

	    // Callback handler that will be called on failure
	    request.fail(function (jqXHR, textStatus, errorThrown){
	        // Log the error to the console
	        console.error(
	            "The following error occurred: "+
	            textStatus, errorThrown
	        );
	    });
	}
call_on_load();
</script>


</body>
</html>