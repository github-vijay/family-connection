<?php
	include("dbconnect.php"); 
?>
<html>
<head>
<title>User Table View</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="scripts/js/table_fixed_header.js"></script>
</head>
<body class="table-view-body">
<div class="user-table-header">
	<a href="user.php"><div class="btn btn-default" style="position: absolute;left: 10px;top: 30%;">Go Back</div></a>
	User Table View
</div>
<div class="container table-responsive table-container">
	<table id="mytable1" class="table table-hover table-bordered table-striped table-fixed-header">
		<thead class="header">
			<tr>
				<th>Upload Id</th>
				<th>User Name</th>
				<th>Upload Time</th>
				<th>Status</th>
				<th>Image</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$user_no=$_GET['user_no'];
				$sql = "SELECT * FROM `status_image_upload` WHERE `user_mob_number`='$user_no'";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
		    	// output data of each row
		    		while($row = $result->fetch_assoc()) {
		    			echo"<tr><td>".$row['upload_id']."</a></td><td>".$row['user_name']."</td><td>".$row['upload_time']."</td><td>"
		    	.$row['status']."</td><td>".'<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'" height="50" width="50"/>'."</td></tr>";
		    		}

		   		}
			?>
		</tbody>
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
