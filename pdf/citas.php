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
mysql_select_db('appMantenimiento');
$pdf=new PDF();
$pdf->AddPage();
//First table: put all columns automatically

$sql_query = "SELECT autos.modelo,
		clientes.nombre,
		DATE_FORMAT(fecha_inicio, '%d-%m-%Y') as 'Fecha Incio',
		DATE_FORMAT(fecha_fin, '%d-%m-%Y') as 'Fecha Fin',
		citas.hora
		FROM citas, autos, clientes, mantenimientos, mecanicos, administrador 
		WHERE
			citas.id_auto = autos.id_auto
				AND autos.id_cliente = clientes.id_cliente
				AND citas.id_mantenimiento= mantenimientos.id_mantenimiento
				AND citas.id_mecanico= mecanicos.id_mecanico
				AND citas.id_administrador = administrador.id_administrador
		ORDER BY id_citas desc ";

$pdf->Table($sql_query);
$pdf->AddPage();

header('Content-type: citas/pdf');
$pdf->Output('citas'.".pdf", 'D'); 
?>