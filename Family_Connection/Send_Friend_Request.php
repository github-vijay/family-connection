<?php
	include 'session.php';
	include 'connection.php';
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Search Friends</title>
<link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">

<script src="bootstrap-3.3.7-dist/js/jquery-3.2.1.min.js"></script>
<script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>


</head>

<body>


	<form method="post" id="form1">
    	<label>Phone Number:</label>
    	<input type="text" name="phone" class="phone" id="phone" placeholder="Enter the Phone number of your friend" required maxlength="10"><br><br>
        <input type="submit" value="SEARCH" name="submit">&nbsp; &nbsp;
        
    </form>
    <p id="showResult"></p>
    
    
    <!-- Single button
<div class="btn-group">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
    Action <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
    <li><a href="#">Action</a></li>
    <li><a href="#">Another action</a></li>
    <li><a href="#">Something else here</a></li>
    <li role="separator" class="divider"></li>
    <li><a href="#">Separated link</a></li>
  </ul>
</div> -->
    
    
    
    
<script>
	
		$(document).ready(function(){
	// Bind to the submit event of our form
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