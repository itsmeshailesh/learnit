<nav class="navbar navbar-expand-lg navbar-light bg-light">
	 <div class="container-fluid">
	    <a class="navbar-brand" href="#"><span  style="color:#f4511e;font-family:Montserrat, sans-serif; font-size: 30px !important;letter-spacing: 3px;">Instructor Dashboard</span></a>
	    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
	      <ul class="navbar-nav ">
	      	 <li class="nav-item"><span  style="color:#f4511e;font-family:Montserrat, sans-serif; font-size: 15px !important;letter-spacing: 2px;">
	          <a class="nav-link" aria-current="page" href="dashboard.php?q=8">&nbsp;Profile  &nbsp;</a></span>
	        </li>
	        <li class="nav-item"><span  style="color:#f4511e;font-family:Montserrat, sans-serif; font-size: 15px !important;letter-spacing: 2px;">
	          <a class="nav-link" aria-current="page" href="dashboard.php?q=1">&nbsp;Added Courses  &nbsp;</a></span>
	        </li></li> <li class="nav-item"><span  style="color:#f4511e;font-family:Montserrat, sans-serif; font-size: 15px !important;letter-spacing: 2px;">
	          <a class="nav-link" aria-current="page" href="dashboard.php?q=3">&nbsp;Add a Course  &nbsp;</a></span>
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

		if(@$_GET['q']==1)
		{
				echo '<div class="container-md" ><br></div><div class="container-md bg-info bg-opacity-25" style="  min-height: 80vh;"><br><h2 class="shadow-lg p-3 mb-5 rounded bg-primary"><span  style="color:#ffffff;font-family:Montserrat, sans-serif; font-size: 30px !important;letter-spacing: 4px;"><b>Courses<b></span></h2><br><div class="card-group">';
				$result7 = mysqli_query($con,"SELECT * FROM course WHERE gid='$id'") or die('Error');
				
				$c=1;
				while($row = mysqli_fetch_array($result7))
				{
					$cid = $row['cid'];
					$topic = $row['topic'];
					$subject = $row['subject'];
					$lecnt = $row['leccnt'];
				 	$gid = $row['gid'];
				    $subc = $row['subcount'];
				    
					$result3 = mysqli_query($con,"SELECT * FROM user where uid='$id'") or die('Error');
					$r=mysqli_fetch_array($result3);
					echo  '<a href="dashboard.php?q=2&c='.$cid.'" class="card-link"><div class="card  shadow-lg mb-5 bg-body rounded" style="width: 18rem;">
  							<div class="card-body">
   							<h5 class="card-title">'.$topic.'</h5>
   							<h6 class="card-subtitle mb-2 text-muted">'.$subject.'</h6>
    						
  							</div>
							</div></a>';
					$c++;
					}


				
				echo '</div><br></div>';
		}else if(@$_GET['q']==2)
		{
			include 'courseview.php';
	 }if(@$_GET['q']==3)
		{
			include 'add.php';
	 }if(@$_GET['q']==4)
		{
			include 'preview.php';
	 }else if(@$_GET['q']==8)
	{
		include 'profile.php';
		
	}


	  ?>


			