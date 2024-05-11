<?php

error_reporting(0);
header('Content-type: application/json; charset=utf-8');

session_start();

// Declaración de la respuesta JSON
$respuesta = ["exito" => false, "error" => false, "path" => ''];

// Conexión base de datos
require '../../conexion.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	// Boleta
	$boletaIngresada = trim($_POST['boleta']);
	$boletaIngresada = filter_var($boletaIngresada, FILTER_SANITIZE_STRING);

	// Contraseña
	$passwordIngresado = $_POST['password'];

	// Comprobación credenciales
	$consulta = $conexion->prepare('SELECT boleta, contrasenia AS "pass" FROM usuario WHERE boleta = :boleta AND contrasenia = :pass LIMIT 1');
	$consulta->execute(array(':boleta' => $boletaIngresada, ':pass' => $passwordIngresado));
	$datos = $consulta->fetch();

	// Comprobación existencia de credenciales
	if($datos !== false){

		// Asignación identificador sesión
		$_SESSION['boleta'] = $boletaIngresada;

		$respuesta["exito"] = true;
		$respuesta["path"] .= '../../panel/alumno/resumen/';

	}else{
		$respuesta["error"] = true;
	}

}

echo json_encode($respuesta);
