<?php
  $llink=$_POST['llink'];
  $lname=$_POST['lname'];
  
  
?>

<div class="container-md"><br></div><div class="container-md bg-info bg-opacity-25" style="  min-height: 80vh;"><br><h2 class="shadow-lg p-3 mb-5 rounded bg-primary"><span  style="color:#ffffff;font-family:Montserrat, sans-serif; font-size: 30px !important;letter-spacing: 4px;"><b><?php echo $lname;?><b></span></h2>
<video width="100%" height="720" controls>
  <?php echo '<source src="lectures/'.$llink.'" type="video/mp4">'; ?>
  Your browser does not support the video tag.

</video>
</div>