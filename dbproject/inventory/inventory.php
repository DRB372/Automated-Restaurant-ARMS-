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
                            <li><a href="../manageremp/add.php">Add/Edit/Delete</a></li>
                            <li><a href="../manageremp/attendance.php">Attendance</a></li>
                        </ul>
                    </li>
                    <li class="active">  <a href="#">Inventory</a></li>

                      <li>
                        <a href="../orders/orders.php">Orders</a>
                      </li>
                      <li>

                        <a href="../menuitem/add.php">Menu Items</a>
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

                <h1 align="center">Inventory</h1>
                <?php
              include("../connect.php");
              // ---------Validation Checks on data------------------//
              $sqlq=$nameErr = $emailErr=$units=$price=$qty=$itemname="";
              if(isset($_POST["submit1"])){
              if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (empty($_POST["itemname"])) {
                  $nameErr = "Name is also required";
                } else {
                  $itemname = ($_POST["itemname"]);
                }

                if (empty($_POST["price"])) {
                  $emailErr = "Price is also required";
                } else {
                  $price = ($_POST["price"]);
                }

                if (empty($_POST["qty"])) {
                  $emailErr = "required";
                } else {
                  $qty = ($_POST["qty"]);
                }

                if (empty($_POST["units"])) {
                  $emailErr = "required";
                } else {
                  $units = ($_POST["units"]);
                }
                 //------------------insert data in database---------------------------//
                 if(!empty($itemname) && !empty($price) && !empty($units) && !empty($qty)) {
                    $insertvalue=("INSERT INTO hotel1.inventory(ItemName,ItemQuantity,ItemPrice,ItemUnit) VALUES ('{$itemname}','{$qty}','{$price}','{$units}')");
                 if ($con->query($insertvalue) === TRUE) {
                      echo "<script type='text/javascript'>alert('Item Successfuly Added !!')</script>";
                   }
                 else {
                 echo "Field are Empty or This Error Occured : " . $sqlq . "<br>" . mysqli_error($con);
               }

}
}
}

          ?>
<div class="row">
        <div class="col-md-6">      <h2>Add Item Details</h2>
<table class="table" style="width:100%">
              <form class="form-group" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <tr>
                <td> Item Name:*</td>
            <td>
               <input class="form-control" type="text" name="itemname" placeholder="Enter Item Name" maxlength="20" required>
              <span class="error"> <?php echo $nameErr;?></span>
            </td>
          </tr>

              <tr>
                  <td>Scale/Units:*</td>
              <td>
                 <select name="units" class="form-control" required>
                   <option value="">select units</option>
                   <option value="KG">Kilograms</option>
                   <option value="LTR">Liters</option>
                   <option value="DZ">Dozens</option>
                   <option value="Other">Other</option>
                  </select>
                <span class="error"> <?php echo $emailErr;?></span>
              </td>
            </tr>

              <tr>
                  <td> Quantity:*</td>
              <td>
                 <input class="form-control" type="number" name="qty" placeholder="Enter Qty i.e 2" min="1" required>
                <span class="error"> <?php echo $emailErr;?></span>
              </td>
              </tr>

              <tr>
                <td>Price Per Unit (Rs)*</td>
                <td>
                  <input class="form-control" type="number" name="price" min="1" placeholder="e.g 120" required>
                  <span class="error"> <?php echo $emailErr;?></span>
                </td>
                </tr>

               <br>
              <tr><td>  <input class="btn btn-info navbar-btn" type="submit" name="submit1" value="Submit"></td></tr>
              </form>
</table>

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
//  $con->query("SET FOREIGN_KEY_CHECKS=0");
     $insertvalue=("DELETE FROM hotel1.inventory WHERE ItemNumber='{$delete}'");

  if ($con->query($insertvalue) === TRUE) {
      if(mysqli_affected_rows($con)==0)
      {
        echo "<script type='text/javascript'>alert('No Menu Item corresponding to This ID found')</script>"; goto a;
      }
        echo "<script type='text/javascript'>alert('DELETED Successfuly !!')</script>";
         $con->query("ALTER TABLE hotel1.inventory AUTO_INCREMENT = 1");
    }
  else {
  echo "Field are Empty or This Error Occured : " . $sqlq . "<br>" . mysqli_error($con);
}
a:
}
}
}
  ?>
          <h2>Delete Inventory Item</h2>
          <table class="table">
            <form submit="" method="post">
            Enter Item ID to Delete:*
            <input class="form-control" type="number" name="del" placeholder="Enter Inventory ID e.g 2" required>
            <input class="btn btn-info navbar-btn" type="submit" name="delete" value="Confirm Deletion">
          </form>
          </table>
</div>


<div class="col-md-6">  <h2>Inventory List</h2>
              <table class='table' cellpadding="10" style="width:100%">
              <tr>
              <td>Item ID</td>
              <td>Item Name</td>
              <td>Item Qty</td>
              <td>Unit Price(Rs)</td>
              <td>Units/Scale</td>
              </tr>
            <?php
              $query="SELECT * FROM hotel1.inventory";
              $result=mysqli_query($con,$query);
              while ($row=mysqli_fetch_assoc($result)){
            //  echo "<table class='table' style='padding:5px;'>";
              echo ("<tr><td>$row[ItemNumber]</td>");
              echo ("<td>$row[ItemName]\t</td>");
              echo ("<td>$row[ItemQuantity]\t</td>");
              echo ("<td>$row[ItemUnit]\t</td>");
              echo ("<td><a href=\"itemEdit.php?id=$row[ItemNumber]\" style='color:#5bc0de'>Edit</a></td></tr>");
            }
            echo "<br>"

            ?>
          </table>

        </div></div>
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
