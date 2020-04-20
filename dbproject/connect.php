<?php
$host="localhost";//Host Name
$username="root"; //MySQL username. root is Default.
$password=""; //MySQL Password
$dbname="hotel1"; //Your Database Name
//Connecting To The Server
$con=mysqli_connect($host,$username,$password)or die("Failed To Connect");
//Selecting Database
mysqli_select_db($con,$dbname)or die("Failed to select database");
?>
