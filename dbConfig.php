<?php
  $user = 'root';
  $pass = '';
  $db = 'sui';
  $conn = mysqli_connect('localhost',$user,$pass,$db);
  
  if(mysqli_connect_errno()){
    die("Connection error: " . mysqli_connect_errno());
  }
?>
