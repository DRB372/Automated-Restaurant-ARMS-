<!DOCTYPE html>

<?php
include 'connect.php';
session_start();
$sessionNum=$_SESSION["number1"];
date_default_timezone_set("Asia/Karachi");


?>


<html>
<head>
    <title>
    ARMS
    </title>
    <link rel="icon" href="https://www.birchstreetsystems.com/wp-content/uploads/2016/04/restaurant-icon-2.png">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Employee Home</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<style>
    
.container-fluid{
  background-image: url("banner3.png");
  min-height: 120px;
}
    </style>


    <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3><a href="employee.php">Empoyee Page</a></h3>
            </div>

            <ul class="list-unstyled components">
                <p>ARMS</p>
                <li class="active">
                    <a href="#">Home</a>
                </li>
                <li>
                    <a href="employeea.php">Attendance</a>
                </li>
                <li>
                    <a href="inventoryemp/inventory.php">Inventory</a>
                </li>
                <li>

                </li>
            </ul>

            <ul class="list-unstyled CTAs">
                <li><a href="logout.php" class="download">Logout</a></li>
                <!-- <li><a href="https://bootstrapious.com/p/bootstrap-sidebar" class="article">Back to article</a></li> -->
            </ul>
        </nav>

        <!-- Page Content Holder -->
        <div id="content">

            <nav class="navbar navbar-default">
                <div class="container-fluid">

                    <div class="navbar-header">
                        <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                            <i class="glyphicon glyphicon-align-left"></i>
                            <span>Toggle Sidebar</span>
                        </button>
                    </div>

                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <?php      echo "<h3>".$date1=date('Y-m-d') ."</h3>"; ?>
                        </ul>
                    </div>
                </div>
            </nav>


            <!-- <h2>Pending Orders</h2> <br> -->
            <div class="row">

                <div class="col-md-6">
                    <h2>Orders in Queue</h2>
                    <table class="table">

                        <tr>
                            <td>Order#</td>
                            <td>Dishes(Qty)</td>
                            <td>Status</td>
                        </tr>
                        <?php
                        $i=0;
                        $total=array();
                        $pen="pending";
                        $getrows=mysqli_query($con,"SELECT * FROM hotel1.customerorder WHERE Status='$pen'");// show the pending orders ?>
                        <form action="employee.php" method="POST">
                            <?php while ($row =$getrows->fetch_assoc()) {

                                echo "<tr><td>".$value=$row['OrderId']."</td>"; 	?>
                                    <td><input type="checkbox" name="list[]" value="<?php echo $i ?> "/>

                                        <?php
                                        array_push($total,$value);
                                        $sql=mysqli_query($con,"SELECT * FROM hotel1.bill where bill.OrderId='$value' ");
                                        //echo  str_repeat('&nbsp;', 16);
                                        while ($sql2 = $sql->fetch_assoc()) {
                                            $menu=$sql2['MenuId'];  //find menuid from bill table
                                            $sql7=mysqli_query($con,"SELECT * FROM hotel1.menu where menu.MenuId='$menu' ");
                                            while ($sql3 = $sql7->fetch_assoc()){
                                                echo $sql3['DishName'];
                                            }
                                            echo " ( ".$sql2['DishQuantity']." ) ";
                                        //    echo " ( ".$sql2['DishQuantity']." ) ";

                                        }
                                        echo "</td>";
                                        echo "<td>".$row["Status"]."</td></tr>";
                                        $i++;
                                    } ?>
                                    <tr><td><input type="submit" value="Delivered" name="submit"></td></tr>
                                </form>
                            </table>
                            <?php
                            if (isset($_POST["list"]) ){
                                foreach($_POST["list"] as $liist){

                                    $lest=(int)$liist;
                                    $val=$total[$lest]; // mark the product it delivered
                                    $sql = mysqli_query($con,"UPDATE hotel1.customerorder SET customerorder.Status='delivered' WHERE OrderId='$val'");
                                    if (($sql) === TRUE) {
                                    }else {
                                        echo "Error Occured  " . $sqlq . "<br>" . mysqli_error($conn);
                                    }

                                }
                                $URL="http://localhost:80/dbproject/employee.php"; // refresh the page so that it will eliminate the delivered product
                                echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
                            }
                            ?>
                        </div>





                        <div class="col-md-6">
                            <h2> Place Customer Order</h2>
                            <form action="employee.php" method="POST">
                                <?php
                                $sql=mysqli_query($con, "SELECT * FROM `menu`  ");?>
                                <table class="table"><tr><td>Item Names</td>
                                    <td>Quantity</td>
                                    <td>Their Prices</td>
                                </tr>
                                <?php   while($record = mysqli_fetch_array($sql)) {	 ?>
                                    <tr><td>  <input type="checkbox" name="list22[]" value="<?php echo $record['MenuId'] ?>" >   <?php echo $record['DishName']."</td>"; ?>
                                        <td><input type="number" name="numlist[]" value="1" min="1"   style="width:35px;text-align:right;"  > </td>

                                        <td><?php echo $record['Price'];?></td></tr>

                                        <?php
                                    }
                                    ?>
                                    <tr><td> Number:</td>
                                        <td>    <input name="number1" placeholder="Enter the Number" required pattern="[0-9]{11}"/> </td></tr><br>
                                        <tr> <td>Comment Box</td>
                                            <td><textarea name="comments" placeholder="Enter comments"></textarea></td></tr>
                                            <tr><td><input type="submit" value="submit" name="submit1"></td></tr>
                                        </table>
                                    </form>

<?php
                                    if (isset($_POST["list22"]) )
                                    	{	if(!empty($_POST["number1"])){

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
                                    	//----------inset in customer table-----------------//
                                    	$checkno= mysqli_query($con,"SELECT * FROM hotel1.customer WHERE MobileNumber='$MobileNumber'");
                                    				if(mysqli_num_rows($checkno)>0){

                                    					goto a; //to insert only in customer order table
                                    				}
                                    	$insert23=mysqli_query($con,"INSERT INTO hotel1.customer ( Name,MobileNumber,Gender,Date)
                                    	VALUES ( 'NULL', '$MobileNumber','M','$date1')");
                                    	if (($insert23) === TRUE) {
                                    			}else {
                                    			echo "Error Occured1 ðŸ˜ž : " . $sqlq . "<br>" . mysqli_error($con);}
                                    		//------------insert into customer order--------------------//
                                    		a:
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
                                    $URL="http://localhost:/dbproject/employee.php"; // refresh the page so that it will eliminate the delivered product
                                    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
                                    }

                                    ?>






                                </div>

                            </div>

                            <p>-------------------------------------------------Automated Restaurant Management System--------------------------------------------------</p>



                            <!-- jQuery CDN -->
                            <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
                            <!-- Bootstrap Js CDN -->
                            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

                            <script type="text/javascript">
                            $(document).ready(function () {
                                $('#sidebarCollapse').on('click', function () {
                                    $('#sidebar').toggleClass('active');
                                });
                            });
                            </script>
                        </body>
                        </html>
