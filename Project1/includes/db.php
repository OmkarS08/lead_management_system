<?php

$server='localhost';
$username='root';
$password ='';
$db='project1';

$conn = mysqli_connect($server,$username,$password);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  

$selectDB= mysqli_select_db($conn,$db) or die(mysqli_error());
?>