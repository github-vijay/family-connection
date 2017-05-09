<?php
include('conn.php');
$sql = "SELECT * FROM test";
$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0){
	while($row = mysqli_fetch_assoc($result)){
		echo "<br>id: " . $row["id"] . "<br>Name: " . $row["name"];
	}
}
else
	echo "0 results";

mysqli_close($conn);
?>