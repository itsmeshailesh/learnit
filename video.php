<!DOCTYPE html>
<html>
<body>
<?php 
include_once 'dbConnection.php';
session_start();
$id=$_SESSION['id'];
$lid=$_GET['l'];
$sid=$_GET['s'];
$result=mysqli_query($con,"SELECT * FROM lec where lid='$lid'");

$result1=mysqli_query($con,"SELECT * FROM lhistory where lid='$lid' and sid='$sid'");
$result2=mysqli_query($con,"SELECT * FROM subs where sid='$sid'");
$row2=mysqli_fetch_array($result2);
$x=$row2['cid'];
$result3=mysqli_query($con,"SELECT * FROM course where cid='$x'");
$row3=mysqli_fetch_array($result3);
$row=mysqli_fetch_array($result);
$llink=$row['llink'];
$cnt=mysqli_num_rows($result1) or 0;
if($cnt==0)
{
  $q=mysqli_query($con,"INSERT INTO lhistory(`lid` , `sid` , `time` ) VALUES ('$lid','$sid',NULL)");
  $pg=$row2['progress']+1;
  $q=mysqli_query($con,"UPDATE `subs` SET `progress`='$pg' WHERE sid='$sid'");
}

?>
<video width="100%" height="720" controls>
  <?php echo '<source src="lectures/'.$llink.'" type="video/mp4">'; ?>
  Your browser does not support the video tag.
</video>

</body>
</html>
