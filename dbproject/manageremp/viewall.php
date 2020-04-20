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
                    <li class="active">
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Employees</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li><a style="background:white;color:#6d7fcc;" href="#">View All Empoyees</a></li>
                            <li><a href="add.php">Add/Edit/Delete</a></li>
                            <li><a href="#">Attendance</a></li>
                        </ul>
                    </li>

                      <li>
                          <a href="#">Inventory</a>
                      </li>
                      <li>
                        <a href="#">Orders</a>
                      </li>
                      <li>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Menu Items</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li><a href="../logout.php">Add new</a></li>

                        </ul>
                    </li>
                    <li>
                        <a href="#">Customers</a>
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
                                <!-- <li><a href="#">Page</a></li> -->
                                <!-- <li><a href="#">Page</a></li> -->
                                <!-- <li><a href="#">Page</a></li> -->
                            </ul>
                        </div>
                    </div>
                </nav>

        <h2>All Employees</h2>
                <div class="panel panel-default">

                  <div class="panel-heading">Empoyees</div>

                  <!-- Table -->
                  <table class="table">
                            <thead>
                              <tr class="table-primary">
                                  <th>CNIC</th>
                                  <th>Phone Number</th>
                                  <th>Name</th>
                                  <th>Gender</th>
                                  <th>Job</th>
                                  <th>Hours</th>
                                  <th>Shift</th>
                              </tr>
                            </thead>





              <?php
                include("../connect.php");
                  $sql = "SELECT* FROM employee";
                  $result = mysqli_query($con, $sql);

                    if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                      while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr><td>{$row['Cnic']}</td><td>+92-{$row['PhoneNumber']}</td><td>{$row['Name']}</td><td>{$row['Gender']}</td><td>{$row['Job']}</td><td>{$row['Hours']}</td><td>{$row['Shift']}</td></tr>\n";
                    }
                } else {
                    echo "0 results";
                }
                ?>

              </tbody>

              </table>
  </div>
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
