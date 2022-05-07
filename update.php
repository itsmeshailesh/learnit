<?php
include_once 'dbConnection.php';
session_start();
$id=$_SESSION['id'];
	if(isset($_POST['button11'])) 
	{
		$email=$_POST['email'];
		$mob=$_POST['mob'];
				$fname=$_POST['fname'];
				$lname=$_POST['lname'];
				$pass=$_POST['pass'];
				$role =$_POST['role'];
				
				$q=mysqli_query($con,"INSERT INTO `user`(`uid`, `fname`,`lname`, `mail`, `pass`, `role`, `mob`,`sign`,`bal`) VALUES (NULL,'$fname','$lname','$email','$pass','$role','$mob',NULL,NULL)")or die('Error009');

				header("location:index.php");
				
		
	
		
	}
	if(isset($_POST['button12'])) 
	{
		$email=$_POST['email'];
		$name=$_POST['name'];
		$sub=$_POST['sub'];
		$feed =$_POST['feed'];
		$q=mysqli_query($con,"INSERT INTO `feedback`(`fid`, `mail`, `name`, `sub`, `text`) VALUES (NULL,'$email','$name','$sub','$feed')")or die('Error009');
		header("location:index.php?s=1");
		
	}
if(isset($_POST['subs'])) 
	{
		$c=$_POST['cid'];
		$leccnt=$_POST['leccnt'];
		$q=mysqli_query($con,"INSERT INTO `subs`(`sid`, `uid`, `cid`, `sdate`,`progress`,`total`) VALUES (NULL,'$id','$c',NULL,0,'$leccnt')")or die('Error009');
		$r=mysqli_query($con,"UPDATE `course` SET subcount = subcount+1 where cid='$c'")or die('Error019');
		header("location:dashboard.php?q=1");
		
	}



	if(isset($_POST['course']))
	{
		$gid=$_SESSION["id"];
		$topic = $_POST['topic'];
		$subject =$_POST['subject'];
		$desc=$_POST['desc'];
		$price=$_POST['price'];
		$a=mysqli_query($con, "INSERT INTO `course`(`cid`, `topic`, `subject`, `description`, `leccnt`, `gid`, `subcount`,`price`) VALUES (NULL,'$topic','$subject','$desc',0,'$gid',0,'$price')");
		header("location:dashboard.php?q=1");
	}


?>