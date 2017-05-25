<?php
	include('connection.php');
	include 'session.php';
?>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="setting_css.css">
  <script src="bootstrap-3.3.7-dist/js/jquery-3.2.1.min.js"></script>
  <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
</head>
<!-- Give this within head tag -->
<style type="text/css">
  .navbar{
  border-radius: 0px;
  margin-bottom: 0px;
  background-color: #f7f7f7;
}
</style>
<body>
	<nav class="navbar navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="timelineblob.php">Home</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="timelineblob.php">Timeline</a></li>
        <li><a href="#">Chat</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Notifications <span class="glyphicon glyphicon-bell"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Friend Requests<span class="badge"><?php //echo unseen friend requests ?>10</span></a></li>
            <li><a href="#">Chats<span class="badge" id="unseen_messages"><?php //echo unseen chats?>20</span></a></li>
            <li><a href="setiing.php">Setting<span class="badge" id="unseen_messages"><?php //echo unseen chats?>20</span></a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <!-- <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li> -->
        <!-- <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li> -->
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
<!--  -->
	
<div align="center" class="content">    
    <div class="chip">
    	<div class="topic">
        	<h4>Change Profile Image</h4>
        </div>
        <div class="pic">
        	<img src="<?php echo $_SESSION['u_info']['Profile_Pic'];?>" alt="<?php echo $_SESSION['u_info']['First_Name'];?>" class="img-responsive">
        </div>
        <div class="bottom">
        	<form method="POST" action="settingAction.php" enctype="multipart/form-data">
                <input type="file" name="profile_img" required>
                <input type="submit" class="btn btn-success" name="change_profile_img" value="Change">
			</form>
        </div>
    </div>
    
    <div class="chip">
    	<div class="topic">
        	<h4>Change Cover Image</h4>
        </div>
        <div class="pic">
        	<img src="<?php echo $_SESSION['u_info']['Cover_Pic'];?>" alt="<?php echo $_SESSION['u_info']['First_Name'];?>" class="img-responsive">
        </div>
        <div class="bottom">
        	<form method="POST" action="settingAction.php" enctype="multipart/form-data">
                <input type="file" name="cover_img" required>
                <input type="submit" class="btn btn-success" name="change_cover_img" value="Change">
			</form>
        </div>
    </div>


    <div class="chip">
            <div class="topic">
                <h4>Change Password</h4>
            </div>
            <div class="pic">
                <form method="post" action="settingAction.php">
                    <div class="form-group">
                        <label for="old_pwd">Old Password:*</label>
                        <input type="text" class="form-control" name="old_pwd" id="old_pwd" placeholder="Old Password" required>
                    </div>
                    <div class="form-group">
                        <label for="new_pwd">New Password:*</label>
                        <input type="text" class="form-control" name="new_pwd" id="new_pwd" placeholder="New Password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm_pwd">Confirm Password:*</label>
                        <input type="text" class="form-control" name="confirm_pwd" id="confirm_pwd" placeholder="Confirm Password" required>
                    </div>
                    </div>
                    <div class="bottom">
                        <input type="submit" class="btn btn-success" name="pwd_change" value="Change">
                    </div>
                </form>
            </div>
        </div>
    </div> 
</div>  

</body>
</html>

