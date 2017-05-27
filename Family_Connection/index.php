<?php

	include 'session.php';
	include 'connection.php';
	
?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Homepage</title>
<link rel="stylesheet" type="text/css" href="homestyle.css">
<link rel="stylesheet" type="text/css" href="bootstrap-3.3.7-dist/css/bootstrap.css">

</head>

<body>
<div class="banner">
	<div class="container">
    	<span align="center">Family Connection</span>
	</div>
</div>


<nav class="navbar navbar-default navbar-static-top" style="margin:0px;">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="index.php" >
        <div class="chip">
            <img src="<?php echo $_SESSION['u_info']['Profile_Pic']?>" alt="<?php echo $_SESSION['u_info']['First_Name']?>" width="96" height="96">
            <?php echo $_SESSION['u_info']['First_Name']." ".$_SESSION['u_info']['Last_Name'];?>
		</div>
      </a>	<!-- Use here name of the User with his profile pic-->
      
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">.... <!--<span class="caret"></span>--></a>
          <ul class="dropdown-menu">
            <li><a href="#">Blocked Contacts</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Update Status</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Create new group</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Settings</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="container-fluid">
    <div class="row">
        <ul class="nav nav-tabs">
            <li role="presentation" class="col-sm-4" align="center"><a href="#" id="timeline">Timeline</a></li>
            <li role="presentation" class="col-sm-4" align="center"><a href="#" id="chat">Chat</a></li>
            <li role="presentation" class="col-sm-4" align="center"><a href="#" id="friends">Friends</a></li>
        </ul>
    </div>
</div>

<div class="container-fluid">
    <div id="content">
    
    	
    
    </div>
</div>

<footer></footer>

<script src="bootstrap-3.3.7-dist/js/jquery-3.2.1.min.js"></script>
<script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

<script>
	
	$(document).ready(function(){
	// Bind to the submit event of our form
	$("#timeline").click(function(event){
	    // Prevent default posting of form - put here to work in case of errors
	    event.preventDefault();

	     //Abort any pending request
	     //if (request) {
//	         request.abort();
//	     }
	    // setup some local variables
	    //var $form = $(this);

	    // Let's select and cache all the fields
	    //var $inputs = $form.find("input, button, textarea, div");

	    // Serialize the data in the form
	    //var serializedData = $form.serialize();

	    // Let's disable the inputs for the duration of the Ajax request.
	    // Note: we disable elements AFTER the form data has been serialized.
	    // Disabled form elements will not be serialized.
	    //$inputs.prop("disabled", true);
	    // Fire off the request to /form.php
	    request = $.ajax({
	        url: "timeline.php",
	        type: "post",
	        //data: serializedData
	    });

	    // Callback handler that will be called on success
	    request.done(function (response, textStatus, jqXHR){
	        // Log a message to the console
	       //var prev_messages = document.getElementById("chat_messages").innerHTML;
	       //var new_messages = prev_messages+"<br/>"+response;
	       document.getElementById("content").innerHTML = response;
	       //document.getElementById("text_to_send").value = "";
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
	
	$("#chat").click(function(event){
	    // Prevent default posting of form - put here to work in case of errors
	    event.preventDefault();

	     //Abort any pending request
	     //if (request) {
//	         request.abort();
//	     }
	    // setup some local variables
	    //var $form = $(this);

	    // Let's select and cache all the fields
	    //var $inputs = $form.find("input, button, textarea, div");

	    // Serialize the data in the form
	    //var serializedData = $form.serialize();

	    // Let's disable the inputs for the duration of the Ajax request.
	    // Note: we disable elements AFTER the form data has been serialized.
	    // Disabled form elements will not be serialized.
	    //$inputs.prop("disabled", true);
	    // Fire off the request to /form.php
	    request = $.ajax({
	        url: "chat.php",
	        type: "post",
	        //data: serializedData
	    });

	    // Callback handler that will be called on success
	    request.done(function (response, textStatus, jqXHR){
	        // Log a message to the console
	       //var prev_messages = document.getElementById("chat_messages").innerHTML;
	       //var new_messages = prev_messages+"<br/>"+response;
	       document.getElementById("content").innerHTML = response;
	       //document.getElementById("text_to_send").value = "";
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
	
	$("#friends").click(function(event){
	    // Prevent default posting of form - put here to work in case of errors
	    event.preventDefault();

	    // Abort any pending request
	     if (request) {
	       request.abort();
	     }
	    // setup some local variables
	    //var $form = $(this);
//
	    // Let's select and cache all the fields
	    //var $inputs = $form.find("input, button, textarea, div");

	    // Serialize the data in the form
	    //var serializedData = $form.serialize();

	    // Let's disable the inputs for the duration of the Ajax request.
	    // Note: we disable elements AFTER the form data has been serialized.
	    // Disabled form elements will not be serialized.
	    //$inputs.prop("disabled", true);
	    // Fire off the request to /form.php
	    request = $.ajax({
	        url: "friends.php",
	        type: "post",
	        //data: serializedData
	    });

	    // Callback handler that will be called on success
	    request.done(function (response, textStatus, jqXHR){
	        // Log a message to the console
	       //var prev_messages = document.getElementById("chat_messages").innerHTML;
	       //var new_messages = prev_messages+"<br/>"+response;
	       document.getElementById("content").innerHTML = response;
	       //document.getElementById("text_to_send").value = "";
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
