<?php
include("connect.php");
session_start();
$user_check=$_SESSION['login_user'];

$sql="SELECT*FROM login WHERE Mnumber=1222";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$login_session=$row['Mnumber'];
$login_role=$row['Status'];
if(!isset($login_session)){
 mysqli_close;
 header('location:index.php');
}
?>
