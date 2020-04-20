<?php 
session_start();
?>

<html>
<head>
<style>

<?php include 'registration.css'; 
include 'config.php';
include 'signin.css';
?>

</style>
</head>
<body>


<a href = "logout.php">Sign Out</a>


<?php

echo $_SESSION["number1"];

// remove all session variables

if (isset($_POST["list"]))
{	echo"yes";
		$listof=($_POST["list"]);
		echo"enter in the php session";
	foreach($_POST["list"] as $liist){
		echo $liist;
	}
	
	
}

?>


<div align=left>
<div class="container" >
<div class="main">
<h2> Place Your Order</h2>
<form action="customerform.php" method="POST">
 <br>
 <?php
$sql=mysqli_query($conn, "SELECT * FROM `menu`  ");

    while($record = mysqli_fetch_array($sql)) {
		?>
       <input type="checkbox" name="list[]" value="<?php echo $record['MenuId'] ?>" >   <?php echo $record['DishName']; ?> 
	   <dropdown>

	<select >
		<option value="volvo">Select the Quantity</option>
		<option value="saab">1</option>
		<option value="mercedes">2</option>
		<option value="audi">3</option>
	</select>
	</dropdown>
	   <br>
   <?php 
   //echo $record['MenuId'];
   }  
?>

 <input type="submit" value="submit" name="submit">
</form>

<div>
<div>
<div>




</body>
</html>

<html>
<body>

<div class="container3" >
<div class="main">
<h2> Suggesstion Box/Complaint Box</h2>

</div>
</div>

</body>
</html>