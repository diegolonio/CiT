<?php

error_reporting(0);
header('Content-type: application/json; charset=utf-8');

require '../../../conexion.php';

$respuesta = [];

if( $_SERVER['REQUEST_METHOD'] == 'POST' ){

	if( isset($_POST['codigo']) ){

		$respuesta["mensaje"] = '';

		// Código empleado
		if( !empty(trim($_POST['codigo'])) ){
			$codigo = $_POST['codigo'];
			$codigo = trim($codigo);
			$codigo = filter_var($codigo, FILTER_SANITIZE_STRING);
		}else{
			$respuesta["error"] = true;
			$respuesta["mensaje"] .= 'Por favor, ingresa un número de empleado <br>';
		}

		// Correo ingresado
		if( !empty(trim($_POST['correo'])) ){
			$correo = $_POST['correo'];
			$correo = trim($correo);
			$correo = filter_var($correo, FILTER_SANITIZE_EMAIL);

			// Comprobación Correo válido
			if( !filter_var($correo, FILTER_VALIDATE_EMAIL) ){
				$respuesta["error"] = true;
				$respuesta["mensaje"] .= 'Por favor, ingresa un correo válido <br>';
			}
		}else{
			$respuesta["error"] = true;
			$respuesta["mensaje"] .= 'Por favor, ingresa un correo electrónico <br>';
		}

		// Confirmación correo ingresado
		if( !empty(trim($_POST['confirmacion_correo'])) ){
			$confirmacion_correo = $_POST['confirmacion_correo'];
			$confirmacion_correo = trim($confirmacion_correo);
			$confirmacion_correo = filter_var($confirmacion_correo, FILTER_SANITIZE_EMAIL);

			// Comprobación correo válido
			if( !filter_var($confirmacion_correo, FILTER_VALIDATE_EMAIL) ){
				$respuesta["error"] = true;
				$respuesta["mensaje"] .= 'Por favor, ingresa un correo válido <br>';
			}else{

				// Comprobación correo ingresado y confirmación correo iguales
				if( $correo != $confirmacion_correo ){
					$respuesta["error"] = true;
					$respuesta["mensaje"] .= 'Los correos ingresados no coinciden <br>';
				}
			}
		}else{
			$respuesta["error"] = true;
			$respuesta["mensaje"] .= 'Por favor, confirma el correo que ingresaste <br>';
		}

		// Contraseña ingresada
		if( !empty(trim($_POST['password'])) ){
			$password = $_POST['password'];
			$password = trim($password);
		}else{
			$respuesta["error"] = true;
			$respuesta["mensaje"] .= 'Por favor, ingresa una contraseña <br>';
		}

		// Confirmación contraseña ingresada
		if( !empty(trim($_POST['confirmacion_password'])) ){
			$confirmacion_password = $_POST['confirmacion_password'];
			$confirmacion_password = trim($confirmacion_password);

			// Comprobación contraseña ingresada y confirmación contraseña iguales
			if( $password != $confirmacion_password ){
				$respuesta["error"] = true;
				$respuesta["mensaje"] .= 'Las contraseñas no coinciden <br>';
			}
		}else{
			$respuesta["error"] = true;
			$respuesta["mensaje"] .= 'Por favor, verifica la contraseña que ingresaste <br>';
		}

		// Comprobación no errores
		if( !isset($respuesta["error"]) ){

			// Consulta código ingresado
			$comprobacionEmpleadoExistencia = $conexion->prepare("SELECT * FROM empleado WHERE noEmpleado = :codigo LIMIT 1");
			$comprobacionEmpleadoExistencia->execute(array(':codigo' => $codigo));
			$datosEmpleado = $comprobacionEmpleadoExistencia->fetch();

			// Comprobación inexistencia Código empleado
			if( $datosEmpleado === false ){
				$respuesta["error"] = true;
				$respuesta["mensaje"] .= 'Número de empleado inexistente';
			}else{

				// Consulta Código administrador
				$comprobacionCodigoExistencia = $conexion->prepare("SELECT * FROM administrador WHERE noEmpleado = :codigo LIMIT 1");
				$comprobacionCodigoExistencia->execute(array(':codigo' => $codigo));
				$datosAdministrador = $comprobacionCodigoExistencia->fetch();

				// Comprobación inexistencia Código administrador
				if( $datosAdministrador != false ){
					$respuesta["error"] = true;
					$respuesta["mensaje"] .= 'Este empleado ya ha sido registrado';
				}else{

					// Registro del administrador
					$registroAdministrador = $conexion->prepare("INSERT INTO administrador VALUES(:codigo, :correo, :password, 1)");
					$comprobacionRegistroExitoso = $registroAdministrador->execute(array(':codigo' => $codigo, ':correo' => $correo, ':password' => $password));

					// Comprobación registro exitoso
					if( $comprobacionRegistroExitoso != false ){
						$respuesta["error"] = false;
						$respuesta["mensaje"] = 'Registro exitoso';
					}

				}

			}
			
		}

	}

}

echo json_encode($respuesta);
