<?php 
	include("dbconnect.php");
	if(isset($_POST['upload_status'])){
		$userStatus=$_POST['user_status'];
		//$userImage=addslashes(file_get_contents($_FILES['pic']['tmp_name']));
		$umob=$_SESSION['usermobile'];

		$sql4status="INSERT INTO `status_record`(`user_mob_number`,`upload_time`,`status`)VALUES ('$umob',NOW(),'$userStatus')";
		
		$res4status=mysqli_query($conn,$sql4status);
		
		if ($res4status) 
			echo (" status updated ");
		else
			die("".mysqli_error($conn));
	}
?>


<?php
	$res=mysqli_query($conn,"SELECT * FROM `status_image_upload`");?>
   <table>
   	<?php while($row=mysqli_fetch_array($conn,$res)){ ?>
   		<tr><td type="hidden"> <?php $row['upload_id']; ?></td></tr>
   		<tr><td type="hidden"> <?php $row['user_mob_number']; ?></td></tr>
   		<tr><td type="hidden"> <?php $row['upload_time']; ?></td></tr>
   		<tr><td> <?php echo $row['status']; ?></td></tr>
   		<tr><td> <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'" height="200" width="200"/>'; ?></td></tr>
   <?php }
   
   
   echo "</table>";?>

   <!--<?php
	$res=mysqli_query($conn,"SELECT * FROM `status_image_upload`");?>
   <table>
   	<?php while($row=mysqli_fetch_array($conn,$res)){ ?>
   		<tr><td type="hidden"> <?php $row['upload_id']; ?></td></tr>
   		<tr><td type="hidden"> <?php $row['user_mob_number']; ?></td></tr>
   		<tr><td type="hidden"> <?php $row['upload_time']; ?></td></tr>
   		<tr><td> <?php echo $row['status']; ?></td></tr>
   		<tr><td> <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'" height="200" width="200"/>'; ?></td></tr>
   <?php }
   
   
   echo "</table>";?>-->



   <?php
  $sql = "SELECT `status`,`image_path` FROM `status_image_upload`";
$result = $conn->query($sql);
echo "<table>";
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) { ?>
        <tr><td><?php echo $row["status"]; ?></td></tr>
       <tr><td><img src= <?php $row['image_path'] ?> height="150px" width="300px">'; </td></tr>
   <?php
    }
} 
echo "</table>";
else {
    echo "0 results";
}
$conn->close();
?>





  <?php while($row=mysqli_fetch_array($conn,$res)){ ?>
      <tr><td type="hidden"> <?php $row['upload_id']; ?></td></tr>
      <tr><td type="hidden"> <?php $row['user_mob_number']; ?></td></tr>
      <tr><td type="hidden"> <?php $row['upload_time']; ?></td></tr>
      <tr><td> <?php echo $row['status']; ?></td></tr>
      <tr><td> <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'" height="200" width="200"/>'; ?></td></tr>
   <?php }
   
   
   echo "</table>";?>



   function like(){
          $sql4like="SELECT * FROM `like_record` WHERE `uploadid_for_like`='".$row['upload_id']."'";
          $result4like=$conn->query($sql4like);

          if($result4like->num_rows>0){
            while($row4like=$result4like->fetch_assoc()){
              if($row4like['user_mob_number']==$_SESSION['umobile']);
                echo "you are already liked it...";
              else{
                $insertInLike="INSERT INTO `like_record` (`uploadid_for_like`,`user_mob_number`)VALUES ('".$row['upload_id']."','".$_SESSION['umobile'])."')";
              $res4likeInsert=mysqli_query($conn,$insertInLike);
              if($res4likeInsert)
                echo "Liked";
              else
                die(" ".mysqli_error($conn));
              }
            }
          }
        }
        echo "<tr><td><input type='submit' name='like' onClick='like()'value='Like'> </tr></td>";
        

    



		
