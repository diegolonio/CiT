<?php

error_reporting();
header('Content-type: application/json; charset=utf-8');

// Conexion a base de datos
require '../../../conexion.php';

$respuesta = [];

if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
	if( !empty($_POST['baja']) ){
		$codigo = $_POST['baja'];
		$darDeBajaAdministrador = $conexion->prepare("UPDATE administrador SET estado = 0 WHERE noEmpleado = :codigo");
		$darDeBajaAdministrador->execute(array(':codigo' => $codigo));
		if( $darDeBajaAdministrador->rowCount() > 0 ){
			$respuesta["exito"] = true;
		}else{
			$respuesta["error"] = true;
		}
	}
	if( !empty($_POST['alta']) ){
		$codigo = $_POST['alta'];
		$dardeAltaAdministrador = $conexion->prepare("UPDATE administrador SET estado = 1 WHERE noEmpleado = :codigo");
		$dardeAltaAdministrador->execute(array(':codigo' => $codigo));
		if( $dardeAltaAdministrador->rowCount() > 0 ){
			$respuesta["exito"] = true;
		}else{
			$respuesta["error"] = true;
		}
	}
}

echo json_encode($respuesta);
