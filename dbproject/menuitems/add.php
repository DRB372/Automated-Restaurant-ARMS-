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

        <title>Manager Dashboard</title>

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
                            <li><a href="../manageremp/add.php">Add/Edit/Delete</a></li>
                            <li><a href="#">Attendance</a></li>
                        </ul>
                    </li>
                      <li>
                        <a href="orders/orders.php">Orders</a>
                      </li>
                      <li>
                        <a href="#">Inventory</a></li>
                        <li class="active">
                        <a href="../menuitems/add.php">Menu Items</a>

                    </li>
                    <li>
                        <a href="../cust.php">Customers</a>
                    </li>
                    <li>
                      <!-- <a href="#">Reports</a> -->
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
                                <!-- <li><a href="#"></a></li>
                                <li><a href="#"></a></li>
                                <li><a href="#"></a></li> -->
                            </ul>
                        </div>
                    </div>
                </nav>

                <h2 align="center">ARMS MENU</h2>
                <?php
              include("../connect.php");
              // ---------Validation Checks on data------------------//
              $sqlq=$nameErr = $emailErr="";
              if(isset($_POST["submit1"])){
              if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (empty($_POST["dishname"])) {
                  $nameErr = "Name is also required";
                } else {
                  $dishname = ($_POST["dishname"]);
                }

                if (empty($_POST["price"])) {
                  $emailErr = "Price is also required";
                } else {
                  $price = ($_POST["price"]);
                }

                 //------------------insert data in database---------------------------//
                 if(!empty($dishname) && !empty($price)) {
                    $insertvalue=("INSERT INTO hotel1.menu(DishName,Price) VALUES ('{$dishname}','{$price}')");
                 if ($con->query($insertvalue) === TRUE) {

                   }else {
                 echo "Field are Empty or This Error Occured : " . $sqlq . "<br>" . mysqli_error($con);
               }
               echo "<script type='text/javascript'>alert('successful data is entered !!')</script>";
}
$price=$dishname="";
}
}

          ?>
<div class="row">
        <div class="col-md-6">      <h2>Add Menu Details</h2>
<table class="table" style="width:100%">
              <form class="form-group" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <tr>
                <td> Dish Name:*</td>
            <td>
               <input class="form-control" type="text" name="dishname" placeholder="Enter Dish Name" maxlength="20">
              <span class="error"> <?php echo $nameErr;?></span>
            </td>
          </tr>
            <tr>
              <td>Price Per Unit (Rs)*</td>
              <td>
                <input class="form-control" type="number" name="price" placeholder="e.g 120">
                <span class="error"> <?php echo $emailErr;?></span>
              </td>
                <br>
              <tr><td>  <input class="btn btn-info navbar-btn" type="submit" name="submit1" value="Submit"></td></tr>
              </form>
</table>
<!-- DELEETE -->
<?php
include("../connect.php");
// ---------Validation Checks on data------------------//
$sqlq=$nameErr = $emailErr="";
if(isset($_POST["delete"])){
if ($_SERVER["REQUEST_METHOD"] == "POST") {
//name
    if (empty($_POST["del"])) {
      $nameErr = "ID is also required";
    } else {
      $delete = ($_POST["del"]);
  }
    if(!empty($delete)) {
  $con->query("SET FOREIGN_KEY_CHECKS=0");
     $insertvalue=("DELETE FROM hotel1.menu WHERE MenuId='{$delete}'");
  $con->query("SET FOREIGN_KEY_CHECKS=1");
  if ($con->query($insertvalue) === TRUE) {
      if(mysqli_affected_rows($con)==0)
      {
        echo "<script type='text/javascript'>alert('No Menu Item corresponding to This ID found')</script>"; goto a;
      }
        echo "<script type='text/javascript'>alert('DELETED Successfuly !!')</script>";
        $con->query("ALTER TABLE menu AUTO_INCREMENT = 1");
    }
  else {
  echo "Field are Empty or This Error Occured : " . $sqlq . "<br>" . mysqli_error($con);
}
a:
}
}
}
  ?>
          <h2>Delete Menu Item</h2>
          <table class="table">
            <form submit="" method="post">
            Enter Menu ID to Delete:*
            <input class="form-control" type="number" name="del" placeholder="Enter Menu ID e.g 2">
            <input class="btn btn-info navbar-btn" type="submit" name="delete" value="Confirm Deletion">
          </form>
          </table>
 </div>
  <div class="col-md-6">  <h2>Menu List</h2>
                <table class='table' cellpadding="10" style="width:100%">
                <tr>
                <td>Dish ID</td>
                <td>Dish Name</td>
                <td>Unit Price(Rs)</td>
                </tr>
              <?php
                $query="SELECT * FROM hotel1.menu";
                $result=mysqli_query($con,$query);
                while ($row=mysqli_fetch_assoc($result)){
              //  echo "<table class='table' style='padding:5px;'>";
                echo ("<tr><td>$row[MenuId]</td>");
                echo ("<td>$row[DishName]\t</td>");
                echo ("<td>$row[Price]\t</td>");
                echo ("<td><a href=\"MenuEdit.php?id=$row[MenuId]\" style='color:#5bc0de'>Edit</a></td></tr>");
              }
              echo "<br>"

              ?>
            </table>

                </div>

</div>
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
