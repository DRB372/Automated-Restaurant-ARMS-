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


         <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="../styles.css">
    </head>
    <body>

        <div class="wrapper">
            <!-- Sidebar Holder -->
            <nav id="sidebar">
                <div class="sidebar-header">
               <h3>Manager Dashboard</h3>
                </div>

                <ul class="list-unstyled components">
                    <p>ARMS</p>
                    <li>
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Employees</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li><a href="manageremp/viewall.php">View All Empoyees</a></li>
                            <li><a href="manageremp/add.php">Add/Edit/Delete</a></li>
                            <li><a href="#">Attendance</a></li>
                        </ul>
                    </li>
                    <li>  <a href="#">Inventory</a></li>

                      <li>
                        <a href="orders/orders.php">Orders</a>
                      </li>
                      <li>
                        <a href="#">Inventory</a></li>
                        <li class="active">
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Menu Items</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li><a href="add.php">Add new</a></li>
                            <li><a href="edit.php">Edit/Delete</a></li>
                            <li><a style="background:white;color:#6d7fcc;" href="recipies.php">Recipies</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Customers</a>
                    </li>
                    <li>
                      <!-- <a href="#">Reports</a> -->
                      <a href="#reportsSubmenu" data-toggle="collapse" aria-expanded="false">Reports</a>
                      <ul class="collapse list-unstyled" id="reportsSubmenu">
                        <li><a href="">Sales</a></li>
                        <li><a href="#">Attendance</a></li>
                        <li><a href="#">Inventory</a></li>
                      </ul>
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


                <div class="line"></div>

                <h2></h2>
                <p>other detials,</p>
                <h2></h2>
                <p>complaints here</p>
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
