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


    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>



    <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3><a href="employee.php">Empoyee Page</a></h3>
            </div>

            <ul class="list-unstyled components">
                <p>ARMS</p>
                <li>
                    <a href="#">Home</a>
                </li>
                <li class="active">
                    <a href="">Attendance</a>
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
<?php

    $res=mysqli_query($con,"select Cnic from Employee where PhoneNumber='$sessionNum'");
    $cnic=mysqli_fetch_array($res);

 ?>

            <!-- <h2>Pending Orders</h2> <br> -->
                    <form class="form-group" action="pdf/attendanceEmployee.php" method="post" target="_blank"9>

                    <table class="table" style="width:100%">
                         <tr>
                             <td>Select Month & Year to Generate Salary Report</td>
                         <td   align="right">    <input class="form-control" type="text" name="cnic" value="<?php echo $cnic['Cnic']?>" readonly="true">
                             <select id="month" class="form-control" name="month" required >
                              <option value="">Month</option>
                              <option value="1">Januray</option>
                              <option value="2">February</option>
                              <option value="3">March</option>
                              <option value="4">Aprilt</option>
                              <option value="5">May</option>
                              <option value="6">June</option>
                              <option value="7">July</option>
                              <option value="8">Augest</option>
                              <option value="9">September</option>
                              <option value="10">October</option>
                              <option value="11">November</option>
                              <option value="12">December</option>
         </select>
                             <select class="form-control" name="year" required>
                              <option value="">Year</option>

                              <option value="2018">2018</option>
                          </select>

                            <input type="submit"  name="submit" value="Generate"></td>
                         </tr>
                    </table>


                                   </form>



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
