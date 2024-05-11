<?php

error_reporting(0);
header('Content-type: application/json; charset=utf-8');

session_start();

$identificadorSesion = $_SESSION['boleta'];

$respuesta = [];

// Conexión a base de datos
include '../../../conexion.php';

// Comprobación inicio periodo escolar
if( date('d-m') == '01-08' || date('d-m') == '31-12' ){
	$reinicioContadorSolicitudes = $conexion->prepare("UPDATE usuario SET solDisponibles = 10");
	$reinicioContadorSolicitudes->execute();
}

// Consulta documentos que pueden solicitarse
$documentos=$conexion->prepare("SELECT codDoc AS 'codigo', nomDoc AS 'nombre', descripcion, espera FROM documentos");
$documentos->execute();
$datosDocumentos = $documentos->fetchAll();

for( $tupla = 0; $tupla < count($datosDocumentos); $tupla++ ){

	$documento = [
		"codigo" => $datosDocumentos[$tupla]['codigo'],
		"nombre" => utf8_encode($datosDocumentos[$tupla]['nombre']),
		"descripcion" => utf8_encode($datosDocumentos[$tupla]['descripcion']),
		"espera" => utf8_encode($datosDocumentos[$tupla]['espera'])
	];

	array_push($respuesta, $documento);

}

echo json_encode($respuesta);
