<?php

	echo '<div class="container-md"><br><div class="container-md bg-light bg-opacity-25" style="  min-height: 80vh;"><br><h2 class="shadow-lg p-3 mb-5 rounded bg-primary"><span  style="color:#ffffff;font-family:Montserrat, sans-serif; font-size: 30px !important;letter-spacing: 4px;"><b>Transaction<b></span></h2><br>';

if(isset($_POST['subs'])&&(!isset($_POST['join']))) 
	{
				$c=$_POST['txncid'];
				$result = mysqli_query($con,"SELECT * FROM course WHERE `cid`='$c'") or die('Error');
				$row = mysqli_fetch_array($result);
				
					$topic = $row['topic'];
					$subject = $row['subject'];
					$leccnt = $row['leccnt'];
				 	$gid = $row['gid'];
				 	$price=$row['price'];
				    $subc = $row['subcount'];
				    
					$result3 = mysqli_query($con,"SELECT * FROM user where uid='$gid'") or die('Error');
					$r=mysqli_fetch_array($result3);

		echo '
		<table class="table table-striped" height="50%" width="94%"><tr><th>Course</th><th>:</th><th>'.$topic.'</th></tr><tr><th>Instructor</th><th>:</th><th>'.$r['fname'].' '.$r['lname'].'</th></tr><tr><th>Price</th><th>:</th><th>Rs.'.$price.'</th></tr><tr><td align="center" class="alert alert-danger" colspan="3">The amount will be deducted from your Balance!</td></tr><tr><td align="center" colspan="3">Join this Course?</td></tr>
		<tr><td colspan="3"><form method="POST" action="dashboard.php?q=4"><input type="hidden" name="cid" value="'.$c.'"><input type="hidden" name="leccnt" value="'.$leccnt.'"><input type="hidden" name="gid" value="'.$gid.'"><input type="hidden" name="price" value="'.$price.'"><input type="Submit" align="center" name="join" value="JOIN"></form></td></tr>


		';

		
		
	}
	else if(isset($_POST['join']))
	{

		$uid=$_SESSION['id'];
		$cid=$_POST['cid'];
		$leccnt=$_POST['leccnt'];
		$gid=$_POST['gid'];
		$price=$_POST['price'];	
		$type='subs';
		$result3 = mysqli_query($con,"SELECT * FROM user where uid='$uid'") or die('Error');
		$row=mysqli_fetch_array($result3);
		$result4 = mysqli_query($con,"SELECT * FROM user where uid='$gid'") or die('Error');
		$row2=mysqli_fetch_array($result4);
		if($price<=$row['bal'])
		{
			
			$q=mysqli_query($con,"INSERT INTO `txn`(`txnid`, `type`, `userid`, `gcid`,`value`,`cid`,`gid`,`time`) VALUES (NULL,'$type','$uid',NULL,'$price','$cid','$gid',NULL)")or die('Error0090');
			$q=mysqli_query($con,"INSERT INTO `subs`(`sid`, `uid`, `cid`, `sdate`,`progress`,`total`) VALUES (NULL,'$id','$cid',NULL,0,'$leccnt')")or die('Error009');

			$ubal=$row['bal']-$price;
			$ibal=$row2['bal']+$price;
		$r=mysqli_query($con,"UPDATE `user` SET bal = '$ibal' where uid='$gid'")or die('Error019');
		$r=mysqli_query($con,"UPDATE `user` SET bal = '$ubal' where uid='$uid'")or die('Error019');

		$r=mysqli_query($con,"UPDATE `course` SET subcount = subcount+1 where cid='$c'")or die('Error019');
		header("location:dashboard.php?q=1");
		}else

		{
			echo '<div align="center" class="alert alert-danger"><h2>Insufficient Balance</h2>	</div>
			<div align="center" class="alert alert-success"><form method="POST" action="dashboard.php?q=4">
		<label for="gcode">Add a Gift Code : </label><br>
			<input class="form form-control-lg" type="text" name="gcode"><br><br>
			<input class="btn btn-primary" type="submit" value="Redeem"  name="gc">
			</form></div>
		';
		}


		
	}else if (isset($_POST['gc'])) {

			$gc=$_POST['gcode'];
					$result = mysqli_query($con,"SELECT * FROM giftcode where code='$gc'") or die('Error');
					if(mysqli_num_rows($result)==0){
						echo '<div align="center" class="alert alert-danger"><h2>Gift Code Invalid! </h2></div>
					
					
			<div align="center" class="alert alert-success"><form method="POST" action="dashboard.php?q=4">
		<label for="gcode">Try Another : </label><br>
			<input class="form form-control-lg" type="text" name="gcode"><br><br>
			<input class="btn btn-primary" type="submit" value="Redeem"  name="gc">
			</form></div>';
				}
				else
				{
					$row=mysqli_fetch_array($result);
					$v=$row['value'];
					$gcid=$row['id'];
					$uid=$_SESSION['id'];
					$used=$row['used'];
					$gc="aaa";
					if($used==false)
					{
						$result3 = mysqli_query($con,"SELECT * FROM user where uid='$uid'") or die('Error');
						$row2=mysqli_fetch_array($result3);
						$ubal=$row2['bal']+$v;
						
								$r=mysqli_query($con,"UPDATE `giftcode` SET userid = '$uid', used=true,time=now() WHERE id='$gcid'")or die('Error0191');
								$r=mysqli_query($con,"UPDATE `user` SET bal = '$ubal' where uid='$uid'")or die('Error019');
								$type="redeem";

					$q=mysqli_query($con,"INSERT INTO `txn`(`txnid`, `type`, `userid`, `gcid`,`value`,`cid`,`gid`,`time`) VALUES (NULL,'$type','$uid',$gcid,'$v',NULL,NULL,NULL)")or die('Error0090');


						echo '<div align="center" class="alert alert-success"><h2>Rs. '.$v.' successfully added to your balance</h2></div>';
					}else
					{
												echo '<div align="center" class="alert alert-danger"><h2>Gift Code Already Used! </h2></div>
<div align="center" class="alert alert-success"><form method="POST" action="dashboard.php?q=4">
		<label for="gcode">Try Another : </label><br>
			<input class="form form-control-lg" type="text" name="gcode"><br><br>
			<input class="btn btn-primary" type="submit" value="Redeem"  name="gc">
			</form></div>';
					}
				}
			
			
		}
?>