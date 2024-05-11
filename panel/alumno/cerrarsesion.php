<?php

error_reporting(0);
header('Content-type: application/json; charset=utf-8');

session_start();

$respuesta = ["sesionCerrada" => false, "path" => ''];

if( $_SERVER['REQUEST_METHOD'] == 'POST' ){

	// Destrucción de la sesión
	session_destroy();

	$respuesta["sesionCerrada"] = true;
	$respuesta["path"] .= '../../../login/alumno/';

}

echo json_encode($respuesta);
