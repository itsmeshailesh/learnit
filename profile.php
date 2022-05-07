  <?php 

  echo '<div class="container-md"><br><div class="container-md bg-light bg-opacity-25" style="  min-height: 80vh;"><br><h2 class="shadow-lg p-3 mb-5 rounded bg-primary"><span  style="color:#ffffff;font-family:Montserrat, sans-serif; font-size: 30px !important;letter-spacing: 4px;"><b>Profile<b></span></h2><br>';
  $uid=$_SESSION['id'];
  $res1=mysqli_query($con,"SELECT * FROM user where uid='$uid'");
  $row1=mysqli_fetch_array($res1);
  $name=$row1['fname'].' '.$row1['lname'];
  $mail=$row1['mail'];
  $role=$row1['role'];
  $mob=$row1['mob'];
  $bal=$row1['bal'];
  $res2=mysqli_query($con,"SELECT * FROM subs where uid='$uid'");
  $res3=mysqli_query($con,"SELECT * FROM user where uid='$uid'");
  $res4=mysqli_query($con,"SELECT * FROM user where uid='$uid'");
?>
<table class="table table-striped bg bg-light">
  <tr>
    <th width="25%">Name</th>
    <td><?php echo $name;?></td>
  </tr>
   <tr>
    <th width="25%">Mail</th>
    <td><?php echo $mail;?></td>
  </tr>
   <tr>
    <th width="25%">Role</th>
    <td><?php echo $role;?></td>
  </tr>
   <tr>
    <th width="25%">Mobile Number</th>
    <td><?php echo $mob;?></td>
  </tr>
   <tr>
    <th width="25%">Balance</th>
    <td><?php echo $bal;?></td>
  </tr>
  
  
  </table>
</div>