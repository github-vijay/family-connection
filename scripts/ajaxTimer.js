function sendAjaxReq(){
		// var xmlHttp = new XMLHttpRequest();
		// xmlHttp.open("POST","http://localhost/test2/read_json_from_file2.php",true);
		// xmlHttp.send();
		// xmlHttp.onreadystatechange = function(){
		// 	if(this.readyState == 4 && this.status == 200){
		// 		console.log("Ajax req successful!");
		// 		var $file_contents = this.responseText;
		// 		//$str = $file_contents.split("+,+");
		// 		document.getElementById("chat_messages").innerHTML = $file_contents;
		// 	}
		// };		

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