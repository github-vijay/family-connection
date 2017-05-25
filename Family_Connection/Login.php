<?php 
	session_start();
	include 'connection.php';
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login</title>
<link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Kalam:300,400,700" rel="stylesheet">
<style>
body{
  background-image: url('background3_2.jpg');
  background-repeat: no-repeat;
  background-size: cover;
  width: 100vw;
  height: 100vh;
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


#image{
  width: auto;
  height: 200px;
  margin: 50px auto 0px;
  border: 1px solid #000; 
  background-image: url('Finger_Family.jpg');
  background-size: contain;
  background-repeat: no-repeat;
}

.jumbotron-mod{
  background-color: transparent;
  text-align: center;
  color: #375169;
  animation-name: fadein;
    animation-delay: .05s;
  animation-duration: 2s;
  font-family: 'Kalam', cursive;
font-weight : 700;
}

.jumbotron-mod h1{
  font-weight: bold;
  font-size: 70px;
}

#btn-sign-in{
  width: 100%;
}
#form-container{
  width: 600px;
  padding: 50px;
  margin: -30px auto 0;
  border: 3px groove #000;
  background-color: rgba(50, 50, 50, 0.6);
  animation-name: fadein;
  animation-duration: 2s;
}

.no-padding{
  padding: 0px;
}

.modal-header,.modal-footer{
  background-color: #fed130;
}

.modal-body{
  background-color: transparent;
}

@media only screen and (max-width: 768px){
  #form-container{
    width: 400px;
  }
}

</style>


</head>

<body>
<div class="jumbotron jumbotron-mod">
  <h1>Family Connection</h1>
</div>
<div class="">
  <div id="form-container">
    <form class="form-horizontal" method="post" action="Login_Code.php">
      <div class="form-group">
        <!-- <label for="Email" class="col-sm-2 control-label">E-mail*</label> -->
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
          <input type="email" name="email" class="form-control input-lg" id="Email" placeholder="Email" required>
        </div>
      </div>
      <div class="form-group">
        <!-- <label for="password" class="col-sm-2 control-label">Password*</label> -->
        <div class="input-group" >
          <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
          <input type="password" name="pwd" class="form-control input-lg" id="password" placeholder="Password" required>
        </div>
      </div>
      <div class="form-group">
        <div class="no-padding">
          <button id="btn-sign-in" type="submit" class="btn btn-success btn-lg">SIGN IN</button><br><br>
          <span class="col-sm-offset-2" style="color: #fff;margin-top: 20px;">New to Family-Connection ?</span> &nbsp; &nbsp;<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">SIGN UP</button>
        </div>
      </div>
    </form>
    </div>
</div>

    <!-- Large modal -->


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

<?php
// if(isset($_GET['msg']))
// {	

// 	echo $_GET['msg'];

// }
?>    
       
<script src="bootstrap-3.3.7-dist/js/jquery-3.2.1.min.js"></script>
<script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

</body>
</html>