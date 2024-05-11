<?php

session_start();
header('Content-type: application/json; charset=utf-8');

$respuesta = [];

require '../../../conexion.php';

if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
	if( !empty($_POST['password']) ){
		$password = $_POST['password'];
		$password = trim($password);
		$password = stripslashes($password);
		$password = htmlspecialchars($password);
		$password = filter_var($password, FILTER_SANITIZE_STRING);

		$codigo = $_SESSION['empleado'];

		$contrasenia = $conexion->prepare('SELECT contrasenia FROM administrador WHERE noEmpleado = :codigo');
		$contrasenia->execute(array( ':codigo' => $codigo ));
		$contrasenia = $contrasenia->fetch()['contrasenia'];

		if( !empty($contrasenia) ){
			if( $contrasenia == $password ){
				$respuesta["exito"] = true;
			}else{
				$respuesta["error"] = true;
			}
		}else{
			$respuesta["error"] = true;
		}

	}
}

echo json_encode($respuesta);
