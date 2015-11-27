<?php
require('mysql_table.php');
class PDF extends PDF_MySQL_Table
{
function Header()
{
	//Title
	$this->SetFont('Arial','',16);
	$this->Cell(0,6,'Historial Mantenimientos',0,1,'C');
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
$id_cliente=$_POST['id_cliente'];
$sql_query = "SELECT 
		DATE_FORMAT(fecha_inicio, '%d-%m-%Y') as 'Fecha',
		autos.modelo as Auto,
		mantenimientos.descripcion,
		mantenimientos.costo
		FROM citas, autos, clientes, mantenimientos
		WHERE
			citas.id_auto = autos.id_auto
				AND autos.id_cliente = clientes.id_cliente
				AND citas.id_mantenimiento= mantenimientos.id_mantenimiento
				AND autos.id_cliente = '$id_cliente'
		ORDER BY id_citas desc ";

$pdf->Table($sql_query);
$pdf->AddPage();

header('Content-type: citas/pdf');
$pdf->Output('citas'.".pdf", 'D'); 
?>