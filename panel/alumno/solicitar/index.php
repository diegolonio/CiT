<?php

session_start();

require '../../../funciones.php';

// Comprobación sesión existente
if( !isset($_SESSION['boleta']) ){
	header('Location: ../../../login/alumno/');
}else{
	require_once 'view.php';
}
