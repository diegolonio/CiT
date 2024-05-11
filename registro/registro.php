<?php

error_reporting(0);
header('Content-type: application/json; charset=utf-8');

// Declaración de la respuesta JSON
$respuesta = ["exito" => false, "error" => false, "mensaje" => ''];

// Conexión base de datos
require '../conexion.php';

if( $_SERVER['REQUEST_METHOD'] == 'POST' ){

	// Boleta
	$boletaIngresada = trim($_POST['ingresoBoleta']);
	$boletaIngresada = filter_var($boletaIngresada, FILTER_SANITIZE_STRING);
	if( empty($boletaIngresada) ){
		$respuesta["error"] = true;
		$respuesta["mensaje"] .= 'Debes ingresar una boleta<br>';
	}else if( intval($boletaIngresada) === 0 ){
		$respuesta["error"] = true;
		$respuesta["mensaje"] .= 'La boleta que ingresaste no es válida<br>';
	}
	
	// Correo
	$correoIngresado = trim($_POST['ingresoCorreo']);
	if( !empty($correoIngresado) ){
		$correoIngresado =  filter_var($correoIngresado, FILTER_SANITIZE_EMAIL);

		// Validación Email
		if( !filter_var($correoIngresado, FILTER_VALIDATE_EMAIL) ){
			$respuesta["error"] = true;
			$respuesta["mensaje"] .= 'Correo no válido<br>';
		}
	}else{
		$respuesta["error"] = true;
		$respuesta["mensaje"] .= 'Debes ingresar un correo<br>';
	}

	// Confirmación correo
	$confirmacionDeCorreo = trim($_POST['confirmacionDeCorreo']);
	if( !empty($confirmacionDeCorreo) ){
		$confirmacionDeCorreo = filter_var($confirmacionDeCorreo, FILTER_SANITIZE_EMAIL);

		// Validación Email 
		if( !filter_var($confirmacionDeCorreo, FILTER_VALIDATE_EMAIL) ){
			$respuesta["error"] = true;
			$respuesta["mensaje"] .= 'El correo que ingresaste no es válido<br>';
		}else{
			if( $correoIngresado != $confirmacionDeCorreo ){
				$respuesta["error"] = true;
				$respuesta["mensaje"] .= 'Los correos no coinciden<br>';
			}
		}
	}else{
		$respuesta["error"] = true;
		$respuesta["mensaje"] .= 'Debes confirmar el correo que ingresaste<br>';
	}

	// Contraseña
	$passwordIngresado = trim($_POST['ingresoPassword']);
	if( !empty($passwordIngresado) ){
		$passwordIngresado = trim($passwordIngresado);
	}else{
		$respuesta["error"] = true;
		$respuesta["mensaje"] .= 'Debes ingresar una contraseña<br>';
	}

	// Confirmación contraseña
	$confirmacionDePassword = trim($_POST['confirmacionDePassword']);
	if( !empty($confirmacionDePassword) ){
		$confirmacionDePassword = trim($confirmacionDePassword);

		// Comprobación contraseña y confirmación de contraseña iguales
		if( $passwordIngresado != $confirmacionDePassword ){
			$respuesta["error"] = true;
			$respuesta["mensaje"] .= 'Las contraseñas no coinciden<br>';
		}
	}else{
		$respuesta["error"] = true;
		$respuesta["mensaje"] .= 'Debes confirmar la contraseña que ingresaste<br>';
	}

	// Primera comprobación no errores
	if( !$respuesta["error"] ){

		// Comprobación existencia Alumno
		$comprobacionAlumnoExistencia = $conexion->prepare("SELECT * FROM alumno WHERE boleta = :boleta LIMIT 1");
		$comprobacionAlumnoExistencia->execute(array(':boleta' => $boletaIngresada));
		$datosAlumno = $comprobacionAlumnoExistencia->fetch();
		if( $datosAlumno === false ){
			$respuesta["error"] = true;
			$respuesta["mensaje"] .= 'La boleta que ingresaste no existe<br>';
		}

		// Comprobación existencia Boleta
		$comprobacionBoletaExistencia = $conexion->prepare("SELECT * FROM usuario WHERE boleta = :boleta LIMIT 1");
		$comprobacionBoletaExistencia->execute(array(':boleta' => $boletaIngresada));
		$datosUsuario = $comprobacionBoletaExistencia->fetch();
		if( $datosUsuario !== false ){
			$respuesta["error"] = true;
			$respuesta["mensaje"] .= 'La boleta que ingresaste ya ha sido registrada<br>';
		}

		// Segunda comprobación no errores
		if( !$respuesta["error"] ){

			// Registro del Usuario
			$registrarUsuario = $conexion->prepare("INSERT INTO usuario VALUES(:boleta, :correo, :password, 10)");
			$registrarUsuario->execute(array(':boleta' => $boletaIngresada, ':correo' => $correoIngresado, ':password' => $passwordIngresado));

			// Mensaje registro exitoso
			$respuesta["exito"] = true;
			$respuesta["mensaje"] .= 'Registro exitoso';

		}

	}

}

echo json_encode($respuesta);
