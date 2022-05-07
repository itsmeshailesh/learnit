<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Dashboard</title>
<?php include_once 'include.php'; ?>
<style>
	table, th,  td {
  border: 1px solid black;
  border-collapse: collapse;
}
	
	.panel{
		align-items: center;
	}
	.selfrow{
		background-color:  #99cc32;
	}

 .wrapper {
  width: 100%;
  width: 100%;
  height: auto;
  min-height: 100vh;
  padding: 10px 10px;
  
  background-image: linear-gradient(-20deg, #ff2846 0%, #6944ff 100%);

  
  @media screen and (max-width: 768px) {
    height: auto;
    min-height: 100vh;
    padding-top: 100px;
  }

}
	.answer{
		background-color: green;
	}
	.table{
		margin: 3% 3%;
		width: 94%;
		text-align: center;
	}
	
</style>
<body class="wrapper">
	
<?php
include_once 'dbConnection.php';
session_start();
if(isset($_SESSION["id"])) {
	$id=$_SESSION["id"];
	$result = mysqli_query($con,"SELECT * FROM user WHERE uid = '$id'") or die('Errord');
	$count=mysqli_num_rows($result);
	$row1=mysqli_fetch_array($result);
	$role=$row1['role'];
	if($count==0){
		session_destroy();
		header("location:index.php?w=Account does not Exist");
	}
	


	if($role == "Admin")
		{
			include 'admin.php';
		}
	else 
	if($role == "Instructor")
		{
			include_once 'instructor.php';
		}
	else 
	if($role == "Learner")
		{
			include 'learner.php';
		}
	}
	else
		{
			header("location:index.php#login");
		}

?>

<html>
<body>


	
</body>


</html>





