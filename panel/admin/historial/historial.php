<?php

error_reporting(0);
header('Content-type: application/json; charset=utf-8');

// Conexión a base de datos
require '../../../conexion.php';

// Configuración Zona horaria
include '../zona_horaria.php';

$respuesta = [
	"paginacion" => [],
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
if( !empty($_POST['estado']) ){
	$filtro_estado = $_POST['estado'];
	$est = 'AND s.autorizacion=' . $filtro_estado;
}

// Filtro Boleta
$bol = '';
if( !empty($_POST['boleta']) ){
	$filtro_boleta = $_POST['boleta'];
	$bol = "AND h.boleta LIKE '%".$filtro_boleta."%'";
}

// Consulta datos solicitudes
$historial = $conexion->prepare("SELECT sql_calc_found_rows h.boleta AS 'boleta', s.noSolicitud AS 'solicitud', doc.nomDoc AS 'documento', s.fechaSolicitud AS 'fecha', s.autorizacion as 'autorizacion' FROM alumno a, solicitud s, historial h, documentos doc WHERE s.codDoc=doc.codDoc AND h.noSolicitud=s.noSolicitud AND h.boleta = a.boleta $bol $docs $no $dat $est ORDER BY h.noSolicitud DESC LIMIT $inicio, $solicitudesPorPagina");
$historial->execute();
$solicitudHistorial = $historial->fetchAll();

// Paginación
$numeroDeRegistros = count($solicitudHistorial);
$totalSolicitudes = $conexion->query('select found_rows() as total'); 
$totalSolicitudes = $totalSolicitudes->fetch()['total']; 
$numeroPaginas = ceil($totalSolicitudes / $solicitudesPorPagina);


if( !$numeroDeRegistros && $pagina > 1 ){
	$respuesta = ["error" => true];
}else if( !empty($solicitudHistorial) ){

	$respuesta["paginacion"]["numeroDeRegistros"] = (int)$numeroDeRegistros;
	$respuesta["paginacion"]["pagina"] = (int)$pagina;
	$respuesta["paginacion"]["numeroPaginas"] = (int)$numeroPaginas;

	for( $tupla = 0; $tupla < count($solicitudHistorial); $tupla++ ){

		$registro = [
			"boleta" => $solicitudHistorial[$tupla]['boleta'],
			"documento" => utf8_encode($solicitudHistorial[$tupla]['documento']),
			"folio" => $solicitudHistorial[$tupla]['solicitud'],
			"fecha" => fecha($solicitudHistorial[$tupla]['fecha']),
			"estado" => $solicitudHistorial[$tupla]['autorizacion']
		];

		array_push($respuesta["registros"], $registro);

	}
}else{
	$respuesta = [
		"registros" => false
	];
}

echo json_encode($respuesta);
