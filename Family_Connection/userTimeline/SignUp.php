<?php
	include('connection.php');
?>
	
<?php
	
		$fname = $_POST['fname'];
		$mname = $_POST['mname'];
		$lname = $_POST['lname'];
		$dob = $_POST['dob'];
		$gnd = $_POST['gnd'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$pwd = $_POST['pwd'];
		
		$file_name = $_FILES['profile_pic']['name'];
		$file_type = $_FILES['profile_pic']['type'];
		$file_size = $_FILES['profile_pic']['size'];
		
		if($file_name == "")
			$profile_pic_path = "";
		else
			$profile_pic_path = "Profile/".rand(00000,99999)."_".microtime(TRUE)."_".$file_name;
		//echo $profile_pic_path;
		$fn = str_split($fname);
		
		$sql = "select * from `user` where `Email` = '$email' or `Phone` = '$phone'";
		$result = mysqli_query($conn,$sql);
		
		if(mysqli_num_rows($result) > 0){
			header('location:SignUp.php?An user with same email or phone already exists.');
			exit;
		}
		else{
			if(move_uploaded_file($_FILES['profile_pic']['tmp_name'],$profile_pic_path)){
				$sql = "insert into `user` (`Public_ID`,`First_Name`,`Middle_Name`,`Last_Name`,`DOB`,`Gender`,`Phone`,`Email`,`Password`,`Profile_Pic`) values ('','$fname','$mname','$lname','$dob','$gnd','$phone','$email','$pwd','$profile_pic_path')";
			
				if(mysqli_query($conn,$sql)){
					$last_id = mysqli_insert_id($conn);
					$pid = $fn[0].$fn[1].$last_id;
					
					$sql = "update `user` set `Public_ID` = '$pid' where `ID` = '$last_id'";
					//echo $pid.$last_id;
					if(mysqli_query($conn,$sql))
						header('location:Login.php?msg=Successfully registered. Please login!!');
					else
						header('location:SignUp.php?err=Some error has occurred');
						
				}
				else{
					die(mysqli_error($conn));
					//header('location:SignUp.php?err=Some error has occurred');
				}
				
			}
			else{
				mysqli_error($conn);
				mysqli_close($conn);
			}
		}
	
		
?>
    
<!--</body>
</html>-->