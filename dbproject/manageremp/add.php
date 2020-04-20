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
                        <a href="../inventory/inventory.php">Inventory</a>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Menu Items</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li><a href="menuitems/add.php">Add New</a></li>
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

                <h2>Add Empoyees</h2>
                <p>
                  <?php
                include("../connect.php");
                // ---------Validation Checks on data------------------//
                $sqlq=$hours=$name =$err= $email = $gender  = $website = $Dish1 = $Dish2= $Dish3= $mypass=$cnic="";
                $nameErr = $emailErr = $genderErr = $websiteErr = $errDish1= $errDish2= $errDish3 =$role=$shift=$errpass="";
                if(isset($_POST["submit"])){
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

                	if (empty($_POST["mypass"]))  {
                    $errpass= "Password is also required";
                	} else {
                     $mypass = ($_POST["mypass"]);
                	}

                	if (empty($_POST["role"]) )  {            //dish 1
                    $errDish1 = ($_POST["role"]);
                	} else {
                    $role = ($_POST["role"]);
                	 }

                   if (empty($_POST["mynumber"])) {
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
                   if(!empty($name) && !empty($gender) && !empty($number) && !empty($mypass)) {
                     $checkno= mysqli_query($con,"SELECT * FROM hotel1.employee WHERE Cnic='$cnic'");
                       if(mysqli_num_rows($checkno)>0){
                         echo "<script type='text/javascript'>alert('This CNIC is already register!!')</script>";
                         goto a;
                       }}
    $encryptpass=md5($mypass);
                        
                       
                       if(!empty($_FILES['fileToUpload']))
  {
    $path = "../";
    $path = $path . basename( $_FILES['fileToUpload']['name']);

    if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $path)) {
      echo "The file ".  basename( $_FILES['fileToUpload']['name']). 
      " has been uploaded";
    } else{
        echo "There was an error uploading the file, please try again!";
    }
  }
                      // $target_dir = "C:/xampp/htdocs/dbproject/pdf";
                     //  $target_file = $target_dir . basename( $_FILES['image']['name']);
                     //  move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
                    //   move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                      $insertvalue=("INSERT INTO hotel1.employee(Cnic,PhoneNumber,Name,Gender,Job,Hours,Shift,filename,path) VALUES ('{$cnic}','{$number}','{$name}','{$gender}','{$role}','{$hours}','{$shift}','".$_FILES["fileToUpload"]["name"]."','".$path."')");
                   //'{$encryptpass}'

                   if ($con->query($insertvalue) === TRUE) {
                     }else {
                   echo "Error Occured ðŸ˜ž : " . $sqlq . "<br>" . mysqli_error($con);
                 }
                 $status="employee";
                   //----------------inset in login form --------------------//
                  $Logindata=("INSERT INTO hotel1.login(Mnumber,Password,Status) VALUES('{$number}','{$encryptpass}','{$status}') ");


                   if ($con->query($Logindata) === TRUE) {
                     }else {
                   echo "Error Occured in login form ðŸ˜ž : " . $sqlq . "<br>" . mysqli_error($con);
                   }

                   echo "<script type='text/javascript'>alert('successful data is entered !!')</script>";



                  }
                  a:
                }
                
                  ?>
                <h2>Enter Employee's credentials</h2>
