<?php
include('connection.php');
if(isset($_POST['submit']))
{
  $name=$_POST['name'];
  $mob=$_POST['mob'];
//   echo "test";
  $q=(" INSERT INTO `contacts`(`name`, `mob`) VALUES ('$name','$mob')");
//   echo ($q);
  $e=mysqli_query($con,$q);
  if ($e){
    header("Location:index.php");
  }
  else{
      echo "Unable to send data. Please try again!";
  }
}
?>