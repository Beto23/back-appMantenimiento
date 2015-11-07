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
		$answer = array( 'error' =>  $e->getMessage());
		echo json_encode($answer);
	}
	$sql_query = "SELECT * FROM clientes WHERE usuario = '$usuario->usuario' AND password = '$usuario->password'";
	try {
		$dbCon = getConnection();
		$stmt   = $dbCon->query($sql_query);
		$cliente  = $stmt->fetchAll(PDO::FETCH_OBJ);
		$dbCon = null;
	} 
	catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
	if(count($admin) > 0){
		$admin[0]->tipoUsuario = 'administrador';
		echo json_encode($admin[0]);
	} else {
		if(count($cliente) > 0){
			$cliente[0]->tipoUsuario = 'cliente';
			echo json_encode($cliente[0]);
		} else {
			$answer = array( 'tipoUsuario' =>  null);
			echo json_encode($answer);
		}
	}
}
?>