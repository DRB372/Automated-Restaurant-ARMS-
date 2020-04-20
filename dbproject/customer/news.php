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
        </script>

         <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="../styles.css">
    </head>
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
                        echo "<h3>".$row['Name']."</h3>";
                      }?>
                </div>

                <ul class="list-unstyled components">
                    <p>You'r Logged in with <?php echo $sessionNum ?></p>
                    <li class="active">
                        <a href="customerform.php">Home</a>

                    </li>
                    <li>
                        <a href="../aboutpage.html">About Us</a>
                        <a href="../">Contact Us</a>

                    </li>
                    <li>
                        <a href="#">News/Updates</a>
                    </li>
                </ul>

                <ul class="list-unstyled CTAs">
                    <li><a href="../logout.php" class="download">Sign Out</a></li>
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
                                <li><a href="../logout.php">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>


                <?php
                $sessionNum=$_SESSION["number1"];
                date_default_timezone_set("Asia/Karachi");
                echo "<p align='right'>Date:".$date1=date('Y-m-d')."</p>";
                ?>


                <?php


                $sessionNum=$_SESSION["number1"];
                // remove all session variables
                ?>
                <h3>updates will be posted here</h3>
                <h2> Your Previous 5 Orders</h2> <br>
                <table class="table">
                  <tr><th  style="width:80%">Order ID</th>
                    <th  style="width:100%">  Total Amount</th></tr>
                <?php

                 $prevorder=mysqli_query($con,"select * from customerorder where MobileNumber=$sessionNum order by OrderId desc limit 5");
                 while($record = mysqli_fetch_array($prevorder)) {
                       echo "<tr><td>".$record['OrderId']."</td>";
                	    //  echo  str_repeat('&nbsp;', 26);
                	       echo "<td>".$record['Total'] ."</td></tr>";
                   }

                 ?></table>

<p>--------------------------------------------------------------------ARMS-------------------------------------------------------------------</p>


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
