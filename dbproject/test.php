<html>
<body>
<head>
<style>

<?php include 'registration.css';
include 'connect.php';
include 'signin.css';
//$sessionNum=$_SESSION["number1"];
date_default_timezone_set("Asia/Karachi");
echo $date1=date('Y-m-d');

?>

</style>
</head>


<div class="container" >
<div class="main">
<h2>Pending Orders</h2> <br>
<b>Order# </b>
<mid1><b>(Dishes + Quantity)</b></mid1>
<right><b>(Status)</b></right>
<br>
<?php

$i=0;
$total=array();
$pen="pending";
$getrows=mysqli_query($con,"SELECT * FROM hotel1.customerorder WHERE Status='$pen'");// show the pending orders ?>
<form action="test.php" method="POST">

<?php while ($row = $getrows->fetch_assoc()) {
	echo "<br>";
echo $value=$row['OrderId']."\t"; 	?>

	<right><input type="checkbox" name="list[]" value="<?php echo $i ?> " /></right>

		<?php
		array_push($total,$value);
		$sql=mysqli_query($con,"SELECT * FROM hotel1.bill where bill.OrderId='$value' ");
		echo  str_repeat('&nbsp;', 16);
	 while ($sql2 = $sql->fetch_assoc()) {
				$menu=$sql2['MenuId']."\t";  //find menuid from bill table
				$sql7=mysqli_query($con,"SELECT * FROM hotel1.menu where menu.MenuId='$menu' ");
			while ($sql3 = $sql7->fetch_assoc()){
					 echo $sql3['DishName'];
				}
				echo "(".$sql2['DishQuantity'].")"."\t";
		}
			$i++;
} ?>
<br>
<mid><input type="submit" value="Delivered" name="submit"></mid>
</form>

<?php
if (isset($_POST["list"]) ){
	foreach($_POST["list"] as $liist){

			$lest=(int)$liist;
			 $val=$total[$lest]; // mark the product it delivered
		$sql = mysqli_query($con,"UPDATE hotel1.customerorder SET customerorder.Status='delivered' WHERE OrderId='$val'");
			if (($sql) === TRUE) {
				}else {
					echo "Error Occured1 ðŸ˜ž : " . $sqlq . "<br>" . mysqli_error($con);
						}

	}
	$URL="http://localhost:80/test.php"; // refresh the page so that it will eliminate the delivered product
	echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
}
?>
<?php


// remove all session variables

