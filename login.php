<?php
include('conn.php');

if($_POST["submit"]){
	$name = $_POST["name"];
	$sql = "SELECT name from test";
	$result = mysqli_query($conn,$sql);
	$flag = 0;
	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_assoc($result)){
			if(strcasecmp($row["name"], $name) == 0){
				echo "<br>".$row["name"]." = ".$name."<br>";
				$flag = 1;
				break;
			}
		}
		if($flag == 1){
			echo "User logged in successfully.";
		}
		else{
			echo "Login unsuccessfull.";
		}
	}
}

?>