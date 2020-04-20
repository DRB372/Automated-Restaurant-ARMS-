<?php
include("session.php");
if($login_role=='employee'){
 header('location:employee.php');
}
if($login_role=='customer'){
 header('location:customer.php');
}
?>
<h1>Wellcome to <?php echo $login_role;?> Page</h1>
<link rel="stylesheet" href="style.css" type="text/css"/>
<div id="profile">
<h2>User name is: <?php echo $login_session;?> and Your Role is :<?php echo $login_role;?></h2>
<div id="logout"><a href="logout.php">Please Click To Logout</a></div>
<h1> manager</h1>
</div>