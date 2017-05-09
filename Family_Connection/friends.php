<?php
	include 'session.php';
	include 'connection.php';

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>

<link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
<script src="bootstrap-3.3.7-dist/js/jquery-3.2.1.min.js"></script>
<script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<style>

.no-margin{
	margin:0px;
}
.no-padding{
	padding: 0px;
}


.content form{
	background-color:	#DCDCDC;
	align: center;
}

form input.text{
	border-radius:5px;
}

.cover{
	border: 2px solid grey;
	border-radius: 2px;
}

#snackbar {
    visibility: hidden; /* Hidden by default. Visible on click */
    min-width: 250px; /* Set a default minimum width */
    margin-left: -125px; /* Divide value of min-width by 2 */
    background-color: #333; /* Black background color */
    color: #fff; /* White text color */
    text-align: center; /* Centered text */
    border-radius: 2px; /* Rounded borders */
    padding: 16px; /* Padding */
    position: fixed; /* Sit on top of the screen */
    z-index: 1; /* Add a z-index if needed */
    left: 50%; /* Center the snackbar */
    bottom: 30px; /* 30px from the bottom */
}

/* Show the snackbar when clicking on a button (class added with JavaScript) */
#snackbar.show {
    visibility: visible; /* Show the snackbar */

/* Add animation: Take 0.5 seconds to fade in and out the snackbar. 
However, delay the fade out process for 2.5 seconds */
    -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
    animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

/* Animations to fade the snackbar in and out */
@-webkit-keyframes fadein {
    from {bottom: 0; opacity: 0;} 
    to {bottom: 30px; opacity: 1;}
}

@keyframes fadein {
    from {bottom: 0; opacity: 0;}
    to {bottom: 30px; opacity: 1;}
}

@-webkit-keyframes fadeout {
    from {bottom: 30px; opacity: 1;} 
    to {bottom: 0; opacity: 0;}
}

@keyframes fadeout {
    from {bottom: 30px; opacity: 1;}
    to {bottom: 0; opacity: 0;}
}


</style>
</head>

<body>
<div class="content no-margin no-padding">
	<form method="post" id="form1" align="center">
    	<label>Phone Number:</label>
    	<input type="text" name="phone" class="phone" id="phone" placeholder="Enter the Phone number of your friend" required maxlength="10"><br><br>
        <input type="submit" value="SEARCH" name="submit">
        
    </form>
    <p id="showResult"></p>

