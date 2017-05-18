<?php 
	session_start();
	include 'connection.php';
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

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
<?php
if(isset($_GET['msg']))
{	

	echo $_GET['msg'];

}
?>
<div class="container">
	<div class="col-sm-offset-2 col-sm-7">
    <form class="form-horizontal" method="post" action="Login_Code.php">
      <div class="form-group">
        <label for="Email" class="col-sm-2 control-label">E-mail*</label>
        <div class="col-sm-10">
          <input type="email" name="email" class="form-control" id="Email" placeholder="Email" required>
        </div>
      </div>
      <div class="form-group">
        <label for="password" class="col-sm-2 control-label">Password*</label>
        <div class="col-sm-10">
          <input type="password" name="pwd" class="form-control" id="password" placeholder="Password" required>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-4 col-sm-10">
          <button type="submit" class="btn btn-success">SIGN IN</button>
          <span class="col-sm-offset-1"></span>
          <button type="reset" class="btn btn-primary">RESET </button>
        </div>
      </div>
    </form>
    </div>
</div>

	<!--<form method="post">
    	<label>Username</label>
    	<input type="texelt" name="uname"><br>
        <label>Password</label>
        <input type="password" name="pwd"><br>
        <input type="submit" name="Submit">
        <input type="reset" name="Reset">
    </form>-->
    
    <!-- Large modal -->
<span class="col-sm-offset-4">New to Family-Connection ?</span> &nbsp; &nbsp;<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">SIGN UP</button>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Sign Up</h4>
      </div>
      <div class="modal-body">
          <div class="container">
            <div class="col-sm-offset-1 col-sm-7">
            <form class="form-horizontal" method="post" action="SignUp.php" enctype="multipart/form-data">
              <div class="form-group">
              	<label for="fname" class="col-sm-2 control-label">FirstName:*</label>
                <div class="col-sm-10">
                	<input type="text" name="fname" class="form-control" id="fname" placeholder="First Name" required>
                </div>
              </div>
              <div class="form-group">
              	<label for="mname" class="col-sm-2 control-label">MiddleName:*</label>
                <div class="col-sm-10">
                	<input type="text" name="mname" class="form-control" id="mname" placeholder="Middle Name">
                </div>
              </div>
              <div class="form-group">
              	<label for="lname" class="col-sm-2 control-label">LastName:*</label>
                <div class="col-sm-10">
                	<input type="text" name="lname" class="form-control" id="lname" placeholder="Last Name">
                </div>
              </div>
              <div class="form-group">
              	<label for="dob" class="col-sm-2 control-label">DOB:*</label>
                <div class="col-sm-10">
                	<input type="date" name="dob" class="form-control" id="dob" placeholder="DOB" required>
                </div>
              </div>
              <div class="form-group">
              	<label for="dob" class="col-sm-2 control-label">Gender:*</label>
                <div class="col-sm-10">
                	<input type="radio" name="gnd" value="M">Male&nbsp;&nbsp;
        			<input type="radio" name="gnd" value="F">Female
                </div>
              </div>
              <div class="form-group">
              	<label for="phone" class="col-sm-2 control-label">Phone:*</label>
                <div class="col-sm-10">
                	<input type="text" name="phone" class="form-control" id="phone" placeholder="Phone" maxlength="10" required>
                </div>
              </div>
              <div class="form-group">
                <label for="Email" class="col-sm-2 control-label">E-mail:*</label>
                <div class="col-sm-10">
                  <input type="email" name="email" class="form-control" id="Email" placeholder="Email" required>
                </div>
              </div>
              <div class="form-group">
                <label for="password" class="col-sm-2 control-label">Password*</label>
                <div class="col-sm-10">
                  <input type="password" name="pwd" class="form-control" id="password" placeholder="Password" required>
                </div>
              </div>
              <div class="form-group">
                <label for="profile_pic" class="col-sm-2 control-label">Profile_Picture*</label>
                <div class="col-sm-10">
                  <input type="file" name="profile_pic" class="form-control" id="profile_pic">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-4 col-sm-10">
                  <button type="submit" class="btn btn-success">SIGN IN</button>
                  <span class="col-sm-offset-1"></span>
                  <button type="reset" class="btn btn-primary">RESET </button>
                </div>
              </div>
            </form>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
    
    
    
<!-- Snackbar for the confirmation-->
<div id="snackbar"></div>

    
    
<script>

	function popSnackbar(msg) {
		var res = document.createElement('div');
		res.innerHTML = msg;
		document.getElementById('snackbar').appendChild(res);
    	var x = document.getElementById("snackbar");
    	x.className = "show";
    	setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
	}

</script>    
    
    
    
    
<script src="assets/bootstrap/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>