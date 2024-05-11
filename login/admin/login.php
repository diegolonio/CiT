<?php

error_reporting(0);
header('Content-type: application/json; charset=utf-8');

session_start();

// Declaración de la respuesta JSON
$respuesta = ["exito" => false, "error" => false, "path" => '', "mensaje" => ''];

// Conexión base de datos
require '../../conexion.php';

if( $_SERVER['REQUEST_METHOD'] == 'POST' ){

    // Boleta
    $codigoIngresado = trim($_POST['codigo']);
    $codigoIngresado = filter_var($codigoIngresado, FILTER_SANITIZE_STRING);

    // Contraseña
    $passwordIngresado = $_POST['password'];

    // Consulta credenciales
    $consulta = $conexion->prepare('SELECT noEmpleado AS "codigo", contrasenia AS "contra", estado FROM administrador WHERE noEmpleado = :codigo AND contrasenia = :password LIMIT 1');
    $consulta->execute(array(':codigo' => $codigoIngresado, ':password' => $passwordIngresado));
    $datos = $consulta->fetch();

    // Comprobación existencia credenciales
    if($datos !== false){

      // Comprobación estado administrador
      if($datos['estado'] == 1){

        // Asignación identificador sesión
        $_SESSION['empleado'] = $codigoIngresado;

        // Reedireccionamiento al inicio
        $respuesta["exito"] = true;
        $respuesta["path"] .= '../../panel/admin/';

      }else if($datos['estado'] == 0){
        $respuesta["error"] = true;
        $respuesta["mensaje"] .= 'Este usuario ha sido dado de baja';
      }

    }else {
      $respuesta["error"] = true;
      $respuesta["mensaje"] .= 'Usuario y/o Contraseña incorrectos';    
    }

}

echo json_encode($respuesta);
