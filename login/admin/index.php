<?php 

session_start();

require '../../funciones.php';

// Comprobación Sesión Existente
if( isset($_SESSION['empleado']) ){
	if( !empty($_SESSION['empleado']) ) {
		header('Location: ../../panel/admin/');
	}
}else{
	require_once 'view.php';
}
