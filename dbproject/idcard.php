<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Manager Dashboard</title>

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
               <h3><a href="manager.php">Manager Dashboard</a></h3>
                </div>

                <ul class="list-unstyled components">
                    <p>ARMS</p>
                    <li>
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Employees</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li><a href="manageremp/viewall.php">View All Empoyees</a></li>
                            <li><a href="manageremp/add.php">Add/Edit/Delete</a></li>
                            <li><a href="manageremp/attendance.php">Attendance</a></li>
                        </ul>
                    </li>
                    <li>  <a href="inventory/inventory.php">Inventory</a></li>

                      <li>
                        <a href="orders/orders.php">Orders</a>
                      </li>
                      <li>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Menu Items</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li><a href="menuitems/add.php">Add new</a></li>

                            <!-- <li><a href="menuitems/recipies.php">Recipies</a></li> -->
                        </ul>
                    </li>
                    <li>
                        <a href="#">Customers</a>
                    </li>
                    <li>
                      <a href="#">Reports</a>
                    </li>
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
                                <li><a href="logout.php">Logout</a></li>
                                <!-- <li><a href="#"></a></li>
                                <li><a href="#"></a></li>
                                <li><a href="#"></a></li> -->
                            </ul>
                        </div>
                    </div>
                </nav>

                <h2>Generate ID Card with QR</h2>

               <form class="form-group" action="pdf/qrCode.php" method="post" target="_blank">

               <table class="table" style="width:100%">
                    <tr>
                        <td>Enter CNIC of Empoyee to Generate ID CARD (QR)</td>
                    <td   align="right">    <input class="form-control" type="text" name="cnic" value="" required placeholder="Enter CNIC without dashes">
                       <input type="submit"  name="submit" value="Generate"></td>
                    </tr>
               </table>
<?php
        if(isset($_POST['submit'])){
            include('connect.php');
            $res=mysqli_query($con,"SELECT * FORM Empoyee");
            $row=mysqli_fetch_assoc($res);
            file_put_contents("pic.jpg", $row['image']);
        }

 ?>

           </form>



                <div class="line"></div>

                <h3></h3>
                  <p>---------------------------------------------Automated Restaurant Management System------------------------------------------------------</p>
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
