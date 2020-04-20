<?php
$month=$_POST["month"];
$year=$_POST["year"];
include("connect.php");
require('fpdf181/fpdf.php');
//$month = manager se lena hai
$date = date('Y-m-d');
$arrayId = mysqli_query($con,"select * from bill where orderid in (select orderId from bill where orderID in (
select orderId from customerorder where month(customerorder.date) = '{$month}'))");
// remove hardcoded 12 from above query. add $month
$pdf = new FPDF('P','mm','A4');
$pdf-> AddPage();
$pdf->SetFont('Arial','B',20);
$pdf->Cell(189, 20, 'Sales Report', 1, 1,'C');
$pdf->SetFont('Arial','B',14);
$pdf->Cell(15, 10, 'Date: ', 0, 0,'L');
$pdf->Cell(30, 10,$date,0,1);
$pdf->Cell(45, 10, 'Report Month: ', 0, 0,'L');
$pdf->Cell(40, 10,$month."-".$year,0,1); // change $date to month
$pdf->SetFont('Arial','B',12);
$pdf->Cell(14,10,'',0);
$pdf->Cell(40,10,'Order ID',1,0,'C');
$pdf->Cell(40,10,'Dish Name',1,0,'C');
$pdf->Cell(40,10,'Quantity',1,0,'C');
$pdf->Cell(40,10,'Amount',1,1,'C');
$pdf->SetFont('Arial','',12);
$total = 0;
while($row = mysqli_fetch_array($arrayId)){
$query = "select dishname from menu m where m.menuid = '{$row["MenuId"]}'";
$result = $con->query($query);
$name = $result->fetch_assoc();

$query1 = "select Price from menu m where m.menuid = '{$row["MenuId"]}'";
$result1 = $con->query($query1);
$unitprice = $result1->fetch_assoc();
$sum = $unitprice['Price']*$row['DishQuantity'];
$total += $sum;
$pdf->Cell(14,10,'',0);
$pdf->Cell(40,5,$row['OrderId'],1,0,'R');
$pdf->Cell(40,5,$name['dishname'],1,0,'R');
$pdf->Cell(40,5,$row['DishQuantity'],1,0,'R');
$pdf->Cell(40,5,$sum,1,1,'R');
}
$pdf->Cell(94,5,'',0);
$pdf->Cell(40,5,'Grand Total',1,0,'R');
$pdf->Cell(40,5,$total,1,1,'R');


$pdf->Output();
?>
