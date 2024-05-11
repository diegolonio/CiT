<?php

error_reporting(0);
header('Content-type: application/json; charset=utf-8');

session_start();
$codigo = $_SESSION['empleado'];

// Conexión a base de datos
require '../../../conexion.php';

// Consulta datos Administrador
$consulta = $conexion->prepare('SELECT * FROM empleado WHERE noEmpleado = :codigo LIMIT 1');
$consulta->execute(array(':codigo' => $codigo));
$datos = $consulta->fetch();

// Objeto ADMINISTRADOR
class ADMINISTRADOR{
	public $nombre;
	public $apePat;
	public $apeMat;
	public $numero;
	function __construct($nombre, $apePat, $apeMat, $numero){
		$this->nombre = $nombre.' '.$apePat.' '.$apeMat;
		$this->codigo = $numero;
	}
}

// Creación nuevo objeto ADMINISTRADOR
$administrador = new ADMINISTRADOR(utf8_encode($datos['nombre']), utf8_encode($datos['apePat']), utf8_encode($datos['apeMat']), $datos['noEmpleado']);

$respuesta = [
	"nombre" => $administrador->nombre,
	"codigo" =>$administrador->codigo
];

echo json_encode($respuesta);
