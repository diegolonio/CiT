<?php

error_reporting(0);
header('Content-type: application/json; charset=utf-8');

// Conexion a base de datos
require '../../../conexion.php';

$respuesta = [];

// Acciones al presionar botón Autorizar
if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
	if( !empty($_POST['autorizar']) ){
		$folio = $_POST['autorizar'];
		$archivo_documento_autorizado = $conexion->prepare("SELECT archivo FROM solicitud WHERE noSolicitud = :folio");
		$archivo_documento_autorizado->execute(array(':folio' => $folio));
		$archivo =  $archivo_documento_autorizado->fetch()['archivo'];
		if(!empty($archivo)){
			$autorizarDocumento = $conexion->prepare("UPDATE solicitud SET autorizacion = 2 WHERE noSolicitud = :folio");
			$autorizarDocumento->execute(array(':folio' => $folio));
			if($autorizarDocumento->rowCount() == 1){
				$respuesta["autorizado"] = true;
				$respuesta["archivo"] = $archivo;
			}else{
				$respuesta["error"] = true;
			}
		}else{
			$respuesta["error"] = true;
		}
	}
	if( !empty($_POST['cancelar']) ){
		$folio = $_POST['cancelar'];
		$archivo_documento_cancelado = $conexion->prepare("SELECT archivo FROM solicitud WHERE noSolicitud = :folio");
		$archivo_documento_cancelado->execute(array(':folio' => $folio));
		$archivo =  $archivo_documento_cancelado->fetch()['archivo'];
		$archivo_eliminado = unlink('../../../documentos/'.$archivo);
		if($archivo_eliminado){
			$cancelarDocumento = $conexion->prepare("UPDATE solicitud SET autorizacion = 3 WHERE noSolicitud = :folio");
			$cancelarDocumento->execute(array(':folio' => $folio));
			if($cancelarDocumento->rowCount() == 1){
				$respuesta["cancelado"] = true;
			}else{
				$respuesta["error"] = true;
			}
		}else{
			$respuesta["error"] = true;
		}
	}
}

echo json_encode($respuesta);
