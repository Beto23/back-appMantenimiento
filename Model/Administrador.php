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
		echo json_encode($doc);
	} catch(PDOException $e) {
		$answer = array( 'error' =>  $e->getMessage());
		echo json_encode($answer);
	}
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
		echo json_encode($doc);
	} catch(PDOException $e) {
		$answer = array( 'error' =>  $e->getMessage());
		echo json_encode($answer);
	}
}

/*Funcion para insertar un cita*/
	function postCitas() {
	$request = \Slim\Slim::getInstance()->request();
	$doc = json_decode($request->getBody());
	echo json_encode($doc);
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
		echo json_encode($doc);
	} catch(PDOException $e) {
		$answer = array( 'error' =>  $e->getMessage());
		echo json_encode($answer);
	}
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
		echo json_encode($doc);
	} catch(PDOException $e) {
		$answer = array( 'error' =>  $e->getMessage());
		echo json_encode($answer);
	}
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
function actualizarAdmin() {
	$request = \Slim\Slim::getInstance()->request();
	$req = json_decode($request->getBody());
	$sql = "UPDATE clientes SET nombre=:nombre, correo=:correo, usuario=:usuario, imagen=:imagen, password=:password WHERE clientes='$req->clientes'";
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
		echo json_encode($req);
	} catch(PDOException $e) {
		$answer = array( 'error' =>  $e->getMessage());
		echo json_encode($answer);
	}
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
?>