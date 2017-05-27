<?php
	include 'dbconnect.php';

?>
<html>
<head>
<meta charset="utf-8">
<title>Record</title>
<link rel="stylesheet" type="text/css" href="css/design.css">
<style type="text/css">
thead{
	background-color:blue;
	color:white;
	width:auto;
	height:auto;
}
tbody{
		width:auto;
	height:auto;
	color:#2A0000;
}
table{
	border: 1px solid olive;
	border-radius: 10px;
	font-size: 20px;
	text-align: center;
	color: #A0A0A4;
}
</style>
</head>

<body background="image/social.jpg">
	<a href="user.php"><img src="image/previous.jpg" height="70" width="200"></a>
	<table bgcolor="#cceeff" cellpadding="5"height="auto"align="center"style="border: 1px solid olive;border-radius: 10px;margin-top:100px;">
<thead>
<tr>
<td>Upload Id</td><td>User Name</td><td>Upload Time</td><td> Status</td><td>Image</td></tr></thead>
	<?php
	$user_no=$_GET['user_no'];
	$sql = "SELECT * FROM `status_image_upload` WHERE `User_ID`='$user_no'";
	$result = mysqli_query($conn,$sql);

	if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_array($result)) {
    	$sql = "SELECT First_Name,Middle_Name,Last_Name from `user` where `ID` = '".$row['User_ID']."'"; 
    	$exec_query = mysqli_query($conn,$sql);
    	if(mysqli_num_rows($exec_query)>0){
    		$res = mysqli_fetch_array($exec_query);
    		if($res['Middle_Name'] == '')
    			$name = $res['First_Name'].' '.$res['Last_Name'];
    		else
    			$name = $res['First_Name'].' '.$res['Middle_Name'].' '.$res['Last_Name'];
    	}
    	echo"<tr><td>".$row['ID']."</a></td><td>".$name."</td><td>".date("F j, Y, g:i a", $row['Upload_Time'])."</td><td>"
    	.$row['Status']."</td><td>".'<img src="'.$row['Image'].'" height="50" width="50"/>'."</td></tr>";
    }

   }
    
?>
</body>
</html>
