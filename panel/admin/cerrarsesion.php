<?php

error_reporting(0);
header('Content-type: application/json; charset=utf-8');

session_start();

$respuesta = [];

if( $_SERVER['REQUEST_METHOD'] == 'POST' ){

	// Destrucción de la sesión
	session_destroy();

	$respuesta["sesionCerrada"] = true;
	$respuesta["path"] .= '../../../login/admin/';

}

echo json_encode($respuesta);
