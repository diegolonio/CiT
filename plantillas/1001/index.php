<?php
date_default_timezone_set('America/Mexico_City');
session_start();
try {
	$conexion = new PDO("mysql:host=localhost;dbname=cit;", 'root', '');
} catch (PDOException $e) {
	echo "Error: ".$e->getMessage();
}
$boletaAlumno = $_SESSION['boleta'];
$datosAlumno = $conexion->prepare('SELECT concat(apePat," ",apeMat," ",nombre) AS "nombre", grupo FROM alumno WHERE boleta = :boleta');
$datosAlumno->execute(array( ':boleta' => $boletaAlumno ));
$datosAlumno = $datosAlumno->fetchAll();
$nombreAlumno = $datosAlumno[0]['nombre'];
$grupoAlumno = $datosAlumno[0]['grupo'];
switch ((int)substr($grupoAlumno, 0, 1)) {
	case 1:
		$nivelAlumno = 'PRIMER NIVEL';
		break;
	case 2:
		$nivelAlumno = 'SEGUNDO NIVEL';
		break;
	case 3:
		$nivelAlumno = 'TERCER NIVEL';
		break;
	case 4:
		$nivelAlumno = 'CUARTO NIVEL';
		break;
	case 5:
		$nivelAlumno = 'QUINTO NIVEL';
		break;
	case 6:
		$nivelAlumno = 'SEXTO NIVEL';
		break;
	default:
		echo 'Nivel inexistente';
		break;
}
$dia = date('d');
$mes = date('F');
$meses_ES = array("ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE");
$meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
$mes = str_replace($meses_EN, $meses_ES, $mes);
$anio = date('Y');
require 'view.php';
