<?php  

session_start();

// Comprobación sesión existente
if( !isset($_SESSION['empleado']) ){
	header('Location: ../../login/admin/');
}else{
	$identificadorSesion = $_SESSION['empleado'];
	header('Location: resumen/');
}
