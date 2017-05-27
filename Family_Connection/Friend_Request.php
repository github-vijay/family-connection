<?php
	include 'session.php';
	include 'connection.php';
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Friend Requests</title>

<style>
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
	<div id="snackbar"></div>
	<?php
		
		$ID = $_SESSION['u_info']['ID'];
		
		$sql = "SELECT * from `friend_request` where `To_User` = '$ID' and `From_User` not in (SELECT `To_User` FROM `blocked_user` where `From_User` = '$ID') and `Status` = 0";
		
		if($result = mysqli_query($conn,$sql)){
		?>
            <table>
            	<caption>Friend Requests</caption>
                <?php
					if(mysqli_num_rows($result)>0){
						while($requests = mysqli_fetch_array($result)){
							?>
                            <tr>
                            	<td>
								<?php 
									$friend = $requests['From_User'];
									$request_ID = $requests['ID'];
									$sql = "SELECT ID,First_Name,Middle_Name,Last_Name,Profile_Pic from `user` where ID = '$friend'";
									$res = mysqli_query($conn,$sql);
									if(mysqli_num_rows($res)>0){
										$each_user = mysqli_fetch_array($res);
										echo $each_user['First_Name']." ".$each_user['Middle_Name']." ".$each_user['Last_Name'];
										?><button type="button" class="<?php echo $each_user['ID'];?>" onclick="processRequest(<?php echo $request_ID;?>,<?php echo $each_user['ID'];?>,1)">Accept</button>
                                        <button type="button" class="<?php echo $each_user['ID'];?>" onclick="processRequest(<?php echo $request_ID;?>,<?php echo $each_user['ID'];?>,2)">Reject</button>
                                        <button type="button" class="<?php echo $each_user['ID'];?>" onclick="processRequest(<?php echo $request_ID;?>,<?php echo $each_user['ID'];?>,3)">Block</button>
                                        <span id="<?php echo $request_ID;?>"></span>
									<?php }
								?>
                            	</td>
                            </tr>
                         
                        <?php	
						}
		
					}
		}
		else{
			die(mysqli_error($conn));
		}
		
	
	?>

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
</script>

</body>
</html>