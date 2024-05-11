<?php 

session_start();

require '../../funciones.php';

// Comprobación Sesión Existente
if( isset($_SESSION['boleta']) ){
	if( !empty($_SESSION['boleta']) ) {
		header('Location: ../../panel/alumno/');
	}
}else{
	require_once 'view.php';
}
