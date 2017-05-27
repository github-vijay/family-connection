<?php
	include("dbconnect.php"); ?>
<!doctype html>
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
	<a href="index.php"><img src="image/previous.jpg" height="70" width="200"></a>
	<table bgcolor="#cceeff" cellpadding="5"height="auto"align="center"style="border: 1px solid olive;border-radius: 10px;margin-top:100px;">
<thead>
<tr>
	<td>Username</td><td>User Number</td><td>User Profile Image</td><td>User Cover Image</td><td>User Mail</td><td> User DOB</td><td>User Gender</td></tr></thead>
	<?php
	$sql = "SELECT * FROM `user`";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	if($row['Middle_Name'] == '')
    		$name = $row['First_Name'].' '.$row['Last_Name'];
    	else
    		$name = $row['First_Name'].' '.$row['Middle_Name'].' '.$row['Last_Name'];
    	
    	echo "<tr><td><a href='userData.php?user_no=".$row['ID']."'>".$name."</a></td><td>"
    .$row['Phone']."</td><td>".'<img src="'.$row['Profile_Pic'].'" height="50" width="50"/>'."</td><td>"
    .'<img src="'.$row['Cover_Pic'].'" height="50" width="50"/>'."</td><td>".$row['Email']."</td><td>"
    .$row['DOB']."</td><td>".$row['Gender']."</td></tr>";
    }

   }
    
?>
</table>
</body>
</html>
