<?php
include("connect.php");
//require('mem_image.php');
require('fpdf181/fpdf.php');

$cnic = $_POST['cnic'];
$query = mysqli_query($con,"select * from employee where employee.Cnic = '$cnic'");
$row=mysqli_fetch_array($query);
$pdf = new FPDF('L','mm','A5');
$pdf-> AddPage();
$pdf->Rect(5, 5, 200, 135, 'D');
$pdf->SetFont('Helvetica','B',24);
$pdf->Cell(65);
$pdf->Cell(55,10,'ARMS Hotel',0,1,'C');
$pdf->SetFont('Helvetica','B',20);
$pdf->Cell(65);
$pdf->Cell(55,15,'Employee Card',0,1,'C');
$pdf->Image('https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl='.$cnic.'&choe=UTF-8',160,70,40,0,'PNG');
// $result = mysqli_query($con,"SELECT image FROM employee WHERE Cnic='$cnic'");
// // $row = mysqli_fetch_assoc($result);
// $image = $row['image'];
//
// $pdf->MemImage($image, 50, 30);
$res=mysqli_query($con,"SELECT path from Employee where cnic='$cnic'");
$row1=mysqli_fetch_array($res);
//$pdf->
  $pdf->Image($row['path'],20,40,60,0,'jpg');    

$pdf->Ln(10);

$pdf->Cell(80);
$pdf->SetFont('Helvetica','B',14);
$pdf->Cell(45,10,'Employee Name:',0,0,'R');
//$pdf->Cell(45,10,$row1['path'],0,0,'R');
$pdf->SetFont('Helvetica','',16);
$pdf->Cell(45,10,$row['Name'],0,1,'L');

$pdf->Cell(80);
$pdf->SetFont('Helvetica','B',14);
$pdf->Cell(45,10,'Cnic:',0,0,'R');
$pdf->SetFont('Helvetica','',16);
$pdf->Cell(45,10,$row['Cnic'],0,1,'L');

$pdf->Cell(80);
$pdf->SetFont('Helvetica','B',14);
$pdf->Cell(45,10,'Mobile Number:',0,0,'R');
$pdf->SetFont('Helvetica','',16);
$pdf->Cell(45,10,$row['PhoneNumber'],0,1,'L');

$pdf->Cell(80);
$pdf->SetFont('Helvetica','B',14);
$pdf->Cell(45,10,'Gender:',0,0,'R');
$pdf->SetFont('Helvetica','',16);
$pdf->Cell(45,10,$row['Gender'],0,1,'L');

$pdf->Cell(80);
$pdf->SetFont('Helvetica','B',14);
$pdf->Cell(45,10,'Job:',0,0,'R');
$pdf->SetFont('Helvetica','',16);
$pdf->Cell(45,10,$row['Job'],0,1,'L');

$pdf->Cell(80);
$pdf->SetFont('Helvetica','B',14);
$pdf->Cell(45,10,'Shift:',0,0,'R');
$pdf->SetFont('Helvetica','',16);
$pdf->Cell(45,10,$row['Shift'],0,1,'L');
$pdf->Ln(18);
$pdf->SetFont('Helvetica','U',12);
$pdf->Cell(189,5,'Note: If found, return to Boy Hostel, UOG',0,1,'C');
$pdf->Output();
?>
