<?php 
// funcion para insertar un administrador
	function addAdmmin() {
	$request = \Slim\Slim::getInstance()->request();
	$doc = json_decode($request->getBody());
	$sql = "INSERT INTO administrador (nombre, correo, usuario, imagen, password) VALUES (:nombre, :correo, :usuario, :imagen, :password)";
	try {
		$db = getConnection(); 
		$stmt = $db->prepare($sql);
		$stmt->bindParam("nombre", $doc->nombre);
		$stmt->bindParam("correo", $doc->correo);
		$stmt->bindParam("usuario", $doc->usuario);
		$stmt->bindParam("imagen", $doc->imagen);
		$stmt->bindParam("password", $doc->password);
		$stmt->execute();
		$db = null;
		$answer = array('estatus' => 'ok' , 'msj'=> 'Se ha agregado un nuevo administrador.');
	} catch(PDOException $e) {
		$answer = array('estatus'=>'error', 'msj' =>  $e->getMessage());
	}

	echo json_encode($answer);
}

// funcion para insertar un mecanico
	function addMecanico() {
	$request = \Slim\Slim::getInstance()->request();
	$doc = json_decode($request->getBody());
	$sql = "INSERT INTO mecanicos (nombre, nom_paterno, nom_materno) VALUES (:nombre, :nom_paterno, :nom_materno)";
	try {
		$db = getConnection(); 
		$stmt = $db->prepare($sql);
		$stmt->bindParam("nombre", $doc->nombre);
		$stmt->bindParam("nom_paterno", $doc->nom_paterno);
		$stmt->bindParam("nom_materno", $doc->nom_materno);
		$stmt->execute();
		$db = null;
		$answer = array('estatus' => 'ok' , 'msj'=> 'Se ha agregado un nuevo mecanico.');
	} catch(PDOException $e) {
		$answer = array('estatus'=>'error', 'msj' =>  $e->getMessage());
	}

	echo json_encode($answer);
}

