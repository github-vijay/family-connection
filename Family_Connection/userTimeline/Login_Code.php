<?php
session_start();
include 'connection.php';
		
			$uname = $_POST['email'];
			$pwd = $_POST['pwd'];
			
			$sql = "select * from `user` where `Email` = '$uname' and `Password` = '$pwd'";
			$result = mysqli_query($conn,$sql);
			
			if(mysqli_num_rows($result) > 0){
				$user = mysqli_fetch_array($result);
				$_SESSION['u_info'] = $user;
				//echo $_SESSION['u_info']['Email'];
				$date = date("Y-m-d h:i:s");
				
				$id = $_SESSION['u_info']['ID'];
				
				$sql = "select `Friend_ID` from `friends` where User_ID = '$id'";
				$query = mysqli_query($conn,$sql);
				if(mysqli_num_rows($query)>0){
					$i = 0;
					while($result = mysqli_fetch_array($query)){
						$_SESSION['friends'][$i] = $result['Friend_ID'];
						$i++;
					}
				}
				
				$sql = "update `user` set `Last_Seen` = '$date' where `ID` = '$id'";
				
				if(mysqli_query($conn,$sql))
					header('location:timeline2.php?msg=Logged In Successfully!!');
				else
					die(mysqli_error($conn));
					
				mysqli_close($conn);
				exit;
			}
			else
				header('location:Login.php?err=Username or Password incorrect');
		
			
	?>