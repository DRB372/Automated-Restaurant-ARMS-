<!DOC TYPE>
<html>

<?php
include("session.php");
 
//Redirect to USER page
if($login_role=='employee'){
 header('location:employee.php');
}
//Redirect To Moderator Page
if($login_role=='manager'){
 header('location:manager.php');
}
?>
<body>
<h1>Wellcome To <?php echo $login_role;?> Page</h1>
 
 
<link rel="stylesheet" href="style.css" type="text/css"/>
<div id="profile">
<h2>User name is: <?php echo $login_session;?> and Your Role is :<?php echo $login_role;?></h2>
<div id="logout"><a href="logout.php">Please Click To Logout</a></div>
<h1> user</h1>
</div>
</body>
<html>