/*Funcion para insertar un cita*/
	function postCitas() {
	$request = \Slim\Slim::getInstance()->request();
	$doc = json_decode($request->getBody());
	$sql = "INSERT INTO citas (fecha_inicio, fecha_fin, hora, id_auto, id_mantenimiento, id_mecanico, id_administrador) VALUES (:fecha_inicio, :fecha_fin, :hora, :id_auto, :id_mantenimiento, :id_mecanico, :id_administrador)";
	try {
		$db = getConnection(); 
		$stmt = $db->prepare($sql);
		$stmt->bindParam("fecha_inicio", $doc->fecha_inicio);
		$stmt->bindParam("fecha_fin", $doc->fecha_fin);
		$stmt->bindParam("hora", $doc->hora);
		$stmt->bindParam("id_auto", $doc->id_auto);
		$stmt->bindParam("id_mantenimiento", $doc->id_mantenimiento);
		$stmt->bindParam("id_mecanico", $doc->id_mecanico);
		$stmt->bindParam("id_administrador", $doc->id_administrador);
		$stmt->execute();
		$db = null;
		$answer = array('estatus' => 'ok' , 'msj'=> 'Se ha agregado una nueva cita.');
	} catch(PDOException $e) {
		$answer = array('estatus'=>'error', 'msj' =>  $e->getMessage());
	}

	echo json_encode($answer);
}
/*Funcion para insertar un mantenimineto*/
	function addMantenimiento() {
	$request = \Slim\Slim::getInstance()->request();
	$doc = json_decode($request->getBody());
	$sql = "INSERT INTO mantenimientos (descripcion,costo) VALUES (:descripcion, :costo)";
	try {
		$db = getConnection(); 
		$stmt = $db->prepare($sql);
		$stmt->bindParam("descripcion", $doc->descripcion);
		$stmt->bindParam("costo", $doc->costo);
		$stmt->execute();
		$db = null;
		$answer = array('estatus' => 'ok' , 'msj'=> 'Se ha agregado un nuevo mantenimineto.');
	} catch(PDOException $e) {
		$answer = array('estatus'=>'error', 'msj' =>  $e->getMessage());
	}

	echo json_encode($answer);
}
/*Funcion para insertar un detalle*/
	function addMantenimiento2() {
	$request = \Slim\Slim::getInstance()->request();
	$doc = json_decode($request->getBody());
	$sql = "INSERT INTO detalle_mantenimiento (id_detalle_mantenimiento,id_cita) VALUES (:id_detalle_mantenimiento,:id_cita)";
	try {
		$db = getConnection(); 
		$stmt = $db->prepare($sql);
		$stmt->bindParam("id_detalle_mantenimiento", $doc->id_detalle_mantenimiento);
		$stmt->bindParam("id_cita", $doc->id_cita);
		$stmt->execute();
		$db = null;
		echo json_encode($doc);
	} catch(PDOException $e) {
		$answer = array( 'error' =>  $e->getMessage());
		echo json_encode($answer);
	}
}
/*Actualizar administradores*/
function putAdministrador() {
	$request = \Slim\Slim::getInstance()->request();
	$req = json_decode($request->getBody());
	$sql = "UPDATE administrador SET nombre=:nombre, correo=:correo, imagen=:imagen, password=:password WHERE id_administrador='$req->id_administrador'";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("nombre", $req->nombre);
		$stmt->bindParam("correo", $req->correo);
		$stmt->bindParam("imagen", $req->imagen);
		$stmt->bindParam("password", $req->password);
		$stmt->execute();
		$db = null;
		$answer = array('estatus' => 'ok' , 'msj' => 'Se ha modificado el administrador.');
	} catch(PDOException $e) {
		$answer = array('estatus'=>'error', 'msj' =>  $e->getMessage());
	}

	echo json_encode($answer);
}
/*Actualizar Mecanicos*/
function putMecanicos() {
	$request = \Slim\Slim::getInstance()->request();
	$req = json_decode($request->getBody());
	$sql = "UPDATE mecanicos SET nombre=:nombre, nom_paterno=:nom_paterno, nom_materno=:nom_materno WHERE id_mecanico='$req->id_mecanico'";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("nombre", $req->nombre);
		$stmt->bindParam("nom_paterno", $req->nom_paterno);
		$stmt->bindParam("nom_materno", $req->nom_materno);
		$stmt->execute();
		$db = null;
		$answer = array('estatus' => 'ok' , 'msj'=> 'Se ha modificado el mecanico.');
	} catch(PDOException $e) {
		$answer = array('estatus'=>'error', 'msj' =>  $e->getMessage());
	}

	echo json_encode($answer);
}
/*Actualizar Mantenimeintos*/
function putMantenimientos() {
	$request = \Slim\Slim::getInstance()->request();
	$req = json_decode($request->getBody());
	$sql = "UPDATE mantenimientos SET descripcion=:descripcion, costo=:costo WHERE id_mantenimiento='$req->id_mantenimiento'";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("descripcion", $req->descripcion);
		$stmt->bindParam("costo", $req->costo);
		$stmt->execute();
		$db = null;
		$answer = array('estatus' => 'ok', 'msj' => 'Se ha modificado el mantenimiento.');
	} catch(PDOException $e) {
		$answer = array('estatus'=>'error', 'msj' =>  $e->getMessage());
	}
	echo json_encode($answer);
}
/*Actualizar una cita*/
function putCita() {
	$request = \Slim\Slim::getInstance()->request();
	$req = json_decode($request->getBody());
	$sql = "UPDATE citas SET fecha_inicio=:fecha_inicio, fecha_fin=:fecha_fin, hora=:hora, id_auto=:id_auto, id_mantenimiento=:id_mantenimiento, id_administrador=:id_administrador, id_mecanico=:id_mecanico WHERE id_citas='$req->id_citas'";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("fecha_inicio", $req->fecha_inicio);
		$stmt->bindParam("fecha_fin", $req->fecha_fin);
		$stmt->bindParam("hora", $req->hora);
		$stmt->bindParam("id_auto", $req->id_auto);
		$stmt->bindParam("id_mantenimiento", $req->id_mantenimiento);
		$stmt->bindParam("id_administrador", $req->id_administrador);
		$stmt->bindParam("id_mecanico", $req->id_mecanico);
		$stmt->execute();
		$db = null;
		$answer = array('estatus' => 'ok', 'msj' => 'Se ha modificado la cita.');
	} catch(PDOException $e) {
		$answer = array('estatus'=>'error', 'msj' =>  $e->getMessage());
	}
	echo json_encode($answer);
}
/*Datos de Mantenimiento*/

