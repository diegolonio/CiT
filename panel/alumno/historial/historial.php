<?php

error_reporting(0);
header('Content-type: application/json; charset=utf-8');

session_start();

$identificadorSesion = $_SESSION['boleta'];

include '../../../conexion.php';

// Configuración Zona horaria
include '../zona_horaria.php';

$respuesta = [
	"registros" => []
];

// Paginación
$pagina = isset($_POST['pagina']) ? (int)$_POST['pagina'] : 1;
$solicitudesPorPagina = 10;
$inicio = ($pagina > 1) ? ($pagina * $solicitudesPorPagina - $solicitudesPorPagina) : 0;

// Filtros registros

// Filtro Documento
$docs = '';
if( !empty($_POST['docs']) ){
	$filtro_documentos = $_POST['docs'];
	if( $filtro_documentos != '' ){
		$docs = 'AND s.codDoc=' . $filtro_documentos;
	}
}

// Filtro Número Solicitud
$no = '';
if( !empty($_POST['no']) ){
	$noSolicitud = $_POST['no'];
	if( $noSolicitud != '' ){
		$no = 'AND s.noSolicitud=' . $noSolicitud;
	}
}

// Filtro Fecha
$dat = '';
if( !empty($_POST['date']) ){
	$filtro_fecha = $_POST['date'];
	if( $filtro_fecha != '' ){
		$dat = 'AND s.fechaSolicitud="' . $filtro_fecha . '"';
	}
}

// Filtro Autorización
$est = '';
if( !empty($_POST['filtro_estado']) ){
	$filtro_estado = $_POST['filtro_estado'];
	$est = 'AND s.autorizacion=' . $filtro_estado;
}

// Consulta registros solicitudes
$historialDeRegistros = $conexion->prepare("SELECT sql_calc_found_rows s.codDoc AS 'numero', s.noSolicitud AS 'solicitud', doc.nomDoc AS 'documento', s.fechaSolicitud AS 'fecha', s.autorizacion AS 'estado', s.motivo AS 'motivo' FROM solicitud s, historial h, documentos doc WHERE s.codDoc=doc.codDoc AND h.noSolicitud=s.noSolicitud AND h.boleta = :boleta $docs $no $dat $est ORDER BY h.noSolicitud DESC LIMIT $inicio, $solicitudesPorPagina");
$historialDeRegistros->execute(array(':boleta' => $identificadorSesion));
$registros = $historialDeRegistros->fetchAll();

// Paginación
$numeroDeRegistros = count($registros);
$totalSolicitudes = $conexion->query('select found_rows() as total'); 
$totalSolicitudes = $totalSolicitudes->fetch()['total']; 
$numeroPaginas = ceil($totalSolicitudes / $solicitudesPorPagina);


if( !$numeroDeRegistros && $pagina > 1 ){
	$respuesta = ["error" => true];
}else if( !empty($registros) ){
	for( $tupla = 0; $tupla < count($registros); $tupla++ ){

		$respuesta["paginacion"]["numeroDeRegistros"] = (int)$numeroDeRegistros;
		$respuesta["paginacion"]["pagina"] = (int)$pagina;
		$respuesta["paginacion"]["numeroPaginas"] = (int)$numeroPaginas;

		$registro = [
			"documento" => utf8_encode($registros[$tupla]['documento']),
			"folio" => $registros[$tupla]['solicitud'],
			"fecha" => fecha($registros[$tupla]['fecha']),
			"estado" => $registros[$tupla]['estado']
		];

		array_push($respuesta["registros"], $registro);

	}
}else{
	$respuesta = [
		"registros" => false
	];
}

echo json_encode($respuesta);
