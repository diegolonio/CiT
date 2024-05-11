<?php

session_start();

require '../../../funciones.php';

// Comprobación sesión existente
if( !isset($_SESSION['empleado']) ){
	header('Location: ../../../login/admin/');
}else{
	include 'view.php';
}
