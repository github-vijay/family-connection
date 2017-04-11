<?php
include('conn.php');

$sql = "DELETE FROM test WHERE id=2";
if(mysqli_query($conn,$sql))
	echo "Record deleted successfully.";
else
	echo "Error : ".mysqli_error($conn);
mysqli_close($conn);
?>