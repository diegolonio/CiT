<?php

// Datos conexión DB
$conexionHost = 'localhost';
$conexionDB = 'cit';
$conexionUser = 'root';
$conexionPassword = '';

// Conexión PDO
try {
	$conexion = new PDO("mysql:host=$conexionHost;dbname=$conexionDB;", $conexionUser, $conexionPassword);
	$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo "Error: ".$e->getMessage();
	die();
}
