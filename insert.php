<?php
include('conn.php');
$name = "lamb";
$sql = "INSERT INTO test values(5,'$name')";
if(mysqli_query($conn,$sql)){
	echo "<br>New record created successfully.";
}
else
	echo "Error : ".$sql."<br>".mysqli_error($conn);

mysqli_close($conn);
?>