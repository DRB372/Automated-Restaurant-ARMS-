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
    $this->Cell(189,10,'ARMS HOTEL',0,1,'R');
    // Line break
    $this->Ln(5);
}
}
$query = mysqli_query($con,"select * from employee e left outer join attendance a on e.Cnic = a.Cnic");


$month = $_POST['month'];
$monthName = date("F", mktime(0, 0, 0, $month));
$year = $_POST['year'];
$date = date('d-m-y');
$Sdate = new DateTime();
$Sdate->SetDate($year,$month,1);
$Ndate = new DateTime();
$Ndate->SetDate($year,$month,1);
$Ndate->modify('+1 month');
$Ndate->modify('-1 day');
$pdf = new PDF('P','mm','A4');
$pdf-> AddPage();

$pdf->SetFont('Arial','B',13);
$pdf->Cell(189,5,'Monthly Attendance Report',0,1,'C');
$pdf->SetFont('Arial','B',11);
$pdf->Ln(5);
$pdf->Cell(30,5,'Report Date:',0,0,'R');
$pdf->Cell(30,5,$date,0,0,'L');
$pdf->Cell(55);
$pdf->Cell(35,5,'Selected Month:',0,0,'R');
$pdf->Cell(20,5,$monthName,0,0,'R');
$pdf->Cell(2,5,',',0,0,'L');
$pdf->Cell(5,5,$year,0,1);
$count=1;

while($Sdate < $Ndate){
	$pdf->Ln(10);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(20,10,'Date:',0,0,'R');
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(40,10,$Sdate->format('d-m-Y'),0,1,'L');
	$pdf->SetFont('Arial','B',14);
	$count++;
	$temp = $Sdate->format('Y-m-d');
	$queryPrs = mysqli_query($con,"select * from employee, attendance where employee.Cnic = attendance.Cnic and attendance.Date = '$temp' and attendance.attendance_status = 'present'");
	$queryAbs = mysqli_query($con,"select * from employee, attendance where employee.Cnic = attendance.Cnic and attendance.Date = '$temp' and attendance.attendance_status = 'absent'");
	$pdf->Ln(2);
	$pdf->Cell(75);
	$pdf->Cell(40,10,'Present',1,1,'C');
	$pdf->SetFont('Arial','',12);
	while($row = mysqli_fetch_array($queryPrs)){
	$pdf->Cell(75);
	$pdf->Cell(40,5,$row['Name'],1,1,'C');}
	$pdf->Ln(2);
	$pdf->Cell(75);
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(40,10,'Absent',1,1,'C');
	$pdf->SetFont('Arial','',12);
	while($row = mysqli_fetch_array($queryAbs)){
	$pdf->Cell(75);
	$pdf->Cell(40,5,$row['Name'],1,1,'C');}
	$Sdate->modify('+1 day');
	$pdf->Cell(45);
	$pdf->Cell(100,2,'___________________________________________',0,1);
}
$pdf->Output();
?>
