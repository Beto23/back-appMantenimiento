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

function upload(){
    if ( !empty( $_FILES ) ) {
        $tempPath = $_FILES[ 'file' ][ 'tmp_name' ];
        $url = 'uploads' . DIRECTORY_SEPARATOR . $_FILES[ 'file' ][ 'name' ];
        $uploadPath = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . $url;
        move_uploaded_file( $tempPath, $uploadPath );
        $answer = array( 'url' => 'http://localhost/estructura-angular/backend/' . $url);
        echo json_encode($answer);
    } else {
        $answer = array( 'error' => 'No se subio la imagen correctamente');
        echo json_encode($answer);
    }
}


/**************** OBTENER TODOS LOS DIRECTORIOS ************************/

$app->post('/upload', 'upload');
$app->post('/login','login');
/*Cliente*/
$app->post('/addCliente','addClientes');
$app->put('/putCliente','putCliente');
$app->put('/putAuto', 'putAuto');
$app->post('/addAutos','addAutos');
$app->get('/getAutosByClientesUser/:id', 'getAutosByClientesUser');
$app->get('/getMisCitas/:id', 'getMisCitas');
$app->delete('/deleteAuto', 'deleteAuto');


/*Administrador*/
$app->post('/addAdministrador','addAdmmin');
$app->put('/putAdministrador','putAdministrador');
$app->put('/putMecanicos','putMecanicos');
$app->put('/putMantenimientos','putMantenimientos');
$app->put('/putCita','putCita');
$app->post('/addMecanico','addMecanico');
$app->post('/addMantenimiento','addMantenimiento');
$app->post('/postCitas','postCitas');
$app->get('/getMantenimientos', 'getMantenimientos');
$app->get('/getClientes','getClientes');
$app->get('/getMecanico', 'getMecanico');
$app->get('/getNomMantenimientos','getNomMantenimientos');
$app->get('/getAutos','getAutos');
$app->get('/getModeloAutos', 'getModeloAutos');
$app->get('/getAdministradores', 'getAdministradores');
$app->get('/getAutosByClientes/:id', 'getAutosByClientes');
$app->get('/getCitas','getCitas');
$app->delete('/deleteMecanico', 'deleteMecanico');
$app->delete('/deleteCita', 'deleteCita');
$app->delete('/deleteMantenimiento', 'deleteMantenimiento');
$app->delete('/deleteAdministrador', 'deleteAdministrador');

$app->get('/getApp', 'getApp');


$app->run();

?>