<div class="row">
<div class="col-md-6">
<table class="table">
                <form class="form-group" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
              <tr>
                  <td>  Name:*</td>
              <td>
                 <input class="form-control" type="text" name="name" placeholder="Enter Employee's Name" required maxlength="20">
                <span class="error"> <?php echo $nameErr;?></span>
              </td>
            </tr>
              <tr>
                <td>    Mobile Number:*</td>
                <td>
                  <input class="form-control" type="text" name="mynumber" maxlength="11" placeholder="03XXXXXXX"  required pattern="[0-9]{11}" >
                  <span class="error"> <?php echo $emailErr;?></span>
                </td>
              </tr>
                <tr>
                  <td>CNIC:*
                  </td>
              <td>
                    <input class="form-control" type="text" name="cnic" placeholder="Enter CNIC without dashes" required pattern="[0-9]{13}" maxlength="13">
                  <span class="error"> <?php echo $emailErr;?></span>
                </td>
              </tr>

                <tr>
                  <td>  Gender:*</td>
                <td>  <input  type="radio" name="gender" value="F">Female
                  <input  type="radio" name="gender" value="M">Male
                  <span style="color:red"> <?php echo $genderErr;?></span>
                </td>
              </tr>

                  <br>
              <tr>
                <td>    Job/Role:*</td>
              <td>  <select class="form-control" name="role" required>

                 <option value="">select the option</option>
                 <option value="Chef">Chef</option>
                 <option value="Receptionist">Receptionist</option>
                 <option value="Waiter">Waiter</option>
                 <option value="Security">Security</option>
               </select>
             </td>
             </tr>
              <tr>
                <td> Hours:</td>
                <td>   <input class="form-control" type="number" name="hours" placeholder="Enter Number of Hours per Shift" min="1" max="24" required></td></tr>
              <tr>
                <td> Shift:*</td>
                <td> <select class="form-control" name="shift" required>
                  <option value="">select the option</option>
                  <option value="Morning">Morning</option>
                  <option value="Evening">Evening</option>
                </select>
              </td><tr>

                <tr><td>  Password:*</td><td> <input class="form-control" type="password" name="mypass" placeholder="Password" >
                  <span class="error"> <?php echo $errpass;?></span></td></tr>


                 <tr><td> <input type="file" name="fileToUpload" id="fileToUpload" /></td></tr>
                <br />



                  <br>
                <tr><td>  <input class="btn btn-info navbar-btn" type="submit" name="submit" value="Submit"></td></tr>
                </form>
</table></p>
    
        <?php
include("../connect.php");
// ---------Validation Checks on data------------------//
$sqlq=$nameErr = $emailErr="";
if(isset($_POST["delete"])){
if ($_SERVER["REQUEST_METHOD"] == "POST") {
//name
    if (empty($_POST["del"])) {
      $nameErr = "CNIC is also required";
    } else {
      $delete = ($_POST["del"]);
  }
    if(!empty($delete)) {
//  $con->query("SET FOREIGN_KEY_CHECKS=0");
     $insertvalue=("DELETE FROM hotel1.employee WHERE Cnic='{$delete}'");

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
}
}
}
  ?>

    <h2>Delete Employee</h2>
          <table class="table">
            <form submit="" method="post">
            Enter Employee's CNIC to Delete:*
            <input class="form-control" type="text" name="del" placeholder="Enter CNIC Without Dashes" required>
            <input class="btn btn-info navbar-btn" type="submit" name="delete" value="Confirm Deletion">
          </form>
          </table>
        
    
</div>
<div class="col-md-6">
<br>
<br>
                <table class='table' cellpadding="10">
                <tr>
                <td>CNIC</td>
                <td>Phone Number</td>
                <td>Name</td>
                <!-- <td>Gender</td>
                <td>Job</td>
                <td>Hours</td> -->
                <td>Shift</td>
                </tr>
<?php
                $query="SELECT * FROM hotel1.employee";
                $result=mysqli_query($con,$query);
                while ($row=mysqli_fetch_assoc($result)){
              //  echo "<table class='table' style='padding:5px;'>";
                echo ("<tr><td>$row[Cnic]</td>");
                echo ("<td>+92-$row[PhoneNumber]\t</td>");
                echo ("<td>$row[Name]\t</td>");
                echo ("<td>$row[Gender]\t</td>");
                // echo ("<td>$row[Job]\t</td>");
                // echo ("<td>$row[Hours]\t</td>");
                // echo ("<td>$row[Shift]\t</td>");
                echo ("<td><a href=\"EmpEdit.php?id=$row[Cnic]\" style='color:#5bc0de'>Edit</a></td></tr>");
            //    echo "<br>";
                }
                echo "</table>";
?>
</div>
</div>
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
