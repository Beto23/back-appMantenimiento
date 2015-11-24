<?php
function login() {
	$request = \Slim\Slim::getInstance()->request();
	$usuario = json_decode($request->getBody());
	$sql_query = "SELECT * FROM administrador WHERE usuario = '$usuario->usuario' AND password = '$usuario->password'";
	try {
		$dbCon = getConnection();
		$stmt   = $dbCon->query($sql_query);
		$admin  = $stmt->fetchAll(PDO::FETCH_OBJ);
		$dbCon = null;
	} 
	catch(PDOException $e) {
		$answer = array('estatus'=>'error', 'msj' =>  $e->getMessage());
	}
	$sql_query = "SELECT * FROM clientes WHERE usuario = '$usuario->usuario' AND password = '$usuario->password'";
	try {
		$dbCon = getConnection();
		$stmt   = $dbCon->query($sql_query);
		$cliente  = $stmt->fetchAll(PDO::FETCH_OBJ);
		$dbCon = null;
	} 
	catch(PDOException $e) {
		$answer = array('estatus'=>'error', 'msj' =>  $e->getMessage());
	}
	if(count($admin) > 0){
		$admin = $admin[0];
		$answer = array('estatus'=>'ok', 'msj' => "¡Bienvenido $admin->nombre!", 'tipoUsuario'=>'admin', 'admin' => $admin);
	} else {
		if(count($cliente) > 0){
			$cliente = $cliente[0];
			$answer = array('estatus'=>'ok', 'msj' => "¡Bienvenido $cliente->nombre!", 'tipoUsuario'=>'cliente', 'cliente' => $cliente);
		} else {
			$answer = array('estatus'=>'error','msj'=>'Usuario y/o contraseña incorrecta. Por Favor intente de nuevo.');
		}
	}
	echo json_encode($answer);
}
?>