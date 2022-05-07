<?php
	include 'dbConnection.php';

if($_GET['q']==2){
echo'
<form method="post" action="sign.php?q=1" enctype="multipart/form-data">
    <p>Add Signature :</p> 
    <input type="file" name="Filename" placeholder="Select your File">
    <input TYPE="submit" name="upload" value="Submit"/>
</form>';
}else
if($_GET['q']==1)
{
		session_start();

	$fileName = $_FILES['Filename']['name'];
			 		$uid=$_SESSION["id"];
	 
		$target = "sign/";		
		$fileTarget = $target.$fileName;	
		$tempFileName = $_FILES["Filename"]["tmp_name"];	
		$result = move_uploaded_file($tempFileName,$fileTarget);
	
		if($result) { 
			$qq=mysqli_query($con,"UPDATE `user` SET `sign`='$fileName' WHERE uid='$uid'");	
			header("location:dashboard.php?q=1");
	
		}
		else {			
			echo "Sorry !!! There was an error in uploading your file";			
		}

}
	
?>