<?php 
include 'connection.php';
include 'session.php';

	






?>
<?php 
//`user_image`,`user_cover_image`
$data = $_POST['data'];
	if(!isset($_SESSION['Profile_Pic']) || !isset($_SESSION['Cover_Pic'])){
		$ID = $_SESSION['u_info']['ID'];
		$exe_query=$conn->query("SELECT `$data` FROM `user` WHERE `ID`=$ID");
		if($exe_query->num_rows>0){
			while($userRow=$exe_query->fetch_assoc()){
				$imageData = $userRow[$data];
				// echo "<div>".'<img src="data:image/jpeg;base64,'.base64_encode($userRow['user_image']).'" height="50" width="50"/>'."</div>";
			}
		}
				// $my_file = 'assets/image.jpg';
				// $handle = fopen($my_file,'w') or die('Cannot open file.');
				// fwrite($handle,$image);
				// fclose($handle);
				// $uname = $_SESSION['uname'];
				// $handle = fopen($my_file,'r') or die('Cannot open file.');

				// $base64data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64data));
				// file_put_contents('assets/image.jpeg', base64_decode($base64data));
	    list($type, $imageData) = explode(';', $imageData);
	    list(,$extension) = explode('/',$type);
	    list(,$imageData)      = explode(',', $imageData);
	    $fileName = uniqid().'.'.$extension;
	    //$fileName = 'image.'.$extension;
	    $fileName = "assets/".$fileName;
	    $imageData = base64_decode($imageData);
	    file_put_contents($fileName, $imageData);
	    if(strcmp($data,'user_cover_image'))
	    	$_SESSION['coverPicPath'] = $fileName;
	    else
	    	$_SESSION['profPicPath'] = $fileName;

		echo $fileName;
	}
	else{
		if(strcmp($data,'user_cover_image'))
			echo $_SESSION['Cover_Pic'];
		else
			echo $_SESSION['profPicPath'];
	}

?>	