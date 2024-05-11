<?php

error_reporting(0);
header('Content-type: application/json; charset=utf-8');

session_start();

include '../../../conexion.php';

$sessionid = $_SESSION['boleta'];

$respuesta = ["nombre" => '', "boleta" => '', "grupo" => '', "semestre" => ''];

// Consulta datos alumno
$consulta = $conexion->prepare('SELECT * FROM alumno WHERE boleta = :boleta LIMIT 1');
$consulta->execute(array(':boleta' => $sessionid));
$datos = $consulta->fetch();

// Clase alumno
class ALUMNO {
	public $nombre;
	public $apePat;
	public $apeMat;
	public $boleta;
	public $grupo;
	public $semestre;
	function __construct($nombre, $apePat, $apeMat, $boleta, $grupo, $semestre){
		$this->nombre = $nombre.' '.$apePat.' '.$apeMat;
		$this->boleta = $boleta;
		$this->grupo = $grupo;
		$this->semestre = $semestre;
	}
}

// Parseo datos alumno
$alumno = new ALUMNO($datos['nombre'], $datos['apePat'], $datos['apeMat'], $datos['boleta'], $datos['grupo'], $datos['semestre']);

$respuesta["nombre"] .= $alumno->nombre;
$respuesta["boleta"] .= $alumno->boleta;
$respuesta["grupo"] .= $alumno->grupo;
$respuesta["semestre"] .= $alumno->semestre;

echo json_encode($respuesta);
