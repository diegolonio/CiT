<?php

error_reporting(0);
header('Content-type: application/json; charset=utf-8');

session_start();
$identificadorSesion = $_SESSION['boleta'];


// Conexión a base de datos
include '../../../conexion.php';

// Configuración zona horaria
include '../zona_horaria.php';

// Generador pdf
require '../../../librerias/generador.php';

// Consulta solicitudes disponibles del usuario
$solicitudesDisponibles = $conexion->prepare('SELECT solDisponibles FROM usuario WHERE boleta = :boleta');
$solicitudesDisponibles->execute(array(':boleta' => $identificadorSesion));
$solicitudesDisponibles = (int)($solicitudesDisponibles->fetch()['solDisponibles']);

$respuesta = [];

if( $_SERVER['REQUEST_METHOD'] == 'POST' ){

	if( isset($_POST['codDoc']) && !empty(trim($_POST['codDoc'])) && intval(trim($_POST['codDoc'])) !== 0 ){

		if( $solicitudesDisponibles > 0 ){

			// Preparación datos solicitud
			$codDoc = trim($_POST['codDoc']);
			$codDoc = stripslashes($codDoc);
			$codDoc = htmlspecialchars($codDoc);
			$codDoc = filter_var($codDoc, FILTER_SANITIZE_STRING);
			$codDoc = (int)$codDoc;
			$fechaSolicitud = date('Y-m-d');
			$fechaEntrega = strtotime('+5 day', strtotime($fechaSolicitud));
			$fechaEntrega = date('Y-m-j', $fechaEntrega);
			$motivo = trim($_POST['motivo']);
			$motivo = stripslashes($motivo);
			$motivo = htmlspecialchars($motivo);
			$motivo = filter_var($motivo, FILTER_SANITIZE_STRING);

			// Folio de la solicitud
			$folioSolicitud = $conexion->prepare("SELECT COUNT(*) AS 'folio' FROM solicitud");
			$folioSolicitud->execute();
			$folioSolicitud = $folioSolicitud->fetch()['folio'] + 1;

			// Nombre del archivo generado
			$nombreArchivo = $folioSolicitud.$identificadorSesion.str_replace('-', '',$fechaSolicitud).'.pdf';

			// Generación del documento
			$archivo = pdf($_SERVER['DOCUMENT_ROOT'].'/cit/plantillas/'.$codDoc.'/index.php', $_SERVER['DOCUMENT_ROOT'].'/cit/documentos/'.$nombreArchivo);

			if( $archivo ){

				// Copia de respaldo del documento
				$archivo = pdf($_SERVER['DOCUMENT_ROOT'].'/cit/plantillas/'.$codDoc.'/index.php', $_SERVER['DOCUMENT_ROOT'].'/cit/backup_docs/'.$nombreArchivo);

				// Actualización número solicitudes disponibles
				$solicitudesDisponibles--;
				$menosUnaSolicitud = $conexion->prepare("UPDATE usuario SET solDisponibles = :solicitudes WHERE boleta = :boleta");
				$menosUnaSolicitud->execute(array(':solicitudes' => $solicitudesDisponibles, ':boleta' => $identificadorSesion));

				// Registro de solicitud
				$registroDeSolicitud = $conexion->prepare('INSERT INTO solicitud VALUES(NULL, :codDoc, :fechaSolicitud, :fechaEntrega, :motivo, 1, :archivo)');
				$registroDeSolicitud->execute(array(':codDoc' => $codDoc,':fechaSolicitud' => $fechaSolicitud,':fechaEntrega' => $fechaEntrega,':motivo' => $motivo, ':archivo' => $nombreArchivo));

				// Registro de solicitud en historial
				$registroEnHistorial = $conexion->prepare('INSERT INTO historial VALUES(:boleta, NULL)');
				$registroEnHistorial->execute(array(':boleta' => $identificadorSesion));

				// Mensaje solicitud exitosa
				$respuesta["exito"] = true;
				$respuesta["mensaje"] = 'Solicitud entregada con éxito';

			}else{
				$respuesta["error"] = true;
				$respuesta["mensaje"] = 'Algo salió mal inténtalo de nuevo más tarde';
			}

		}else{
			$respuesta["error"] = true;
			$respuesta["mensaje"] = 'No tienes más solicitudes disponibles para este periodo escolar, acude a Gestión Escolar';
		}

	}else{ 
		$respuesta["error"] = true;
		$respuesta["mensaje"] = 'Algo salió mal inténtalo de nuevo más tarde';
	}

}

echo json_encode($respuesta);
