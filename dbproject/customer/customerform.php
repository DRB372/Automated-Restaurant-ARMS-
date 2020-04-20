<!DOCTYPE html>
<html>
    <head>
         <title>
    ARMS
    </title>
    <link rel="icon" href="https://www.birchstreetsystems.com/wp-content/uploads/2016/04/restaurant-icon-2.png">

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <script>
        function pop_up(url){
        window.open(url,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=1076,height=768,directories=no,location=no')
        }
        submitModal = function(){
	$('#myModal').modal('show');
	document.forms['my_form'].submit();

}
        </script>

         <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="../styles.css">
    </head>
    <style>
        .container-fluid{
  background-image: url("https://saakshirestaurant.com/img/banner3.png");
  min-height: 100px;
            width: 100%;
}
    </style>
    <body>
<!-- Php -->
<?php
    include("../connect.php");
    session_start();
    if(!isset($_SESSION['number1']))
    {
       header("location:../logout.php");
        exit();
      }
    $sqlq="";

    $sessionNum=$_SESSION["number1"];
    $name="";

 ?>



        <div class="wrapper">
            <!-- Sidebar Holder -->
            <nav id="sidebar">
                <div class="sidebar-header">
                  <?php
                    $result=mysqli_query($con,("SELECT Name FROM hotel1.customer WHERE MobileNumber='{$sessionNum}' "));
                    while($row=mysqli_fetch_array($result)){
                        echo "<h3>Hello ".$row['Name']."</h3>";
                      }?>
                </div>

                <ul class="list-unstyled components">
                    <p>You'r Logged in with <?php echo $sessionNum ?></p>
                    <li class="active">
                        <a href="customerform.php">Home</a>

                    </li>
                    <li>
                        <a href="aboutpage.html" target="_blank">About Us</a>
                        <a href="http://www.facebook.com/Aatifff" target="_blank">Contact Us</a>

                    </li>
                    <li>
                        <a href="news.php">News/Updates</a>
                    </li>
                    
                </ul>

                <ul class="list-unstyled CTAs">
                    <li><a href="../logout.php" class="download" >Logout</a></li>

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
                                <li><a  href="../logout.php">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>

<!-- ################################################## -->
<!-- ###########MODAL################################ -->


<!-- Trigger the modal with a button -->


<!-- Modal -->




                <?php
                $sessionNum=$_SESSION["number1"];
                date_default_timezone_set("Asia/Karachi");
                echo "<p align='right'>Date:".$date1=date('Y-m-d')."</p>";
                ?>


                <?php

            //    echo $_SESSION["number1"];
                $sessionNum=$_SESSION["number1"];
                // remove all session variables

                if (isset($_POST["list"]) )
                	{
                	if(!empty($_POST["address"])){
                		$address=$_POST["address"];
                		if(!empty($_POST["comments"])){
                			$Comments=$_POST["comments"];
                		}else{
                			$Comments=NULL;
                		}

                		$listof=($_POST["list"]);


                		//---------------------used  for dish quantity---------//

                		//echo "show the quanitty".$_POST["numlist"]  ."<br>";
                		$b=array(); // array for quantity
                		foreach($_POST["numlist"] as $liist){

                		//echo "show the quanitty". $liist ."<br>";
                		array_push($b,$liist);


                		}


                	//--------------------used for menuid--------------------//

                	$a=array(); //array for dish id
                	foreach($_POST["list"] as $liist){

                		$echo1 = mysqli_query($con,"SELECT * FROM hotel1.menu WHERE MenuId=$liist" );
                		while ($row = $echo1->fetch_assoc()) {
                		array_push($a,$row['MenuId']);  //only store the MenuId of each dish

                		}

                	}





                	$order=mysqli_query($con,"SELECT OrderId from hotel1.customerorder WHERE OrderId= (select max(OrderId) from customerorder) ");
                	$row = $order->fetch_assoc();
                	$orderid=$row['OrderId'];


                   // echo '<pre>'; print_r($a); echo '</pre>';
                   // echo '<pre>'; print_r($b); echo '</pre>';
                	 //-------------------------insert into the bill table----------------------------------//


                	$total=0;  //store the total amount
                	 for($i=0;$i<sizeof($a);$i++){
                		 $val=$a[$i]  ;		//return the menu id
                		$quan=$b[$val-1] ;  //return the quantity

                		 mysqli_query($con,"INSERT INTO bill (orderid,MenuId,DishQuantity)VALUES('$orderid','$val','$quan')");	 //store quantity and menu id
                		$insertvalue=mysqli_query($con,"SELECT * FROM hotel1.menu where MenuId='{$val}'");

                		while ($row = $insertvalue->fetch_assoc()) {
                		 $row['Price']."<br>";
                		 $tval=($row['Price']*$quan);  //total of each Dish with its quantity
                		$total+=$tval;  //total amount
                		}
                  }

                	$insert=mysqli_query($con,"INSERT INTO hotel1.customerorder ( Total,Comment,Date,Status,Address,MobileNumber)
                	VALUES ('$total', '$Comments','$date1','pending','$address', '$sessionNum')");
                	if (($insert) === TRUE) {
                      echo "Order Successfuly Placed";
                			}else {
                		echo "Error Occured  : " . $sqlq . "<br>" . mysqli_error($con);
                			}

                }else{  echo "<p style=\"color:red\">"."Please enter the address"."</p>";}
                	}
                
                if ( isset($_POST["submitcomplaint"]) &&(!empty($_POST["complaint"]))){
                	$cusComplaint=$_POST["complaint"];
                	$insert=mysqli_query($con,"INSERT INTO hotel1.customercomplaint ( MobileNumber,Text,Date)
                	VALUES ('$sessionNum', '$cusComplaint','$date1')");
                    
                   $row_c=mysqli_fetch_array(mysqli_query($con,"SELECT max(Id) FROM hotel1.customercomplaint"));
          
                	}

                ?>
          
<style>

    
#myVideo {
    position: fixed;
  top: 50%;
  left: 50%;
  min-width: 100%;
  min-height: 100%;
  width: auto;
  height: auto;
  z-index: -100;
  transform: translate(-50%, -50%);}

</style>      
      
<script>
var video = document.getElementById("myVideo");
</script>          
                
                
<div class="row">
    <video autoplay muted loop id="myVideo">
    
  <source src="Quay%20Restaurant%20Sydney%20-%20YouTube.MP4" type="video/mp4">
</video>


  <div class="col-md-6">

                <h2> Place Your Order</h2>
                <form action="customerform.php" method="POST" id="my_form">

                 <?php
                $sql=mysqli_query($con, "SELECT * FROM `menu`  ");?>
                <table class="table">
                  <tr>
                    <th>Item Names</th>
                	   <th>Quantity</th>
                	    <th>Price</th>
                    </tr>
                	<br>
                 <?php   while($record = mysqli_fetch_array($sql)) {	 ?>
                       <tr><td width="70%"><input type="checkbox" name="list[]" value="<?php echo $record['MenuId'] ?>" >  <?php echo $record['DishName']; ?></td>
                	 <td width="30%">  <input type="number" name="numlist[]" value="1" min="1"   style="width:35px;text-align:right;"  > </td>
                   <td width="30%">
                	   <?php echo $record['Price'];?>
                	  </td>
                    <?php
 }
?>      	   <br></tr>
                  <tr><td>Comment Box</td>
                <td><textarea name="comments" placeholder="Enter your comments"></textarea></td></tr>
                <tr><td>Current Address</td><td><textarea name="address" placeholder="Address for Delivery"></textarea></td></tr>
                    
                <tr><td><input type="submit" value="submit" name="submit"></td> <td><a style=" color:black ;border:2px solid black ;padding:2px;"href="#" onclick="pop_up('../pdf/billReport.php?id=<?php echo $orderid?>&mob=<?php echo $sessionNum?>');">Generate Invoice</a></td></tr></table>
                </form>


</div>
<div class="col-md-6" style="border-left:1px dashed gray">
  <table class="table">


                <form action="customerform.php" method="POST">

                <h2> Suggesstion Box/Complaint Box</h2> <br><br>
                <tr><td>Your Complaint</td><td> <textarea rows="5" cols="50" name="complaint" placeholder="Suggesstions/Complaints"></textarea></td></tr>
                <tr><td></td><td><input type="submit" value="submit" name="submitcomplaint"></td>
                <tr><td colspan="2"><?php if(isset($_POST["submitcomplaint"])){ echo "Your Complaint have been received! Token # ".$row_c['max(Id)']; }?></td></tr>
                </form>
  </table>

                <h2> Your Previous 5 Orders</h2> <br>
                <table class="table">
                  <tr><th>Order ID</th>
                <th> <mid><b> Total Amount</b> </mid></th> <br>
                <?php

                 $prevorder=mysqli_query($con,"select * from customerorder where MobileNumber=$sessionNum order by OrderId desc limit 5");
                 while($record = mysqli_fetch_array($prevorder)) {
                       echo "<tr><td>".$record['OrderId']."</td>";
                	    //  echo  str_repeat('&nbsp;', 26);
                	       echo "<td>".$record['Total'] ."</td></tr>";
                   }

                 ?></table>
               </div>
</div>




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
