 <nav class="navbar navbar-expand-lg navbar-light bg-light">
	 <div class="container-fluid">
	    <a class="navbar-brand" href="#"><span  style="color:#f4511e;font-family:Montserrat, sans-serif; font-size: 30px !important;letter-spacing: 4px;">Learner Dashboard</span></a>
	    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
	      <ul class="navbar-nav ">
	        <li class="nav-item"><span  style="color:#f4511e;font-family:Montserrat, sans-serif; font-size: 15px !important;letter-spacing: 2px;">
	          <a class="nav-link" aria-current="page" href="dashboard.php?q=6">&nbsp;Redeem GiftCode &nbsp; </a></span>
	        </li>
	         <li class="nav-item"><span  style="color:#f4511e;font-family:Montserrat, sans-serif; font-size: 15px !important;letter-spacing: 2px;">
	          <a class="nav-link" aria-current="page" href="dashboard.php?q=8">&nbsp;Profile &nbsp; </a></span>
	        </li> <li class="nav-item"><span  style="color:#f4511e;font-family:Montserrat, sans-serif; font-size: 15px !important;letter-spacing: 2px;">
	          <a class="nav-link" aria-current="page" href="dashboard.php?q=1">&nbsp;My Courses &nbsp; </a></span>
	        </li> <li class="nav-item"><span  style="color:#f4511e;font-family:Montserrat, sans-serif; font-size: 15px !important;letter-spacing: 2px;">
	          <a class="nav-link" aria-current="page" href="dashboard.php?q=2">&nbsp;Join a Course  &nbsp;</a></span>
	        </li>
	        <li class="nav-item"><span  style="color:#f4511e;font-family:Montserrat, sans-serif; font-size: 15px !important;letter-spacing: 2px;">
	          <a class="nav-link" href="logout.php" >&nbsp;Logout&nbsp;</a></span>
	        </li>
	      </ul>
	    </div>
	  </div>
</nav>




 	<?php

		 		$id=$_SESSION["id"];

		if(@$_GET['q']==2)
		{
			echo '<div class="container-md"><br><div class="container-md bg-info bg-opacity-25" style="  min-height: 80vh;"><br><h2 class="shadow-lg p-3 mb-5 rounded bg-primary"><span  style="color:#ffffff;font-family:Montserrat, sans-serif; font-size: 30px !important;letter-spacing: 4px;"><b>AVAILABLE COURSES<b></span></h2><br><div class="card-group">';
						$result7 = mysqli_query($con,"SELECT * FROM course") or die('Error');
				
				$c=1;
				$a=0;
				while($row = mysqli_fetch_array($result7))
				{
					$cid = $row['cid'];
					$topic = $row['topic'];
					$subject = $row['subject'];
					$lecnt = $row['leccnt'];
				 	$gid = $row['gid'];
				 	$price=$row['price'];
				    $subc = $row['subcount'];
				    
					$result3 = mysqli_query($con,"SELECT * FROM user where uid='$gid'") or die('Error');
					$r=mysqli_fetch_array($result3);
					$rr=mysqli_query($con,"SELECT * FROM subs where uid='$id' and cid='$cid'");
					$cn=mysqli_num_rows($rr);

					if($cn==0){
						$a++;
						$row=mysqli_fetch_array($rr);
					echo  '<div class="card-link" ><div class="card  shadow-lg  mb-5 bg-body rounded" style="width: 18rem;">
  							<div class="card-body">
   							<h5 class="card-title " style="min-height:10vh;">'.$topic.'</h5>
   							<h6 class="card-subtitle mb-2 text-muted">'.$subject.'</h6>
    						<p class="card-subtitle mb-2 text-muted">'.$r['fname'].' '.$r['lname'].'</p>
    						<p class="card-subtitle mb-2 text-muted">Lectures :'.$lecnt.'</p>
    						<i>Rs.'.$price.'</i><br>
    						<form method="POST" action="dashboard.php?q=4">
    						<input type="hidden" name="txncid" value="'.$cid.'">
    						<input type="hidden" name="leccnt" value="'.$lecnt.'">
    						<input type="submit" name="subs" class="btn btn-primary" value="Join">
    						</form>
  							</div>
  							</div>
							</div>
';
$c++;
					}



				}
				if($a==0)echo 'No Courses Available';
				echo '</div><br></div>';
		}else if(@$_GET['q']==1)
		{

			echo '<div class="container-md"><br><div class="container-md bg-info bg-opacity-25" style="  min-height: 80vh;"><br><h2 class="shadow-lg p-3 mb-5 rounded bg-primary"><span  style="color:#ffffff;font-family:Montserrat, sans-serif; font-size: 30px !important;letter-spacing: 4px;"><b>MY LEARNING<b></span></h2><br><div class="card-group">';
				$result7 = mysqli_query($con,"SELECT * FROM course") or die('Error');
				
				$c=1;
				while($row = mysqli_fetch_array($result7))
				{
					$cid = $row['cid'];
					$topic = $row['topic'];
					$subject = $row['subject'];
					$lecnt = $row['leccnt'];
				 	$gid = $row['gid'];
				    $subc = $row['subcount'];
				    
					$result3 = mysqli_query($con,"SELECT * FROM user where uid='$gid'") or die('Error');
					$r=mysqli_fetch_array($result3);
					$rr=mysqli_query($con,"SELECT * FROM subs where uid='$id' and cid='$cid'");
					$cn=mysqli_num_rows($rr);

					if($cn>0){
						$row=mysqli_fetch_array($rr);
						$sid=$row['sid'];
					echo  '<a href="dashboard.php?q=3&s='.$sid.'&t='.$topic.'&i='.$r['fname'].' '.$r['lname'].'" class="card-link"><div class="card  shadow-lg  mb-5 bg-body rounded" style="width: 18rem;">
  							<div class="card-body">
   							<h5 class="card-title">'.$topic.'</h5>
   							<h6 class="card-subtitle mb-2 text-muted">'.$subject.'</h6>
    						<p class="card-subtitle mb-2 text-muted">'.$r['fname'].' '.$r['lname'].'</p>
    						<p class="card-subtitle mb-2 text-muted">Completed '.$row['progress'].' of '.$row['total'].'</p>
  							</div>
							</div></a>';
					$c++;
					}

}
				
				echo '</div><br></div>';


		}else if(@$_GET['q']==3)
		{

		include 'course.php';

		}
		else if(@$_GET['q']==4)
		{
			include 'txn.php';
		}
		else if(@$_GET['q']==6)
	{
		echo '<div class="container-md"><br><div class="container-md bg-light bg-opacity-25" style="  min-height: 80vh;"><br><h2 class="shadow-lg p-3 mb-5 rounded bg-primary"><span  style="color:#ffffff;font-family:Montserrat, sans-serif; font-size: 30px !important;letter-spacing: 4px;"><b>Redeem Gift Card<b></span></h2><br>';

		echo '<div align="center" class="alert alert-success"><form method="POST" action="dashboard.php?q=4">
		<label for="gcode">Add your Gift Code here : </label><br>
			<input class="form form-control-lg" type="text" name="gcode"><br><br>
			<input class="btn btn-primary" type="submit" value="Redeem"  name="gc">
			</form></div>';

		
	}else if(@$_GET['q']==8)
	{
		include 'profile.php';
		
	}


			


	




?>
