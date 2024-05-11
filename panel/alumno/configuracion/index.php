<?php

session_start();

require '../../../funciones.php';

if( isset($_SESSION['boleta']) ){
	$identificadorSesion = $_SESSION['boleta'];
}else{
	header('Location: ../../../login/alumno/');
}

require 'view.php';
