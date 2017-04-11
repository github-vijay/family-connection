<?php
include('conn.php');
$sql = "UPDATE test SET name='dam' where id=2";
if(mysqli_query($conn,$sql))
	echo "Record updated successfully.<br>";
else
	echo "Error updating record".mysqli_error($conn)."<br>";
mysqli_close($conn);

?>