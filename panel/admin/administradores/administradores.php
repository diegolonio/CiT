<?php

error_reporting(0);
header('Content-type: application/json; charset=utf-8');

session_start();

// Conexion a base de datos
require '../../../conexion.php';

$respuesta = ["id" => $_SESSION['empleado'], "administradores" => []];

// Consulta datos administrador
$consultaAdministradores = $conexion->prepare("SELECT CONCAT(e.nombre,' ', e.apePat,' ',e.apeMat) AS 'nombre', a.noEmpleado AS 'codigo', a.estado AS 'estado' FROM empleado e, administrador a WHERE a.noEmpleado=e.noEmpleado GROUP BY a.noEmpleado");
$consultaAdministradores->execute();
$administradores = $consultaAdministradores->fetchAll();

if( !empty($administradores) ){
	for( $tupla = 0; $tupla < count($administradores); $tupla++ ){
		$administrador = [
			"codigo" => $administradores[$tupla]['codigo'],
			"nombre" => utf8_encode($administradores[$tupla]['nombre']),
			"estado" => $administradores[$tupla]['estado']
		];
		array_push($respuesta["administradores"], $administrador);
	}	
}else{
	$respuesta = ["error" => true];
}

echo json_encode($respuesta);
