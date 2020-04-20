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
               <h3><a href="../manager.php">Manager Dashboard</a></h3>
                </div>

                <ul class="list-unstyled components">
                    <p>ARMS</p>
                    <li>
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Employees</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li><a href="../manageremp/viewall.php">View All Empoyees</a></li>
                            <li><a href="../manageremp/edit.php">Add/Edit/Delete</a></li>
                            <li><a href="#">Attendance</a></li>
                        </ul>
                    </li>
                    <li class="active"> <a href="#">Inventory</a> </li>
                    <li>
                      <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Menu Items</a>
                      <ul class="collapse list-unstyled" id="pageSubmenu">
                          <li><a href="../menuitems/add.php">Add new</a></li>
                          <li><a href="../menuitems/edit.php">Edit/Delete</a></li>
                          <li><a href="../menuitems/recipies.php">Recipies</a></li>
                      </ul>
                  </li>
                    <li>
                        <a href="#">Customers</a>
                    </li>
                    <li>
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
                                <li><a href="../logout.php">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>

   <?php
                   include("../connect.php");
                   $itemNumber = $_GET['id'];
                   $query = "SELECT * FROM hotel1.inventory WHERE ItemNumber = '$itemNumber'";
                   $result = mysqli_query($con,$query);
                   $row = mysqli_fetch_array($result);
     ?>
  <form method="post" action="Editscript.php"/>
  <h3>Boss! You can only Increase the Item Quantity</h3>
  <table>

  <tr>
  <td>Item ID:</td>
  <td><input type="number" name="itemid" value="<?php echo $row['ItemNumber'] ?>" readonly="true"></td>
  </tr>

  <tr>
  <td>Item Name:</td>
  <td><input type="text" name="itemname" value="<?php echo $row['ItemName']?>" readonly="true"></td>
  </tr>

  <tr>
  <td>Unit Price (Rs):</td>
  <td><input type="number" name="price" value="<?php echo $row['ItemPrice']?>" readonly="true"></td>
  </tr>

  <tr>
  <td>Quantity:</td>
  <td><input type="number" name="qty" value="<?php echo $row['ItemQuantity'] ?>" min="<?php echo $row['ItemQuantity']?>"></td>
  </tr>

  <tr>
  <td>Units:</td>
  <td><input type="text" name="units" value="<?php echo $row['ItemUnit'] ?>" readonly="true"></td>
  </tr>

  </table>
<input type="submit" name="submitd" value="Finish Edit">
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
