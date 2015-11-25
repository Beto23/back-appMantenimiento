<?php
require('mysql_table.php');
class PDF extends PDF_MySQL_Table
{
function Header()
{
	//Title
	$this->SetFont('Arial','',16);
	$this->Cell(0,6,'Mecanicos',0,1,'C');
	$this->Ln(10);
	//Ensure table header is output
	parent::Header();
}
}
//Connect to database
mysql_connect('localhost','root','');
mysql_select_db('appMantenimiento');
$pdf=new PDF();
$pdf->AddPage();
//First table: put all columns automatically

$sql_query = "SELECT 
				id_mecanico as Id,
				nombre as Nombre,
				nom_paterno as Paterno,
				nom_materno as Materno
		FROM mecanicos";

$pdf->Table($sql_query);
$pdf->AddPage();

header('Content-type: citas/pdf');
$pdf->Output('citas'.".pdf", 'D'); 
?>