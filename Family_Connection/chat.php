<?php 
include 'session.php';
include 'connection.php';
?>

<head>
<link href="chatdesign.css" rel="stylesheet">
<link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div id="chat">

	<!-- nav sidebar for showing friends and group list-->
    <div id="main">
    <nav>
    
    	<ul>
        <?php
			$user = $_SESSION['u_info']['ID'];
			$sql = "SELECT * from `friends` where `User_ID` = '$user' order by UNIX_TIMESTAMP('Last_Chat') DESC";
			$query = mysqli_query($conn,$sql);
			if(mysqli_num_rows($query)>0){
				while($result = mysqli_fetch_array($query)){ 
				$friendID = $result['Friend_ID'];
				$sql_from_user = "SELECT ID,First_Name,Middle_Name,Last_Name,Profile_Pic from `user` where `Friend_ID` = '$friendID'";
				$result_from_user = mysqli_fetch_array($sql_from_user);
				
		?>
					<li>
                        <div class="chip">
                            <img src="<?php echo $result_from_user['$result_from_user'];?>" alt="<?php echo $result_from_user['First_Name']; ?>" width="96" height="96">
                            <?php if($result_from_user['Middle_Name'])
										echo $result_from_user['First_Name']." ".$result_from_user['Last_Name']; 
								  else
								  		echo $result_from_user['First_Name']." ".$result_from_user['Middle_Name']." ".$result_from_user['Last_Name'];
							?>
                        </div>
                    <img src="" alt="">Friend 1
                    </li>     <!-- If friends pic is inserted then add the src path-->
            		<hr>  								<!-- Use php loop to fill up the friends and group list-->
				<?php
                }
			
			}
		?>
        	<li><img src="">Friend 1</li>     <!-- If friends pic is inserted then add the src path-->
            <hr>  								<!-- Use php loop to fill up the friends and group list-->
            <li>Friend 2</li>
        </ul>
    
    </nav>
    
    <!-- End of nav sidebar -->
    
    <!-- Section for Chatting -->
    
    <section>
    <div id="chatarea">
        <div name="chat_messages" id="chat_messages" disabled>
            <?php
                include('read_json_from_file.php');
            ?>
        </div>
    </div>
    <div id="chatbox">
        <form id="form1" name="form1" style="margin: 0; padding: 0; display:inline!important;">
            <div id="send">
                <input type="text" name="text_to_send" id="text_to_send">
                <input type="submit" class="btn btn-success" name="submit" value="submit">
            </div>
        </form>
    </div>
    </section>
    
    
    <!-- End of section-->

</div>
</div>

<script>
$(document).ready(function(){
	// Bind to the submit event of our form
	$("#form1").submit(function(event){
	    // Prevent default posting of form - put here to work in case of errors
	    event.preventDefault();

	    // Abort any pending request
	    // if (request) {
	    //     request.abort();
	    // }
	    // setup some local variables
	    var $form = $(this);

	    // Let's select and cache all the fields
	    var $inputs = $form.find("input, button, textarea, div");

	    // Serialize the data in the form
	    var serializedData = $form.serialize();

	    // Let's disable the inputs for the duration of the Ajax request.
	    // Note: we disable elements AFTER the form data has been serialized.
	    // Disabled form elements will not be serialized.
	    $inputs.prop("disabled", true);
	    // Fire off the request to /form.php
	    request = $.ajax({
	        url: "send.php?submit=yes",
	        type: "post",
	        data: serializedData
	    });

	    // Callback handler that will be called on success
	    request.done(function (response, textStatus, jqXHR){
	        // Log a message to the console
	       var prev_messages = document.getElementById("chat_messages").innerHTML;
	       var new_messages = prev_messages+"<br/>"+response;
	       document.getElementById("chat_messages").innerHTML = new_messages;
	       document.getElementById("text_to_send").value = "";
	    });

	    // Callback handler that will be called on failure
	    request.fail(function (jqXHR, textStatus, errorThrown){
	        // Log the error to the console
	        console.error(
	            "The following error occurred: "+
	            textStatus, errorThrown
	        );
	    });

	    // Callback handler that will be called regardless
	    // if the request failed or succeeded
	    request.always(function () {
	        // Reenable the inputs
	        $inputs.prop("disabled", false);
	    });

	});
});

</script>
<script src="bootstrap-3.3.7-dist/js/jquery-3.2.1.min.js"></script>
<script src="bootstrap-3.3.7-dist/js/jquery-3.2.1.min.js"></script>
</body>