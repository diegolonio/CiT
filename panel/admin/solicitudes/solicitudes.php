<?php

error_reporting(0);
header('Content-type: application/json; charset=utf-8');

// Conexion a base de datos
include '../../../conexion.php';

// Configuración Zona horaria
include '../zona_horaria.php';

$respuesta = [
	"registros" => []
];

// Paginación
$pagina = isset($_POST['pagina']) ? (int)$_POST['pagina'] : 1;
$solicitudesPorPagina = 9;
$inicio = ($pagina > 1) ? ($pagina * $solicitudesPorPagina - $solicitudesPorPagina) : 0;

// Filtros registros

// Filtro Boleta
$bol = '';
if( !empty($_POST['boleta']) ){
	$filtro_boleta = $_POST['boleta'];
	if( $filtro_boleta != '' ){
		$bol = "AND h.boleta LIKE '%".$filtro_boleta."%'";
	}
}

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

// Consulta solicitudes pendientes
$consultaSolicitudes = $conexion->prepare("SELECT sql_calc_found_rows a.boleta AS 'boleta', d.nomDoc AS 'documento', s.noSolicitud AS 'solicitud', s.autorizacion AS 'autorizacion', s.fechaSolicitud AS 'fecha', s.archivo AS 'archivo', s.motivo AS 'motivo' FROM alumno a, documentos d, solicitud s, historial h where s.noSolicitud = h.noSolicitud and s.codDoc = d.codDoc and a.boleta = h.boleta AND !(s.autorizacion = 2) AND !(s.autorizacion = 3) $bol $docs $no $dat ORDER BY s.noSolicitud DESC LIMIT $inicio, $solicitudesPorPagina");
$consultaSolicitudes->execute();
$registros = $consultaSolicitudes->fetchAll();

// Paginación
$numeroDeRegistros = count($registros);
$totalSolicitudes = $conexion->query('select found_rows() as total'); 
$totalSolicitudes = $totalSolicitudes->fetch()['total']; 
$numeroPaginas = ceil($totalSolicitudes / $solicitudesPorPagina);


if( !$numeroDeRegistros && $pagina > 1 ){
	$respuesta = ["error" => true];
}else if( !empty($registros) ){

	$respuesta["paginacion"]["numeroDeRegistros"] = (int)$numeroDeRegistros;
	$respuesta["paginacion"]["pagina"] = (int)$pagina;
	$respuesta["paginacion"]["numeroPaginas"] = (int)$numeroPaginas;

	for( $tupla = 0; $tupla < count($registros); $tupla++ ){

		$registro = [			
			"boleta" => $registros[$tupla]['boleta'],
			"documento" => utf8_encode($registros[$tupla]['documento']),
			"folio" => $registros[$tupla]['solicitud'],
			"fecha" => fecha($registros[$tupla]['fecha']),
			"motivo" => utf8_encode($registros[$tupla]['motivo']),
			"estado" => $registros[$tupla]['autorizacion'],
			"archivo" => $registros[$tupla]['archivo']
		];

		array_push($respuesta["registros"], $registro);

	}
	
}else{
	$respuesta = ["registros" => false];
}

echo json_encode($respuesta);
