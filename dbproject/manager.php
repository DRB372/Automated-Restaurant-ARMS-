<!DOCTYPE html>
<html>
    <head>
        <title>
    ARMS
    </title>
    <link rel="icon" href="https://www.birchstreetsystems.com/wp-content/uploads/2016/04/restaurant-icon-2.png">

<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
        <?php
        date_default_timezone_set('Asia/Karachi');

        $date1=date("Y-m-d");
    //    echo $date1;
//include 'registration.css';
include 'connect.php';
//include 'signin.css';
 $queryatt  = mysqli_query($con,"SELECT COUNT(Cnic) FROM hotel1.attendance WHERE Date='$date1' and attendance_status='present'");
 //$query1 = mysqli_query($conn,"SELECT *,count(*) as number from customerorder where customerorder.Date Between '2017-12-27' AND '2017-12-30' GROUP BY Date ");
 $query2 = mysqli_query($con,"select *, count(orderid) as number,sum(Total) as sum FROM customerOrder  group by customerorder.Date order by Date DESC limit 5");
 $query3 = mysqli_query($con,"select SUM(Total) as sum FROM customerOrder where Date='$date1'");
 //$result = mysqli_query($conn, $query);
 $attc=mysqli_fetch_array($queryatt);
 $sales=mysqli_fetch_array($query3);

 ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          [ 'Sale Per Day', 'Orders','Total'],
		  <?php
            while($row = mysqli_fetch_array($query2))
            {
				echo "['".$row["Date"]."', '".$row["number"]."', '".$row["sum"]."'],";
				//['2014', 1000, 400, 200],
                // echo "['".$row["Gender"]."', ".$row["number"]."],";
            }
            ?>

        ]);

        var options = {
          chart: {
            title: 'Restaurant Total Orders',

          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>


    <?php
  $query = "SELECT MenuId, count(*) as number FROM hotel1.bill GROUP BY MenuId";
 $result = mysqli_query($con, $query);

 ?>


 <?php
 $query2 = mysqli_query($con,"select sum(Total) as sum FROM customerOrder  group by customerorder.Date order by Date");
 ?>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Date', 'Orders', 'Total'],
		  <?php
            while($row = mysqli_fetch_array($query2))
            {
				echo "['".$row["Date"]."', ".$row["number"].", ".$row["Total"]." ],";
				//['2014', 1000, 400, 200],
                // echo "['".$row["Gender"]."', ".$row["number"]."],";
            }
            ?>

        ]);

        var options = {
          chart: {
            title: 'Reataurant Total Sales',
            subtitle: '<?php $date1 ?>',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>


    <?php
     $query = "SELECT Gender, count(*) as number FROM customer GROUP BY gender";
     $result = mysqli_query($con, $query);

     ?>
               <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
               <script type="text/javascript">
               google.charts.load('current', {'packages':['corechart', 'bar']});
               google.charts.setOnLoadCallback(drawChart);
               function drawChart()
               {
                    var data = google.visualization.arrayToDataTable([
                              ['Gender', 'number'],
                              <?php
                              while($row = mysqli_fetch_array($result))
                              {
                                   echo "['".$row["Gender"]."', ".$row["number"]."],";
                              }
                              ?>
                         ]);
                    var options = {
                          title: 'Registration of Male and Female Customers',
                          //is3D:true,
                          pieHole: 0.4
                         };
                    var chart = new google.visualization.PieChart(document.getElementById('piechart1'));
                    chart.draw(data, options);
               }
               </script>


               <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                   <script type="text/javascript">
                     google.charts.load('current', {'packages':['corechart']});
                     google.charts.setOnLoadCallback(drawChart);

                     function drawChart() {

                       var data = google.visualization.arrayToDataTable([
                         ['Task', 'Hours per Day'],
                         <?php

               						$query = "SELECT MenuId, count(*) as number FROM hotel1.bill GROUP BY MenuId";
               						$result = mysqli_query($con, $query);
                                         while($row = mysqli_fetch_array($result))
                                         {
               								$query = mysqli_query($con,"SELECT DishName FROM hotel1.menu where MenuId='$row[MenuId]' ");

               								while ($rows = $query->fetch_assoc()) {

               										echo "['".$rows["DishName"]."', ".$row["number"]."],";
               									}


                                         }
                                         ?>
                       ]);

                       var options = {
                         title: 'Favourite Dishes Analysis'
                       };

                       var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                       chart.draw(data, options);
                     }
                   </script>



        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Manager Dashboard</title>

         <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="styles.css">
        <style>

.col-md-4{
    border-bottom: 1px dashed gray;
}
        .container {
  width:100%;
  text-align:center;
  margin:30px 0;
font-family: 'Raleway', sans-serif;
}

.button {
  display:inline-block;
  height:60px;
  line-height:60px;
  overflow:hidden;
  position:relative;
  text-align:center;
  background-color:#7386d5;
  color:white;
  border-radius:2px;
  transition:0.3s;
  padding: 0;
}

.button:hover {background:#19c664;}

/* BUTTON UP */
.label-up {
  display:block;
  margin:0px 30px;
 height:100%; */
  position:relative;
  top:0%;
  transition:0.3s;
  padding: 50px;
font:'Raleway', sans-serif;
}

.button:hover .label-up {
  top:-100%;
}

/* BUTTON DOWN */
.label-down {
  display:block;
  margin:0px 30px;
  height:100%;
  position:relative;
  top:-100%;
  transition:0.3s;
 font: 'Raleway', sans-serif;
}

.button:hover .label-down {
  top:0%;
}
.container-fluid{
  background-image: url("https://saakshirestaurant.com/img/banner3.png");
  min-height: 120px;
}
          </style>
    </head>
    <body>
        <div class="wrapper">
            <!-- Sidebar Holder -->
            <nav id="sidebar">
                <div class="sidebar-header">
               <h3> Welcome Mr.Daud Butt</h3>
                </div>

                <ul class="list-unstyled components">
                    
                    <li>
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Employees</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li><a href="manageremp/viewall.php">View All Empoyees</a></li>
                            <li><a href="manageremp/add.php">Add/Edit/Delete</a></li>
                            <li><a href="manageremp/attendance.php">Attendance</a></li>
                        </ul>
                    </li>
                    <li>  <a href="inventory/inventory.php">Inventory</a></li>

                      <li>
                        <a href="orders/orders.php">Orders</a>
                      </li>
                      <li>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Menu Items</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li><a href="menuitems/add.php">Add/Edit/Delete</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="cust.php">Customers</a>
                    </li>
                    <li> <a href="reports.php"> Reports</a></li>
                      <!-- <a href="#">Reports</a> -->
                      <ul class="list-unstyled CTAs">
                          <li><a href="idcard.php" class="download">GENERATE QR CODE BASED EMP ID CARD</a></li>
                          <!-- <li><a href="https://bootstrapious.com/p/bootstrap-sidebar" class="article">Back to article</a></li> -->
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
                                <li><button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                                   <span class="glyphicon glyphicon-log-out"></span>
                              <a href="logout.php">Logout</a>
                                </button></li>
                                <!-- <li><a href="#"></a></li>
                                <li><a href="#"></a></li>
                                <li><a href="#"></a></li> -->
                            </ul>
                        </div>
                    </div>
                </nav>

                <!-- <h2>Main Dashboard 1</h2> -->
                    <div class="row">

                        <div class="col-md-4" >
                            <h3>Most Liked Dished</h3>
                            <div id="piechart" style="width: 350px; height: 350px;"></div>
                        </div>


                        <div class="col-md-4">
                                    <h3>Sales Graph</h3>
                                <div id="columnchart_material" style="width: 320px; height:350px;"></div>
                        </div>



                        <div class="col-md-4"  style="width:322px; height:407px;">
                                <h3>Total Attendance</h3><br>
                                <div class="container" style="width:200px; height:300px;">
                                      <div class="button" style="width: 200px; height: 200px;">
                                        <span class="label-down" style="font-size:150px;padding-top:30%;"><?php  echo $attc['COUNT(Cnic)']; ?> </span>
                                        <span class="label-down" style="font-size:20px;margin:0px;padding:20px;font-family:'Raleway', sans-serif;">TODAY's ATTENDANCE COUNT</span>
                                      </div>
                                    </div>


                        </div>

                    </div>

<br>
<h3 style="display:inline;margin-right:150px;">Total Sales Today</h3>     <h3 style="display:inline">Complaints</h3> <h3 style="display:inline;margin-left:220px;">Inventory with Qty under 5</h3>
<div class="row">

        <div class="col-md-4">

            <div class="container" style="width:250px; height:239px;">
                  <div class="button" style="width: 200px; height: 200px;">
                    <span class="label-down" style="font-size:5em;padding-top:30%;"><?php  echo $sales['sum']; ?> </span>
                    <span class="label-down" style="font-size:3em;margin-top:45px;font-family:'Raleway', sans-serif;">Sales<br>Today</span>
                  </div>
                </div>
        </div>
<!-- <h3 style="display:inline">Complaints</h3> -->
        <div class="col-md-4" style="overflow-y: scroll; height:300px;" >


            <table class="table">
                <tr>
                    <td>Complaint#</td>
                    <td>Customer#</td>
                    <td>Complaint</td>
                </tr>

                <?php
                $comp=mysqli_query($con,"SELECT * FROM customercomplaint order by date desc");
            
                $row=mysqli_fetch_array($comp);
//                if(mysql_num)
                
                    while ($row=mysqli_fetch_array($comp)) {
                        echo "<form><tr><td>".$row['Id']."</td><td>".$row['MobileNumber']."</td><td>".$row['Text']."</td></tr></form>"    ;
                       
                    }

                 ?>

    </table>
        </div>

        <div class="col-md-4" style="overflow-y: scroll; height:300px;">
            <table class="table">
                <tr>
                    <td>ID</td>
                    <td>Item Name</td>
                    <td>Quantity</td>
                </tr>

                <?php
                    $comp=mysqli_query($con,"SELECT * FROM inventory having (ItemQuantity<5)");
                    while ($row=mysqli_fetch_array($comp)) {
                        echo "<tr><td>".$row['ItemNumber']."</td><td>".$row['ItemName']."</td><td>".$row['ItemQuantity']."</td></tr>"    ;
                    }
                 ?>

    </table>
        </div>

</div>

<div class="row">
    <h3>Male/Female Reg Ratio</h3>
    <div class="col-md-4">
         <div id="piechart1" style="width: 400px; height: 400px;"></div>
    </div>

</div>
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
