<?php

error_reporting(0);
header('Content-type: application/json; charset=utf-8');

session_start();

$identificadorSesion = $_SESSION['boleta'];

$respuesta = [];

// Conexión a base de datos
include '../../../conexion.php';

// Consulta solicitudes disponibles del usuario
$consultaSolicitudesDisponibles = $conexion->prepare("SELECT solDisponibles FROM usuario WHERE boleta=:boleta");
$consultaSolicitudesDisponibles->execute(array(':boleta' => $identificadorSesion));
$datos = $consultaSolicitudesDisponibles->fetchAll();
$solicitudesDisponibles = $datos[0]['solDisponibles'];

$respuesta["solicitudesDisponibles"] = (int)$solicitudesDisponibles;

echo json_encode($respuesta);
