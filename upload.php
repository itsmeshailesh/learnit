<?php
	include 'dbConnection.php';
	$fileExistsFlag = 0; 
	$fileName = $_FILES['Filename']['name'];
	$c=$_POST['c'];
	$n=$_POST['lecname'];
	$result1=mysqli_query($con,"SELECT * FROM course where cid='$c'");
	$row8=mysqli_fetch_array($result1);

	/*	Checking whether the file already exists in the destination folder 
	
	$query = "SELECT llink FROM lec WHERE llink='$fileName'";	
	$result = mysqli_query($con,$query);
	while($row = mysqli_fetch_array($result)) {
		if($row['llink'] == $fileName) {
			$fileExistsFlag = 1;
		}		
	}*/
	/*
	* 	If file is not present in the destination folder
	*/
	if($fileExistsFlag == 0) { 
		$target = "lectures/";
		$fileName='c'.$c.'-l'.($row8['leccnt']+1).'.mp4';		
		$fileTarget = $target.$fileName;	
		$tempFileName = $_FILES["Filename"]["tmp_name"];	
		$result = move_uploaded_file($tempFileName,$fileTarget);
		/*
		*	If file was successfully uploaded in the destination folder
		*/
		if($result) { 
			echo 'Your file <html><b><i>'.$n.'('.$fileName.')</i></b></html> has been successfully uploaded';		
			$query = "INSERT INTO lec(lid,cid,lname,llink) VALUES (NULL,'$c','$n','$fileName')";
			$q=mysqli_query($con,$query);
			$p=mysqli_query($con, "SELECT * FROM course where cid= '$c'");
			$z=mysqli_fetch_array($p);
			$p=$z['leccnt']+1;
			$qq=mysqli_query($con,"UPDATE `course` SET `leccnt`='$p' WHERE cid='$c'");
			$qq=mysqli_query($con,"UPDATE `subs` SET `total`='$p' WHERE cid='$c'");
					
		}
		else {			
			echo "Sorry !!! There was an error in uploading your file";			
		}

	}
	/*
	* 	If file is already present in the destination folder
	*/
	else {
		echo "File <html><b><i>".$fileName."</i></b></html> already exists in your folder. Please rename the file and try again.";
	
	}	
?>