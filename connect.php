<?php
  $servername = '';
  $username = '';
  $password = '';
  $database = '';

  $conn = mysqli_connect($servername, $username, $password, $database);

  if(!$conn){
    die("Connection Failed".mysqli_connect_error());
  }
  // echo "Connected Successfully";
?>