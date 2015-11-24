<?php
// funcion para insertar clientes
	function addClientes() {
	$request = \Slim\Slim::getInstance()->request();
	$doc = json_decode($request->getBody());
	$sql = "INSERT INTO clientes (nombre, nom_paterno, nom_materno, correo, usuario, imagen, password) VALUES (:nombre, :nom_paterno, :nom_materno, :correo, :usuario, :imagen, :password)";
	try {
		$db = getConnection(); 
		$stmt = $db->prepare($sql);
		$stmt->bindParam("nombre", $doc->nombre);
		$stmt->bindParam("nom_paterno", $doc->nom_paterno);
		$stmt->bindParam("nom_materno", $doc->nom_materno);
		$stmt->bindParam("correo", $doc->correo);
		$stmt->bindParam("usuario", $doc->usuario);
		$stmt->bindParam("imagen", $doc->imagen);
		$stmt->bindParam("password", $doc->password);
		$stmt->execute();
		$db = null;
		$answer = array('estatus' => 'ok' , 'msj'=> 'Usuario creado. Bienvenido');
	} catch(PDOException $e) {
		$answer = array('estatus'=>'error', 'msj' =>  $e->getMessage());
	}

	echo json_encode($answer);
}

// funcion para insertar autos
	function addAutos() {
	$request = \Slim\Slim::getInstance()->request();
	$doc = json_decode($request->getBody());
	$sql = "INSERT INTO autos (marca, modelo, year, color, id_cliente) VALUES (:marca, :modelo, :year, :color, :id_cliente)";
	try {
		$db = getConnection(); 
		$stmt = $db->prepare($sql);
		$stmt->bindParam("marca", $doc->marca);
		$stmt->bindParam("modelo", $doc->modelo);
		$stmt->bindParam("year", $doc->year);
		$stmt->bindParam("color", $doc->color);
		$stmt->bindParam("id_cliente", $doc->id_cliente);
		$stmt->execute();
		$db = null;
		$answer = array('estatus' => 'ok' , 'msj'=> 'Automovil creado satisfactoriamente.');
	} catch(PDOException $e) {
		$answer = array('estatus'=>'error', 'msj' =>  $e->getMessage());
	}

	echo json_encode($answer);
}

function putCliente() {
	$request = \Slim\Slim::getInstance()->request();
	$req = json_decode($request->getBody());
	$sql = "UPDATE clientes SET nombre=:nombre, nom_paterno=:nom_paterno, nom_materno=:nom_materno, correo=:correo, usuario=:usuario, imagen=:imagen, password=:password WHERE id_cliente='$req->id_cliente'";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("nombre", $req->nombre);
		$stmt->bindParam("nom_paterno", $req->nom_paterno);
		$stmt->bindParam("nom_materno", $req->nom_materno);
		$stmt->bindParam("correo", $req->correo);
		$stmt->bindParam("usuario", $req->usuario);
		$stmt->bindParam("imagen", $req->imagen);
		$stmt->bindParam("password", $req->password);
		$stmt->execute();
		$db = null;
		$answer = array('estatus' => 'ok' , 'msj' => 'Se ha modificado tu perfil.');
	} catch(PDOException $e) {
		$answer = array('estatus'=>'error', 'msj' =>  $e->getMessage());
	}

	echo json_encode($answer);
}
function putAuto() {
	$request = \Slim\Slim::getInstance()->request();
	$req = json_decode($request->getBody());
	$sql = "UPDATE autos SET marca=:marca, modelo=:modelo, year=:year, color=:color WHERE id_auto='$req->id_auto'";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("marca", $req->marca);
		$stmt->bindParam("modelo", $req->modelo);
		$stmt->bindParam("year", $req->year);
		$stmt->bindParam("color", $req->color);
		$stmt->execute();
		$db = null;
		$answer = array('estatus' => 'ok' , 'msj' => 'Se ha modificado tu auto.');
	} catch(PDOException $e) {
		$answer = array('estatus'=>'error', 'msj' =>  $e->getMessage());
	}

	echo json_encode($answer);
}
//elimnar carro
function deleteAuto(){
	$request = \Slim\Slim::getInstance()->request();
	$pac = json_decode($request->getBody());
	$sql_query = "DELETE 
					FROM 
						autos
					WHERE 
						id_auto = '$pac->id_auto'";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql_query);
		$stmt->bindParam("id_auto", $pac->id_auto);
		$stmt->execute();
		$db = null;
		$answer = array('estatus'=>'ok', 'msj'=> 'Automovil eliminado correctamente');
	} 
	catch(PDOException $e) {
		if($e->errorInfo[1] == 1451){
			$answer = array( 'estatus'=>'error','msj' =>  'No puedes eliminarlo, este auto está asociado a una cita.' );
		} else {
			$answer = array( 'estatus'=>'error','msj' =>  $e->getMessage());
		}
	}

	echo json_encode($answer);
}
function getAutosByClientesUser($id) { 
	$sql_query = "SELECT autos.id_cliente, autos.modelo, autos.color, autos.marca, autos.year, autos.id_auto FROM autos, clientes WHERE autos.id_cliente = clientes.id_cliente AND autos.id_cliente = '$id'";
	try {
		$dbCon = getConnection();
		$stmt   = $dbCon->query($sql_query);
		$data  = $stmt->fetchAll(PDO::FETCH_OBJ);
		$dbCon = null;
		echo json_encode($data);
	} 
	catch(PDOException $e) {
		$answer = array( 'error' =>  $e->getMessage());
		echo json_encode($answer);
	}
}
//getAutosByCitas
function getMisCitas($id) { 
	$sql_query = "SELECT autos.modelo as AutoModelo,
						 autos.id_auto as IdAuto,
						 clientes.nombre as NombreClientes,
						 clientes.nom_paterno as ClientePaterno,
						 clientes.nom_materno as ClienteMaterno,
						 clientes.id_cliente as IdCliente,
						 mantenimientos.descripcion as MantenimientoDescripcion,
						 mantenimientos.id_mantenimiento as IdMantenimiento,
						 mantenimientos.costo as Costo,
						 citas.id_citas as Id,
						 citas.fecha_inicio as CitaFechaInicio,
						 citas.fecha_fin as CitaFechaFin,
						 citas.hora as CitaHora
				FROM citas, autos, clientes, mantenimientos
				WHERE
					citas.id_auto = autos.id_auto
						AND autos.id_cliente = clientes.id_cliente
						AND citas.id_mantenimiento= mantenimientos.id_mantenimiento
						AND autos.id_cliente = '$id'
				ORDER BY id_citas desc ";
	try {
		$dbCon = getConnection();
		$stmt   = $dbCon->query($sql_query);
		$data  = $stmt->fetchAll(PDO::FETCH_OBJ);
		$dbCon = null;
		echo json_encode($data);
	} 
	catch(PDOException $e) {
		$answer = array( 'error' =>  $e->getMessage());
		echo json_encode($answer);
	}
}
?>