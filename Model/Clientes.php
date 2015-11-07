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
		echo json_encode($doc);
	} catch(PDOException $e) {
		$answer = array( 'error' =>  $e->getMessage());
		echo json_encode($answer);
	}
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
		echo json_encode($doc);
	} catch(PDOException $e) {
		$answer = array( 'error' =>  $e->getMessage());
		echo json_encode($answer);
	}
}

function actualizarCliente() {
	$request = \Slim\Slim::getInstance()->request();
	$req = json_decode($request->getBody());
	$sql = "UPDATE clientes SET nombre=:nombre, nom_paterno=:nom_paterno, nom_materno=:nom_materno, correo=:correo, usuario=:usuario, imagen=:imagen, password=:password WHERE id_cliente='$req->id_cliente'";
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
		echo json_encode($req);
	} catch(PDOException $e) {
		$answer = array( 'error' =>  $e->getMessage());
		echo json_encode($answer);
	}
}
?>