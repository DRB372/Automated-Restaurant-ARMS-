<?php

include("connect.php");
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
    $this->Ln(5);
}
}
$month = $_POST['month'];
$year = $_POST['year'];
$date = date('d-m-y');
$Sdate = new DateTime();
$Sdate->SetDate($year,$month,1);
$cnic = $_POST['cnic'];
$query1 = mysqli_query($con,"select * from attendance where Cnic = '$cnic' and month(date) = '$month'");
$query = "select * from employee where Cnic = '$cnic'";
$result = $con->query($query);
$name = $result->fetch_assoc();
$pdf = new PDF('P','mm','A5');
$pdf-> AddPage();

$pdf->SetFont('Arial','B',13);
$pdf->Cell(129,5,'Monthly Attendance Report',0,1,'C');
$pdf->SetFont('Arial','B',11);
$pdf->Ln(5);
$pdf->Cell(30,5,'Report Date:',0,0,'R');
$pdf->Cell(30,5,$date,0,1,'L');
$pdf->Cell(30,5,'Employee:',0,0,'R');
$pdf->Cell(30,5,$name['Name'],0,0);
$pdf->Cell(20);
$pdf->Cell(15,5,'CNIC:',0,0,'R');
$pdf->Cell(30,5,$cnic,0,1,'L');
$pdf->Ln(5);
$pdf->Cell(20);
$pdf->Cell(10,10,'No.',1,0,'C');
$pdf->Cell(50,10,'Date',1,0,'C');
$pdf->Cell(30,10,'Present',1,1,'C');
$count = 1;
$pdf->SetFont('Arial','',10);
$Ndate = new DateTime();
$Ndate->SetDate($year,$month,1);
$Ndate->modify('+1 month');
$Ndate->modify('-1 day');
$row = mysqli_fetch_array($query1);
while($Sdate < $Ndate){
$pdf->Cell(20);
$pdf->Cell(10,4,$count,1,0,'R');
$pdf->Cell(50,4,$Sdate->format('Y-m-d'),1,0,'R');
$temp = $Sdate->format('Y-m-d');
if($row['Date'] == $temp){
$pdf->Cell(30,4,'Present',1,1,'R');
$row = mysqli_fetch_array($query1);
}
else{
$pdf->Cell(30,4,'Absent',1,1,'R');
}
$Sdate->modify('+1 day');
$count++;
}
$pdf->Output();
?>
