<?php

include("../connect.php");
require('fpdf181/fpdf.php');
class PDF extends FPDF
{
function Header()
{
    // Select Arial bold 15
    $this->SetFont('Arial','I',13);
    // Move to the right
    // Framed title
    $this->Cell(127,10,'ARMS HOTEL',0,1,'R');
    // Line break
    $this->Ln(10);
}
}
$date = date('d-m-y');
$cnic = "33301246629023";
//$query1 = mysqli_query($con,"select * from attendance where cnic = '$cnic'");
$query = "select * from employee where Cnic = '$cnic'";
$result = $con->query($query);
$name = $result->fetch_assoc();
$pdf = new PDF('P','mm','A5');
$pdf-> AddPage();

$pdf->SetFont('Arial','B',13);
$pdf->Cell(129,5,'Monthly Attendance Report',0,1,'C');
$pdf->SetFont('Arial','B',11);
$pdf->Cell(30,5,'Report Date:',1,0,'R');
$pdf->Cell(30,5,$date,1,1,'L');
$pdf->Cell(30,5,'Employee:',1,0);
$pdf->Cell(30,5,$name['Name'],1,1);
$pdf->Cell(20);
$pdf->Cell(10,10,'No.',1,0,'C');
$pdf->Cell(50,10,'Date',1,0,'C');
$pdf->Cell(30,10,'Present',1,1,'C');
$pdf->Image('https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=SAAADDD&choe=UTF-8',60,30,90,0,'PNG');

$pdf->Output();
?>
