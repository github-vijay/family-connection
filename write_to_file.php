<?php
//Had to give permission chmod 777 people.txt
$file = 'people.txt';
// The new person to add to the file
$person = "\nSallu";
// Write the contents to the file, 
// using the FILE_APPEND flag to append the content to the end of the file
// and the LOCK_EX flag to prevent anyone else writing to the file at the same time
if(file_put_contents($file, $person, FILE_APPEND | LOCK_EX))
	echo "Success";
else
	echo "Failure";
?>