if (isset($_POST["list22"]) )
	{	if(!empty($_POST["number1"])){
	if(!empty($_POST["address"])){
	$address=$_POST["address"];}
		else
			$address=NULL;
		if(!empty($_POST["comments"])){
			$Comments=$_POST["comments"];
		}else{
			$Comments=NULL;
		}

		$listof=($_POST["list22"]);


		//---------------------used  for dish quantity---------//

		//echo "show the quanitty".$_POST["numlist"]  ."<br>";
		$b=array(); // array for quantity
		foreach($_POST["numlist"] as $liist){

		//echo "show the quanitty". $liist ."<br>";
		array_push($b,$liist);


		}
			$MobileNumber=$_POST["number1"];

	//--------------------used for menuid--------------------//

	$a=array(); //array for dish id
	foreach($_POST["list22"] as $liist){

		$echo1 = mysqli_query($con,"SELECT * FROM hotel1.menu WHERE MenuId=$liist" );
		while ($row = $echo1->fetch_assoc()) {
		array_push($a,$row['MenuId']);  //only store the MenuId of each dish

		}

	} $gender="NULL";
	$insert23=mysqli_query($con,"INSERT INTO hotel1.customer ( Name,MobileNumber,Gender,Date)
	VALUES ( 'NULL', '$MobileNumber','M','$date1')");
	if (($insert23) === TRUE) {
			}else {
			echo "Error Occured1 ðŸ˜ž : " . $sqlq . "<br>" . mysqli_error($con);}

	$insert23=mysqli_query($con,"INSERT INTO hotel1.customerorder ( Total,Comment,Date,Status,Address,MobileNumber)
	VALUES ('0', '$Comments','$date1','pending','$address', '$MobileNumber')");
	if (($insert23) === TRUE) {
			}else {
			echo "Error Occured1 ðŸ˜ž : " . $sqlq . "<br>" . mysqli_error($con);}

	$order=mysqli_query($con,"SELECT OrderId from hotel1.customerorder WHERE OrderId= (select max(OrderId) from customerorder) ");
	$row = $order->fetch_assoc();
	$orderid=$row['OrderId'];

	 echo "thank you for submiting the order  your orderId=".$orderid;
	 //-------------------------insert into the bill table----------------------------------//


	$total=0;  //store the total amount
	 for($i=0;$i<sizeof($a);$i++){
		 $val=$a[$i]  ;		//return the menu id
		$quan=$b[$val-1] ;  //return the quantity

		 $que=mysqli_query($con,"INSERT INTO bill (OrderId,MenuId,DishQuantity)VALUES('$orderid','$val','$quan')");	 //store quantity and menu id
		$insertvalue=mysqli_query($con,"SELECT * FROM hotel1.menu where MenuId=$val");
		if (($que) === TRUE) {
			}else {
		echo "Error Occured1 ðŸ˜ž : " . $sqlq . "<br>" . mysqli_error($con);
			}
		while ($row = $insertvalue->fetch_assoc()) {
		 $row['Price']."<br>";
		 $tval=($row['Price']*$quan);  //total of each Dish with its quantity
		$total+=$tval;  //total amount
		}
	 }
	 echo "total bill = ". $total;

	$sql = mysqli_query($con,"UPDATE hotel1.customerorder SET customerorder.Total='$total' WHERE OrderId='$orderid'");
	if (($sql) === TRUE) {
			}else {
		echo "Error Occured1 ðŸ˜ž : " . $sqlq . "<br>" . mysqli_error($con);
			}

}else{
	echo "enter the number";
}
}
if ( isset($_POST["submitcomplaint"]) &&(!empty($_POST["complaint"]))){
	$cusComplaint=$_POST["complaint"];
	$insert=mysqli_query($con,"INSERT INTO hotel1.customercomplaint ( MobileNumber,Text)
	VALUES ('$sessionNum', '$cusComplaint')");

	}

?>
</body>
</html>


<html>
<body>

<div class="container3" >
<div class="main">
<form action="test.php" method="POST">
<h2> Attendence of Past Week</h2> <br>
<?php
$sql6=mysqli_query($con,"Select * from hotel1.attendance where Cnic IN (select Cnic from hotel1.employee where PhoneNumber='302717171')");

		while ($sql3 = $sql6->fetch_assoc()){
					 echo $sql3['Date']."<br>";
				}
?>
</body>
</html>


<div align=left>
<div class="container" >
<div class="main">
<h2> Place Your Order</h2>
<form action="test.php" method="POST">
 <br>
 <?php
$sql=mysqli_query($con, "SELECT * FROM `menu`  ");?>
	<b>Item Names</b>
	 <dropdown> <b>Their Prices</b></dropdown>
	 <mid> <b>Quantity </b></mid>
	<br>
 <?php   while($record = mysqli_fetch_array($sql)) {	 ?>
       <input type="checkbox" name="list22[]" value="<?php echo $record['MenuId'] ?>" >   <?php echo $record['DishName']; ?>
	   <mid><input type="number" name="numlist[]" value="1" min="1"   style="width:35px;text-align:right;"  > </mid>
	   <dropdown>
	   <?php echo $record['Price'];?>
	   </dropdown>
	   <br>
   <?php
   //echo $record['MenuId'];
   }
?>
<br>
  Number:
<input name="number1" placeholder="enter the number"/> <br>
  Comment Box
<textarea name="comments" placeholder="enter your comments"></textarea>
Current Address <textarea name="address" placeholder="Your current address"></textarea>

 <input type="submit" value="submit" name="submit1">
</form>

<div>
<div>
<div>
