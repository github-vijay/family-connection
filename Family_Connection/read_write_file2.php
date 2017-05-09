<?php
	include 'session.php';
?>
<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<title></title>
	<style type="text/css">
		body{
			margin : 0px;
			padding: 0px;
		}
		#send{
			float: left;
			width: 50%;
			height:400px;
			background-color: red;
		}
		#chat_messages{
			font-size: 25px;	
			height: 400px;
			width: 100%;
			overflow-y: scroll;
		}
		#receiver{
			float: left;
			width: 50%;
			height:500px;
		}
		#send div:nth-child(1){
			height: 400px;
			/*border:1px solid green;*/
		}
		#send div:nth-child(2){
			height: 85px;
			text-align: center;
			padding: 0px;
		}
		input[type="text"]{
			width:100%;
			height:400px;
			font-size: 25px;
		}
		textarea{
			font-size: 25px;	
		}
		#send div:nth-child(2) input{
			width:100%;
			height:80px;
		}

		#receiver div:nth-child(1){
			height: 400px;
			/*border:1px solid green;*/
		}
		#receiver div:nth-child(2){
			height: 98px;
			border:1px solid #000;
			text-align: center;
			font-size: 70px;
			background-color: #ccc;
		}
		#receiver div:nth-child(1) textarea{
			width:100%;
			height:400px;
		}
		#receiver div:nth-child(2) button{
			width:100%;
			height:80px;
		}
	</style>
</head>
<body>
<form id="form1" name="form1">
	<div id="send">
		<div name="chat_messages" id="chat_messages" disabled>
			<?php
				include('read_json_from_file.php');
			?>
		</div>
		<div><input type="text" name="text_to_send" id="text_to_send"></div>
		<div><input type="submit" name="submit" value="submit"></div>
	</div>
</form>
	<div id="receiver">
		<div>
			<!-- <textarea name="" id="receive_textarea"></textarea> -->
		</div>
		<div>
			<button>Receive</button>
		</div>
	</div>
    
<a href="Logout.php"><button type="button" name="logout">Logout</button></a>

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
</body>
</html>