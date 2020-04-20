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
  $sqlq=$price=$dishid=$dishname="";
  $nameErr = $emailErr =  $emailErr1="";
  if(isset($_POST["submitd"])){
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
//name
    if (empty($_POST["dishname"])) {
      $nameErr = "Name is also required";
    } else {
      $dishname = ($_POST["dishname"]);
    }
    if (empty($_POST["dishid"])) {
      $emailErr1 = "dishid is also required";
    } else {
      $dishid = ($_POST["dishid"]);
    }
     if (empty($_POST["price"])) {
       $emailErr = "price are also required";
     } else {
       $price = ($_POST["price"]);
     }
echo $price,$dishname,$dishid;
        $insertvalue=("UPDATE hotel1.menu SET DishName='{$dishname}',Price='{$price}' WHERE MenuId='{$dishid}'");
     //'{$encryptpass}'
     if ($con->query($insertvalue) === TRUE) {
            echo "<script type='text/javascript'>alert('Successful Updated !!')</script>";
       }else {
     echo "Error Occured  : " . $sqlq . "<br>" . mysqli_error($con);
   }

    }
  }
   ?>
  <?php header('Location: '.'add.php');?>

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
