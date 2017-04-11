<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$db = "test";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
// header('location:http://test2.com/homepage.php');
?>