<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(isset($_POST['buscarBoletaModificada'])){
		$erroresConsultaDatosAlumno = '';
		if(!empty($_POST['boletaBuscadaModificable'])){
			$boletaBuscadaModificable = $_POST['boletaBuscadaModificable'];
			$boletaBuscadaModificable = trim($boletaBuscadaModificable);
			$boletaBuscadaModificable = filter_var($boletaBuscadaModificable, FILTER_SANITIZE_STRING);
		}else{
			$erroresConsultaDatosAlumno .= 'Por favor, ingrese una boleta para consultar';
		}
		if($erroresConsultaDatosAlumno == ''){
			$consultaDatosAlumno = $conexion->prepare('SELECT  a.boleta, a.nombre, a.apePat, a.apeMat, a.grupo, a.semestre, u.correo, u.contrasenia FROM alumno a, usuario u WHERE a.boleta=:boleta AND u.boleta=:boleta');
			$consultaDatosAlumno->execute(array(':boleta' => $boletaBuscadaModificable));
			$datosModificables = $consultaDatosAlumno->fetch();
			if($datosModificables == false){
				$erroresConsultaDatosAlumno .= "La boleta ingresada no existe.";
			}else{
				$boletaModificable = $datosModificables['boleta'];
				$nombreModificable = $datosModificables['nombre'];
				$apePatModificable = $datosModificables['apePat'];
				$apeMatModificable = $datosModificables['apeMat'];
				$grupoModificable = $datosModificables['grupo'];
				$semestreModificable = $datosModificables['semestre'];
				$correoModificable = $datosModificables['correo'];
				$contraseniaModificable = $datosModificables['contrasenia'];
			}
		}
	}
	if(isset($_POST['modificarBtn'])){
		$modificacionExitosa = '';
		$modificacionErrores = '';
		if(!empty($_POST['boletaModificable'])){
			$boletaModificada = $_POST['boletaModificable'];
			$boletaModificada = trim($boletaModificada);
			$boletaModificada = filter_var($boletaModificada, FILTER_SANITIZE_STRING);
		}else{
			$modificacionErrores .= 'Por favor ingresa la boleta del alumno <br>';
		}
		if($_POST['grupoAlumnoConfig'] != 0){
			$grupoModificado = $_POST['grupoAlumnoConfig'];
			$grupoModificado = trim($grupoModificado);
			$grupoModificado = filter_var($grupoModificado, FILTER_SANITIZE_STRING);
		}else{
			$modificacionErrores .= 'Por favor ingresa el grupo del alumno <br>';
		}
		if($_POST['semestreAlumnoConfig'] != 0){
			$semestreModificado = $_POST['semestreAlumnoConfig'];
			$semestreModificado = trim($semestreModificado);
			$semestreModificado = filter_var($semestreModificado, FILTER_SANITIZE_STRING);
		}else{
			$modificacionErrores .= 'Por favor ingresa el semestre del alumno <br>';
		}
		if(!empty($_POST['nombreModificable'])){
			$nombreModificado = $_POST['nombreModificable'];
			$nombreModificado = trim($nombreModificado);
			$nombreModificado = filter_var($nombreModificado, FILTER_SANITIZE_STRING);
		}else{
			$modificacionErrores .= 'Por favor ingresa el nombre del alumno <br>';
		}
		if(!empty($_POST['apePatModificable'])){
			$apePatModificado = $_POST['apePatModificable'];
			$apePatModificado = trim($apePatModificado);
			$apePatModificado = filter_var($apePatModificado, FILTER_SANITIZE_STRING);
		}else{
			$modificacionErrores .= 'Por favor ingresa el apellido paterno del alumno <br>';
		}
		if(!empty($_POST['apeMatModificable'])){
			$apeMatModificado = $_POST['apeMatModificable'];
			$apeMatModificado = trim($apeMatModificado);
			$apeMatModificado = filter_var($apeMatModificado, FILTER_SANITIZE_STRING);
		}else{
			$modificacionErrores .= 'Por favor ingresa el apellido materno del alumno <br>';
		}
		if(!empty($_POST['passwordModificable'])){
			$passwordModificado = $_POST['passwordModificable'];
			$passwordModificado = trim($passwordModificado);
			$passwordModificado = filter_var($passwordModificado, FILTER_SANITIZE_STRING);
		}else{
			$modificacionErrores .= 'Por favor ingresa la contraseña del alumno <br>';
		}
		if(!empty($_POST['boletaBuscadaModificable'])){
			$boletaDeReferencia = $_POST['boletaBuscadaModificable'];
			$boletaDeReferencia = trim($boletaDeReferencia);
			$boletaDeReferencia = filter_var($boletaDeReferencia, FILTER_SANITIZE_STRING);
		}else{
			$modificacionErrores = 'No se han podido modificar los datos.';
		}
		if($modificacionErrores == ''){
			$modificarBoletaAlumno = $conexion->prepare("UPDATE alumno SET boleta = :boletaModificada WHERE boleta = :boleta");
			$modificarBoletaAlumno->execute(array(':boletaModificada' => $boletaModificada, ':boleta' => $boletaDeReferencia));
			$comprobacionBoletaModificada = $modificarBoletaAlumno->rowCount();
			$modificarBoletaUsuario = $conexion->prepare("UPDATE usuario SET boleta = :boletaModificada WHERE boleta = :boleta");
			$modificarBoletaUsuario->execute(array(':boletaModificada' => $boletaModificada, ':boleta' => $boletaDeReferencia));
			$modificarBoletaHistorial = $conexion->prepare("UPDATE historial SET boleta = :boletaModificada WHERE boleta = :boleta");
			$modificarBoletaHistorial->execute(array(':boletaModificada' => $boletaModificada, ':boleta' => $boletaDeReferencia));
			if($comprobacionBoletaModificada == 1) $boletaDeReferencia = $boletaModificada;
			$modificarNombre = $conexion->prepare("UPDATE alumno SET nombre = :nombreModificado WHERE boleta = :boleta");
			$modificarNombre->execute(array(':nombreModificado' => $nombreModificado, ':boleta' => $boletaDeReferencia));
			$modificarApePat = $conexion->prepare("UPDATE alumno SET apePat = :apePatModificado WHERE boleta = :boleta");
			$modificarApePat->execute(array(':apePatModificado' => $apePatModificado, ':boleta' => $boletaDeReferencia));
			$modificarApeMat = $conexion->prepare("UPDATE alumno SET apeMat = :apeMatModificado WHERE boleta = :boleta");
			$modificarApeMat->execute(array(':apeMatModificado' => $apeMatModificado, ':boleta' => $boletaDeReferencia));
			$modificarGrupo = $conexion->prepare("UPDATE alumno SET grupo = :grupoModificado WHERE boleta = :boleta");
			$modificarGrupo->execute(array(':grupoModificado' => $grupoModificado, ':boleta' => $boletaDeReferencia));
			$modificarSemestre = $conexion->prepare("UPDATE alumno SET semestre = :semestreModificado WHERE boleta = :boleta");
			$modificarSemestre->execute(array(':semestreModificado' => $semestreModificado, ':boleta' => $boletaDeReferencia));
			$modificarPassword = $conexion->prepare("UPDATE usuario SET contrasenia = :passwordModificado WHERE boleta = :boleta");
			$modificarPassword->execute(array(':passwordModificado' => $passwordModificado, ':boleta' => $boletaDeReferencia));
			$modificacionExitosa = 'Los datos han sido modificados con éxito.';
		}
	}
}
