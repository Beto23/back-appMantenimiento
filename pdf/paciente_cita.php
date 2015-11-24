<?php
require('mysql_table.php');
class PDF extends PDF_MySQL_Table
{
function Header()
{
	//Title
	$this->SetFont('Arial','',16);
	$this->Cell(0,6,'Citas',0,1,'C');
	$this->Ln(10);
	//Ensure table header is output
	parent::Header();
}
}
//Connect to database
mysql_connect('localhost','root','');
mysql_select_db('drapp');
$pdf=new PDF();
$pdf->AddPage();
$paciente = $_POST['paciente'];
//First table: put all columns automatically
$pdf->Table("SELECT  DATE_FORMAT(fecha, '%d-%m-%Y') AS fecha, hora, SUBSTRING(doctor.nombre,1,20) as nombre , estatus FROM paciente_doctor_citas, doctor WHERE doctor.doctor = paciente_doctor_citas.doctor AND paciente_doctor_citas.paciente = '$paciente'");
$pdf->AddPage();

header('Content-type: citas/pdf');
$pdf->Output('citas'.".pdf", 'D'); 
?>