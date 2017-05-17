<?php
	include('connection.php');
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sign Up</title>
</head>

<body>

	<form method="post">
    	<label>Firstname:</label>
    	<input type="text" name="fname"><br>
        
        <label>Middlename:</label>
        <input type="text" name="mname"><br>
        
        <label>Lastname:</label>
        <input type="text" name="lname"><br>
        
        <label>Date of birth:</label>
        <input type="date" name="dob"><br>
        
        <label>Gender:</label>
        <input type="radio" name="gnd" value="M">Male&nbsp;&nbsp;
        <input type="radio" name="gnd" value="F">Female&nbsp;&nbsp;<br>
        
        <label>E-Mail:</label>
        <input type="email" name="email"><br>
        
        <label>Password</label>
        <input type="password" name="pwd"><br>
        
        <input type="submit" name="Submit">&nbsp;&nbsp;
        <input type="reset" name="Reset">
    
    </form>
	
    <?php
		if(isset($_POST['Submit'])){
			$fname = $_POST['fname'];
			$mname = $_POST['mname'];
			$lname = $_POST['lname'];
			$dob = $_POST['dob'];
			$gnd = $_POST['gnd'];
			$email = $_POST['email'];
			$pwd = $_POST['pwd'];
			
			$fn = str_split($fname);
			
			$sql = "select * from `user` where `Email` = '.$email.'";
			$result = mysqli_query($conn,$sql);
			
			if(mysqli_num_rows($result) > 0){
				header('location:SignUp.php?An user with same email already exists.');
				exit;
			}
			else{
				$sql = "insert into `user` (`Public_ID`,`Fname`,`Mname`,`Lname`,`DOB`,`Gender`,`Email`,`Password`) values ('','$fname','$mname','$lname','$dob','$gnd','$email','$pwd')";
				
				if(mysqli_query($conn,$sql)){
					$last_id = mysqli_insert_id($conn);
					$pid = $fn[0].$fn[1].$last_id;
					
					$sql = "update `user` set `Public_ID` = '$pid' where `ID` = '$last_id'";
					//echo $pid.$last_id;
					if(mysqli_query($conn,$sql))
						header('location:login.php?msg=Successfully registered. Please login!!');
					else
						header('location:signUp.php?err=Some error has occurred');

					//$sql = "UPDATE `location` SET latitude=0,longitude=0 where user_id=last_id";
					//insert default values into location table when user signs up
						
				}
				else
					header('location:signUp.php?err=Some error has occurred');
					
				mysqli_close($conn);
			}
		}
			
	?>
    
</body>
</html>