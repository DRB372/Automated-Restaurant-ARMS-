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

       <title>
    ARMS
    </title>
    <link rel="icon" href="https://www.birchstreetsystems.com/wp-content/uploads/2016/04/restaurant-icon-2.png">
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
               <h3><a href="../manager.php">Manager Dashboard</a></h3>
                </div>

                <ul class="list-unstyled components">
                    <p>ARMS</p>
                    <li class="active">
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Employees</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li><a href="viewall.php">View All Empoyees</a></li>
                            <li><a href="#" style="background:white;color:#6d7fcc;">Add/Edit/Delete</a></li>
                            <li><a href="#">Attendance</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Orders</a>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Menu Items</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li><a href="../logout.php">Logout</a></li>
                            <!-- <li><a href="#">Page 2</a></li> -->
                            <!-- <li><a href="#">Page 3</a></li> -->
                        </ul>
                    </li>
                    <li>
                        <a href="../cust.php">Customers</a>
                    </li>
                    <li>
                      <a href="../reports.php">Reports</a>
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
                                <li><a href="../logout.php">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>

   <?php
                   include("../connect.php");
                   $cnic = $_GET['id'];
                   $query = "SELECT * FROM hotel1.employee WHERE Cnic = '$cnic'";
                   $result = mysqli_query($con,$query);
                   $row = mysqli_fetch_array($result);
     ?>
  <form method="post" action="edit.php"/>

  <table>

  <tr>
  <td>CNIC:</td>
  <td><input type="number" name="cnic" value="<?php echo $row['Cnic'] ?>"></td>
  </tr>

  <tr>
  <td>Phone Number:</td>
  <td><input type="number" name="mynumber" value="<?php echo $row['PhoneNumber'] ?>"></td>
  </tr>

  <tr>
  <td>Name:</td>
  <td><input type="text" name="name" value="<?php echo $row['Name'] ?>"></td>
  </tr>

  <tr>
  <td>Gender:</td>
  <td><input type="text" name="gender" value="<?php echo $row['Gender'] ?>"></td>
  </tr>

  <tr>
  <td>Job:</td>
  <td><input type="text" name="role" value="<?php echo $row['Job'] ?>"></td>
  </tr>
  <tr>
  <td>Hours:</td>
  <td><input type="number" name="hours" value="<?php echo $row['Hours'] ?>"></td>
  </tr>

  <tr>
  <td>Shift:</td>
  <td><input type="text" name="shift" value="<?php echo $row['Shift'] ?>"></td>
  </tr>
  </table>
<input type="submit" name="submit11" value="Finish Edit">
  </form>

                <div class="line"></div>

                <div class="line"></div>

                <p>-------------------------------------------------Automated Restaurant Management System--------------------------------------------------</p>

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
