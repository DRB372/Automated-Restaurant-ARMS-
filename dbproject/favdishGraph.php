<?php  

include 'connect.php';

  
 ?>  
<html>
  <head>
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
								$query = mysqli_query($con,"SELECT DishName FROM hotel.menu where MenuId='$row[MenuId]' ");   
								
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
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
</html>