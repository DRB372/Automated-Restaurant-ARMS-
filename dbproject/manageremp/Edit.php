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
  $sqlq=$hours=$name =$err= $email = $gender  = $website = $Dish1 = $Dish2= $Dish3= $mypass=$cnic="";
  $nameErr = $emailErr = $genderErr = $websiteErr = $errDish1= $errDish2= $errDish3 =$role=$shift=$errpass="";
  if(isset($_POST["submit11"])){
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
//name
    if (empty($_POST["name"])) {
      $nameErr = "Name is also required";
    } else {
      $name = ($_POST["name"]);
    }

    if (empty($_POST["mynumber"])) {
      $emailErr = "Number is also required";
    } else {
      $number = ($_POST["mynumber"]);
    }
    if (empty($_POST["cnic"])) {
      $emailErr = "CNIC is also required";
    } else {
      $cnic = ($_POST["cnic"]);
    }
    if (empty($_POST["gender"]))  {
      $genderErr = "Gender is also required";
    } else {
      $gender = ($_POST["gender"]);
    }


    if (empty($_POST["role"]) )  {            //dish 1
      $errDish1 = ($_POST["role"]);
    } else {
      $role = ($_POST["role"]);
     }

     if (empty($_POST["hours"])) {
       $emailErr = "Hours are also required";
     } else {
       $hours = ($_POST["hours"]);
     }

     if (empty($_POST["shift"]) )  {        //dish2
      $errDish2 = ($_POST["shift"]);
    } else {
      $shift = ($_POST["shift"]);
     }

     //------------------insert data in database---------------------------//
     // if(!empty($name) && !empty($gender) && !empty($number)) {
     //   $checkno= mysqli_query($con,"SELECT * FROM hotel1.employee WHERE Cnic='$cnic'");
     //     if(mysqli_num_rows($checkno)>0){
     //       echo "<script type='text/javascript'>alert('This CNIC is already register!!')</script>";
     //       goto a;
     //     }
     //echo $mynumber;
       $insertvalue=("UPDATE hotel1.employee SET PhoneNumber='{$number}',Name='{$name}',Gender='{$gender}',Job='{$role}',Hours='{$hours}',Shift='{$shift}' WHERE Cnic='{$cnic}'");

    if ($con->query($insertvalue) === TRUE) {
      }else {
    echo "Error Occured  : " . $sqlq . "<br>" . mysqli_error($con);
  }
     echo "<script type='text/javascript'>alert('successful data is entered !!')</script>";
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