</div>

	<?php 
		$user = $_SESSION['u_info']['ID'];
		$query = "select count(distinct `Friend_ID`) from `friends` where `User_ID` = '$user'";
		$query_result = mysqli_query($conn,$query);
		if(mysqli_num_rows($query_result)>0){
			$count_friends = mysqli_fetch_array($query_result);
		}
		else{
			$count_friends = array(0) ;
		}
		$query = "select count(distinct `From_User`) from `friend_request` where `To_User` = '$user' and `Status` = 0";
		$query_result = mysqli_query($conn,$query);
		if(mysqli_num_rows($query_result)>0){
			$count_requests = mysqli_fetch_array($query_result);
		}
		else{
			$count_requests = array(0) ;
		}
	?>
	
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

	<div class="panel panel-default">
		<a role="button" data-toggle="collapse" data-parent="#accordion" href="#friends" aria-expanded="true" aria-controls="friends" style="text-decoration:none;">
		<div class="panel-heading panel-title" role="tab" id="Friend" style="background-color:#DCDCDC;">
			<h4 class="panel-title">
				Friends &nbsp; &nbsp;   
				<span class="badge"><?php echo $count_friends[0];?></span>
			</h4>
		</div>
		</a>
		<div id="friends" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="Friend">
			<div class="panel-body" style="background-color:#E6E6FA;">
				<?php
					$sql = "SELECT * from `friends` where `User_ID` = '$user'";
					$query = mysqli_query($conn,$sql);
					if(mysqli_num_rows($query)>0){
					$i = 0;
					while($result = mysqli_fetch_array($query)){
						if ($i % 4 == 0)
						{
							?><div class="container"><?php
						}
						$friendID = $result['Friend_ID'];
						$sql_for_user = "SELECT * from `user` where `ID` = '$friendID'";
						$query_result_user = mysqli_query($conn,$sql_for_user);
						if(mysqli_num_rows($query_result_user)){
						$result_from_user = mysqli_fetch_array($query_result_user);
				?>
						<div class="col-md-3 col-sm-6">
							<div class="cover">
								<a href="#"><img src="<?php echo $result_from_user['Profile_Pic'];?>" alt="<?php echo $result_from_user['First_Name'];?>" class="img-responsive"></a>
									<div class="text">
										<?php
											echo $result_from_user['First_Name']." ".$result_from_user['Middle_Name']." ".$result_from_user['Last_Name'];
										?>
									</div>
								</a>
							</div>
						</div>
					<?php
					}
					if ($i % 4 == 3)
						{
							echo"</div><hr>";
						}

					$i++;
					}				// End of while loop
					?>
			</div>					<!-- End of container div-->
		<?php
	}				//End of if condition
	else{
		echo "No friends yet.";
	}
		?>
	  </div>
	</div>
	</div>
	
	<div class="panel panel-default">
		<a role="button" data-toggle="collapse" data-parent="#accordion" href="#requests" aria-expanded="true" aria-controls="requests" style="text-decoration:none;">
			<div class="panel-heading" role="tab" id="Request" style="background-color:#DCDCDC;">
				<h4 class="panel-title">
					Friend Requests &nbsp; &nbsp;
					<span class="badge"><?php echo $count_requests[0];?></span>
				</h4>
			</div>
		</a>
		<div id="requests" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="Request">
		  <div class="panel-body" style="background-color:#E6E6FA;">
			<div id="snackbar"></div>
			<?php
				if($count_requests[0] != 0){
					$ID = $_SESSION['u_info']['ID'];
					
					$sql = "SELECT * from `friend_request` where `To_User` = '$ID' and `From_User` not in (SELECT `To_User` FROM `blocked_user` where `From_User` = '$ID') and `Status` = 0";
					
					if($result = mysqli_query($conn,$sql)){
					
						echo "<table>";
							
							
								if(mysqli_num_rows($result)>0){
									while($requests = mysqli_fetch_array($result)){
										
										echo "<tr>";
											echo "<td>";
											
												$friend = $requests['From_User'];
												$request_ID = $requests['ID'];
												$sql = "SELECT ID,First_Name,Middle_Name,Last_Name,Profile_Pic from `user` where ID = '$friend'";
												$res = mysqli_query($conn,$sql);
												if(mysqli_num_rows($res)>0){
													$each_user = mysqli_fetch_array($res);
													echo $each_user['First_Name']." ".$each_user['Middle_Name']." ".$each_user['Last_Name'];?>
													<button type="button" class="<?php echo $each_user['ID'];?>" onclick="processRequest(<?php echo $request_ID;?>,<?php echo $each_user['ID'];?>,1)">Accept</button>
													<button type="button" class="<?php echo $each_user['ID'];?>" onclick="processRequest(<?php echo $request_ID;?>,<?php echo $each_user['ID'];?>,2)">Reject</button>
													<button type="button" class="<?php echo $each_user['ID'];?>" onclick="processRequest(<?php echo $request_ID;?>,<?php echo $each_user['ID'];?>,3)">Block</button>
													<span id="<?php echo $request_ID;?>"></span>
													<?php
												 }
											
											echo "</td>";
										echo "</tr>";
									 
									
									}     /* End of while loop */
					
								}   /* End of if condition*/
					}
					else{
						die(mysqli_error($conn));
					}
				}
				else{
					echo "No pending requests. Try finding friends from yourself."; 
				}
			?>
			</div>
		</div>
	</div>



	
</div>	


<script>
	function popSnackbar() {
    	var x = document.getElementById("snackbar");
    	x.className = "show";
    	setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
	}

	/* function for accepting, rejecting and blocking friend requests*/
	function processRequest(requestID,friendID,type){
			var xhttp; 
			xhttp = new XMLHttpRequest();
			var details = "requestID="+requestID+"&friendID="+friendID+"&type="+type;
			if(type == 1)
				var confirm_accept = confirm('Are you sure you want to accept the request ?');
			else if(type == 2)
				var confirm_reject = confirm('Are you sure you want to reject the request ?');
			else if(type == 3)
				var confirm_block = confirm('Are you sure you want to block the user ?');
			
			if(confirm_accept == true || confirm_reject == true || confirm_block == true){
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						
						var res = document.createElement('div');
						res.innerHTML = this.response;
						document.getElementById('snackbar').appendChild(res);
						popSnackbar();
						document.getElementById(requestID).style.display = "none";
					}
				};
				xhttp.open("POST", "Process_Incoming_Request.php", true);
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhttp.send(details);
			}
		
	}
	
	
	$(document).ready(function(){
		
		$("#form1").submit(function(event){
			
			event.preventDefault();
			
			var $form = $(this);

			var $inputs = $form.find("input, button, textarea, div");

			var serializedData = $form.serialize();
			
			$inputs.prop("disabled", true);
		  
			request = $.ajax({
				url: "Search_User.php?submit=yes",
				type: "post",
				data: serializedData,
				datatype: "html"
			});

			request.done(function (response, textStatus, jqXHR){
				
			   var new_messages = response;
			   document.getElementById("showResult").innerHTML = new_messages;
			   
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

	});

	
	function sendRequest(ID){
		//alert(ID);
		
		var xhttp; 
		xhttp = new XMLHttpRequest();
		var details = "ID="+ID;
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
			document.getElementById(ID).innerHTML = this.responseText;
			document.getElementById(ID).setAttribute("disabled",true)
			}
		};
		xhttp.open("POST", "Process_Request.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send(details);
	}
	
</script>
	



</body>
</html>