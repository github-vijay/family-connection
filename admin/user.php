<?php
	include("dbconnect.php"); ?>
<!doctype html>
<html>
<head>
<title>User Table</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="scripts/js/table_fixed_header.js"></script>
</head>

<body class="table-view-body">
<div class="user-table-header">User Table View</div>
<div class="container table-responsive table-container">
	<table class="table table-hover table-bordered table-striped table-fixed-header">
		<thead class="header">
			<tr>
				<th>Username</th>
				<th>User Number</th>
				<th>User Profile Image</th>
				<th>User Cover Image</th>
				<th>User Mail</th>
				<th> User DOB</th>
				<th>User Gender</th>
				<th>User Password</th>
			</tr>
		</thead>
	<?php
	$sql = "SELECT * FROM `user`";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	echo"<tr><td><a href='userData.php?user_no=".$row['user_no']."'>".$row['username']."</a></td><td>"
    .$row['user_no']."</td><td>".'<img src="data:image/jpeg;base64,'.base64_encode($row['user_image']).'" height="50" width="50"/>'."</td><td>"
    .'<img src="data:image/jpeg;base64,'.base64_encode($row['user_cover_image']).'" height="50" width="50"/>'."</td><td>".$row['user_mail']."</td><td>"
    .$row['user_dob']."</td><td>".$row['user_gender']."</td><td>".$row['upwd']."</td></tr>";
    }

   }
?>
</table>
</div>
<script language="javascript" type="text/javascript" >
    $(document).ready(function(){
      // make the header fixed on scroll
      $('.table-fixed-header').fixedHeader();
    });
  </script>
</body>
</html>
