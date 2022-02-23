<?php
include('connection.php');
if(isset($_POST['submit']))
{
  $name=$_POST['name'];
  $id=$_POST['id'];
  $mob=$_POST['mob'];
//   echo "test";
  $q=(" UPDATE `contacts` SET `mob`=$mob WHERE `id`=$id ");
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