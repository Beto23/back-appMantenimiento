<?php 
require 'Slim/Slim.php';
require './Config/db.php';
require './Model/Login.php';
require './Model/Clientes.php';
require './Model/Administrador.php';

\Slim\Slim::registerAutoloader(); 
$app = new \Slim\Slim(); 
header('Access-Control-Allow-Origin: *');

// Allow from any origin
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 0');    // cache for 1 day
    }
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");         

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    }



/**************** OBTENER TODOS LOS DIRECTORIOS ************************/


$app->post('/login','login');
/*Cliente*/
$app->post('/addCliente','addClientes');
$app->put('/clientes','actualizarCliente');
//$app->post('/clientes','addAutos');
/*Administrador*/
//$app->post('/administrador','addAdmmin');
//$app->post('/administrador','actualizarAdmin');
//$app->post('/administrador','addMecanico');
//$app->post('/administrador','addMantenimiento');
$app->post('/administrador','addCitas');



$app->run();

?>