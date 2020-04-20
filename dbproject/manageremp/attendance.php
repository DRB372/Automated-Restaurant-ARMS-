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

    <style>
    .h:hover{background-color:#ffd5d5}

    </style>
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
                        <li><a href="add.php">Add/Edit/Delete</a></li>
                        <li><a href="#" style="background:white;color:#6d7fcc;">Attendance</a></li>
                    </ul>
                </li>
                <li>
                    <a href="../orders/orders.php">Orders</a>
                    <a href="">Inventory</a>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Menu Items</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li><a href="../logout.php">Add/Update/Delete</a></li>
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
            date_default_timezone_set('Asia/karachi');
                                $date=date("Y-m-d");
            if(isset($_POST['submit'])) {

                foreach ($_POST['attendence_status'] as $id => $attendence_status) {
                    //  $student_name=$_POST['student_name'][$id];
                    $Cnic=$_POST['student_name'][$id];
                   

                    //    echo $Cnic." ".$date;
                    $sql=mysqli_query($con,"insert into hotel1.attendance (Cnic,Date,attendance_status ) values('{$Cnic}','{$date}','$attendence_status')");

                }
                if($sql==true){
                    echo "Successfully Entered";
                }else {
                    echo "<span style=\"color:red\">"."Today's Attendance is already marked"."</span>";
                }
            }
            ?>
            <h2>Attendance</h2>
            <?php echo "<h2 align=\"center\">" .date("d-m-Y") ."</h2><br>"?>
            <?php
            include("../connect.php");
            $report = mysqli_query($con,"SELECT * FROM employee") or die(mysql_error());
            ?>
            <form action="" method="post">
                <table id = "attendance" class='table'>
                    <tr>
                        <th width="83" scope="col">ID</th>
                        <th width="55" scope="col">Name</th>
                        <th width="51" scope="col">Attendance</th>
                    </tr>
                    <?php
                    $counter=0;
                    while(list($id, $name, $rollno) = mysqli_fetch_row($report))
                    {
                        ?>
                        <tr class="h">
                            <td><?php echo $id ?></td>
                            <input type="hidden" value="<?php echo $id;?>" name="student_name[]">
                            <td><?php echo $rollno ?></td>
                            <input type="hidden" value="<?php echo $rollno;?>" name="cnic[]">
                            <td><input type="radio" name="attendence_status[<?php echo $counter;?>]" value="present"  checked/>Present
                                <input type="radio" name="attendence_status[<?php echo $counter;?>]" value="absent" />Absent
                            </td>
                        </tr>
                        <?php
                        $counter++;
                    } ?>
                </table>
                <input type="submit" name ="submit"  id="submit" value ="submit"></input>
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
