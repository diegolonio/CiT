<?php

session_start();

// Comprobación sesión existente
if( !isset($_SESSION['empleado']) ){
	header('Location: ../../../login/admin/');
}else{
	$identificadorSesion = $_SESSION['empleado'];
}

// Conexión base de datos
require '../../../conexion.php';
