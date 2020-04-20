<?php

include("connect.php");
require('fpdf181/fpdf.php');
$mob=$_GET['mob'];
class PDF extends FPDF
{
function Header()
{
    // Select Arial bold 15
    $this->SetFont('Arial','I',15);
    // Move to the right
    $this->Cell(139);
    // Framed title
    $this->Cell(50,10,'ARMS HOTEL',0,0,'R');
    // Line break
    $this->Ln(10);
}
}
$orderId =$_GET['id'];
$arrayId = mysqli_query($con,"select * from bill where orderid = '$orderId'");

$date = date('d-m-y / H:i');
$pdf = new PDF('P','mm','A4');
$pdf-> AddPage();

$pdf->SetFont('Arial','B',16);

$pdf->Cell(189, 20, 'Customer Invoice', 0, 1,'C');
$pdf->SetFont('Arial','B',14);
$pdf->Cell(25,10, 'Invoice#: ',0,0);
$pdf->Cell(20,10,$orderId+1,0,0);
$pdf->Cell(74);
$pdf->Cell(30,10, 'Date / Time: ', 0,0);
$pdf->Cell(40,10,$date,0,1);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(30,10,'Item No',1,0,'C');
$pdf->Cell(70,10,'Dish Name',1,0,'C');
$pdf->Cell(30,10,'Quantity',1,0,'C');
$pdf->Cell(30,10,'Unit Price',1,0,'C');
$pdf->Cell(29,10,'Total Price',1,1,'C');

$pdf->SetFont('Arial','',12);
$count = 1;
$total = 0;
while($row = mysqli_fetch_array($arrayId)){

$pdf->Cell(30,5,$count,1,0,'R');

$query = "select * from menu m where m.menuid = '{$row["MenuId"]}'";
$result = $con->query($query);
$name = $result->fetch_assoc();
$pdf->Cell(70,5,$name['DishName'],1,0,'R');

$pdf->Cell(30,5,$row['DishQuantity'],1,0,'R');
$pdf->Cell(30,5,$name['Price'],1,0,'R');

$cumprice= $name['Price']*$row['DishQuantity'];
$total += $cumprice;
$pdf->Cell(29,5,$cumprice,1,1,'R');

$count +=1;
}

$pdf->Cell(130);
$pdf->Cell(30,5,'Total Amount',1,0,'R');
$pdf->Cell(29,5,$total,1,1,'R');
$pdf->Ln(20);

$pdf->Cell(115,10,'Thank you for ordering,' ,0,0,'R');
$pdf->SetFont('Arial','U',12);

$query = "select * from customer where MobileNumber='{$mob}'";
$result = $con->query($query);
$custName = $result->fetch_assoc();
$pdf->Cell(74,10,$custName['Name'],0,1,'L');
$pdf->Output();
?>