function getMantenimientos() { 
	$sql_query = "SELECT * FROM mantenimientos";
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

/*Nombre del mantenimiento*/
function getNomMantenimientos() { 
	$sql_query = "SELECT descripcion FROM mantenimientos";
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




/*Datos de los Clientes*/

function getClientes() { 
	$sql_query = "SELECT id_cliente, nombre, nom_paterno, nom_materno FROM clientes";
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
/*Datos de los administradores*/

function getAdministradores() { 
	$sql_query = "SELECT id_administrador, nombre, correo, usuario FROM administrador";
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
/*Datos del mecanico*/

function getMecanico() { 
	$sql_query = "SELECT * FROM mecanicos";
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

/*Datos del auto*/

function getAutos() { 
	$sql_query = "SELECT * FROM autos";
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

//getAutosByClientes
function getAutosByClientes($id) { 
	$sql_query = "SELECT autos.id_cliente, autos.modelo, autos.id_auto FROM autos, clientes WHERE autos.id_cliente = clientes.id_cliente AND autos.id_cliente = '$id'";
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
/*marca del auto*/

function getModeloAutos() { 
	$sql_query = "SELECT modelo FROM autos";
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
function getCitas() { 
	$sql_query = "SELECT autos.modelo as AutoModelo,
						 autos.id_auto as IdAuto,
						 clientes.nombre as NombreClientes,
						 clientes.nom_paterno as ClientePaterno,
						 clientes.nom_materno as ClienteMaterno,
						 clientes.id_cliente as IdCliente,
						 mantenimientos.descripcion as MantenimientoDescripcion,
						 mantenimientos.costo as Costo,
						 mantenimientos.id_mantenimiento as IdMantenimiento,
						 mecanicos.nombre as NombreMecanico,
						 mecanicos.id_mecanico as IdMecanico,
						 administrador.nombre as NombreAdministrador,
						 administrador.id_administrador as IdAdmin,
						 citas.id_citas as Id,
						 citas.fecha_inicio as CitaFechaInicio,
						 citas.fecha_fin as CitaFechaFin,
						 citas.hora as CitaHora
				FROM citas, autos, clientes, mantenimientos, mecanicos, administrador 
				WHERE
					citas.id_auto = autos.id_auto
						AND autos.id_cliente = clientes.id_cliente
						AND citas.id_mantenimiento= mantenimientos.id_mantenimiento
						AND citas.id_mecanico= mecanicos.id_mecanico
						AND citas.id_administrador = administrador.id_administrador
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
//elimnar mecanico
function deleteMecanico(){
	$request = \Slim\Slim::getInstance()->request();
	$pac = json_decode($request->getBody());
	$sql_query = "DELETE 
					FROM 
						mecanicos
					WHERE 
						id_mecanico = '$pac->id_mecanico'";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql_query);
		$stmt->bindParam("id_mecanico", $pac->id_mecanico);
		$stmt->execute();
		$db = null;
		$answer = array('estatus'=>'ok', 'msj'=> 'Mecanico eliminado satisfactoriamente');
	} 
	catch(PDOException $e) {
		if($e->errorInfo[1] == 1451){
			$answer = array( 'estatus'=>'error','msj' =>  'No puedes eliminarlo, este mecanico está asociado a una cita.' );
		} else {
			$answer = array( 'estatus'=>'error','msj' =>  $e->getMessage());
		}
	}

	echo json_encode($answer);
}
//elimnar cita
function deleteCita(){
	$request = \Slim\Slim::getInstance()->request();
	$pac = json_decode($request->getBody());
	$sql_query = "DELETE 
					FROM 
						citas
					WHERE 
						id_citas = '$pac->id_citas'";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql_query);
		$stmt->bindParam("id_citas", $pac->id_citas);
		$stmt->execute();
		$db = null;
		$answer = array('estatus'=>'ok', 'msj'=> 'Cita eliminada satisfactoriamente');
	} 
	catch(PDOException $e) {
		$answer = array( 'estatus'=>'error','msj' =>  $e->getMessage());
	}

	echo json_encode($answer);
}
//elimnar mantenimiento
function deleteMantenimiento(){
	$request = \Slim\Slim::getInstance()->request();
	$pac = json_decode($request->getBody());
	$sql_query = "DELETE 
					FROM 
						mantenimientos
					WHERE 
						id_mantenimiento = '$pac->id_mantenimiento'";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql_query);
		$stmt->bindParam("id_mantenimiento", $pac->id_mantenimiento);
		$stmt->execute();
		$db = null;
		$answer = array('estatus'=>'ok', 'msj'=> 'Mantenimiento eliminado satisfactoriamente');
	} 
	catch(PDOException $e) {
		if($e->errorInfo[1] == 1451){
			$answer = array( 'estatus'=>'error','msj' =>  'No puedes eliminarlo, este mantenimiento está asociado a una cita.' );
		} else {
			$answer = array( 'estatus'=>'error','msj' =>  $e->getMessage());
		}
	}

	echo json_encode($answer);
}
//elimnar administrador
function deleteAdministrador(){
	$request = \Slim\Slim::getInstance()->request();
	$pac = json_decode($request->getBody());
	$sql_query = "DELETE 
					FROM 
						administrador
					WHERE 
						id_administrador = '$pac->id_administrador'";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql_query);
		$stmt->bindParam("id_administrador", $pac->id_administrador);
		$stmt->execute();
		$db = null;
		$answer = array('estatus'=>'ok', 'msj'=> 'Administrador eliminado satisfactoriamente');
	} 
	catch(PDOException $e) {
		if($e->errorInfo[1] == 1451){
			$answer = array( 'estatus'=>'error','msj' =>  'No puedes eliminarlo, este administrador está asociado a una cita.' );
		} else {
			$answer = array( 'estatus'=>'error','msj' =>  $e->getMessage());
		}
	}

	echo json_encode($answer);
}
?>