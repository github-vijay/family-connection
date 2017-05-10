<?php include("dbconnect.php"); ?>
<html>
<body>
	<form method="POST" action="signupaction.php">
		<table>
			<tr><td><input type="text" name="username" placeholder="Enter your Fullname"></td></tr>
			<tr><td><input type="text" name="mobile_no" placeholder="enter your mobile number"></td></tr>
			<tr><td><input type="email" name="mail" placeholder="Please enter your email"></td></tr>
			<tr><td><input type="text" name="dob" placeholder="Enter DOB in DD/MM/YYYY"></td></tr>
			<tr><td><input type="radio" name="gender" value="female">Female</td></tr>
			<tr><td><input type="radio" name="gender" value="male">Male</td></tr>
			<tr><td><input type="radio" name="gender" value="other">Other</td></tr>
			<tr><td><input type="password" name="pwd" placeholder="Enter your password"></td></tr>
			<tr><td><input type="submit" value="Signup" name="signup"></td></tr>
		</table>
	</form>


	<form method="POST" action="loginaction.php">
		<table>
			<tr><td><input type="text" name="verify_mailormob" placeholder="Please enter your mobile"></td></tr>
			<tr><td><input type="password" name="pwd" placeholder="Enter your password"></td></tr>
			<tr><td><input type="submit" value="Login" name="login"></td></tr>
		</table>
	</form>

</body>
</html>