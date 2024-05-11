<?php

session_start();

// Comprobación sesión existente
if( !isset($_SESSION['boleta']) ){
	header('Location: ../../login/alumno/');
}else{
	header('Location: resumen/');
}
