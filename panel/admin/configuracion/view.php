<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="icon" href="../../../img/favicon.ico" type="image/x-icon">
	<title>CIT | Panel del Administrador</title>
	<link rel="stylesheet" href="../../../css/all.min.css">
	<link rel="stylesheet" href="../../../css/animate.css">
	<link rel="stylesheet" href="../../../css/generales.css">
	<link rel="stylesheet" href="../../../css/panel.admin.css">
</head>
<body>
	<div class="toastContainer animated hidden" id="toastContainer">
		<div class="toast hidden" id="toastnum">
			<header><span class="fas fa-times" onclick="cerrarVentanas()"></span></header>
			<section><p>Solo puedes ingresar números</p></section>
		</div>
		<div class="toast hidden" id="toastchar">
			<header><span class="fas fa-times" onclick="cerrarVentanas()"></span></header>
			<section><p>Solo puedes ingresar letras</p></section>
		</div>
	</div>
	<main>
		<div class="ventana">
			<header><h1>CONTROL INTELIGENTE DE TRÁMITES</h1></header>
			<nav class="mainmenu">
				<ul>
					<a href="../resumen/"><li id="resumenbtn"><p>Datos</p></li></a>
					<a href="../solicitudes/"><li id="solicitudesbtn"><p>Solicitudes</p></li></a>
					<a href="../historial/"><li id="historialbtn"><p>Historial</p></li></a>
					<a href="../administradores/"><li id="administradoresbtn"><p>Administradores</p></li></a>
					<a href="../registro/"><li id="registrarbtn"><p>Registro</p></li></a>
					<a href="../configuracion/"><li id="configbtn"><p>Configuración</p></li></a>
				</ul>
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="formcerrar">
					<button type="submit" name="cerrar" class="cerrar">Cerrar Sesión</button>
				</form>
			</nav>
			<section class="configuracion animated fadeIn" id="deskconfig">
				<h2>Configuración</h2>
				<div class="panel">

					<section class="aniadirAlumno">
						<h3>Cargar datos de los Alumnos</h3>
						<form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="formAniadirAlumno" method="POST">
							<div class="cargarArchivoDatosAlumno">
								<input type="file" accept=".csv" name="csv" class="buscarArchivoBtn">
							</div>
							<div class="datosRegistrarAlumnoConfig">
								<button type="submit" id="subirArchivo" class="subirArchivoBtn">Cargar</button>
							</div>
							<?php if (!empty($errores)): ?>
								<div class="alert error">
									<?php echo $errores; ?>
								</div>
							<?php endif ?>
							<?php if (!empty($exito)): ?>
								<div class="alert success">
									<?php echo $exito; ?>
								</div>
							<?php endif ?>
						</form>
					</section>

					<section class="consultaAlumnoConfig">
						<h3>Consulta de datos del alumno</h3>
						<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="formConsultarAlumno" method="POST">
							<div class="busquedaAlumno">
								<input type="text" name="boletaBusquedaConfig" id="boletaBusquedaConfig" maxlength="10" placeholder="Boleta" onkeypress="return validacionNumeros(event)" onpaste="return noCopy(event)" autocomplete="off">
								<button type="submit" name="consultarAlumnoBtn">Buscar</button>
							</div>
							<?php if (!empty($erroresConsultaAlumno)): ?>
								<div class="alert error">
									<?php echo $erroresConsultaAlumno; ?>
								</div>
							<?php endif ?>
						</form>
						<div class="ventanaConsulta">
							<div class="encabezadosConsultaDatosAlumno">
								<p>Boleta</p><p>Nombre</p><p>Grupo</p>
							</div>
							<div class="consultaDatosAlumno">
								<div class="tablaDatosAlumno">
								<?php if (isset($alumno)): ?>
									<p><?php echo $alumno->boleta; ?></p>
									<p><?php echo $alumno->nombre; ?></p>
									<p><?php echo $alumno->grupo; ?></p>
								<?php else: ?>
									No se ha hecho una busqueda aún
								<?php endif ?>
								</div>
							</div>
						</div>
					</section>

					<section class="modificarDatosAlumnoConfig" id="modificarDatosAlumnoConfig">
						<h3>Modificar datos del usuario</h3>
						<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="datosModificables" method="POST">
							<div class="buscadorAlumnoModificable">
								<input type="text" name="boletaBuscadaModificable" id="boletaBuscadaModificable" maxlength="10" placeholder="Boleta" onkeypress="return validacionNumeros(event)"  onpaste="return noCopy(event)" autocomplete="off" value="<?php if(isset($boletaBuscadaModificable)) echo $boletaBuscadaModificable; ?>" <?php if(isset($boletaBuscadaModificable) && empty($erroresConsultaDatosAlumno)) echo 'disabled'; ?>>
								<button type="submit" name="buscarBoletaModificada" class="buscarAlumnoBtn">Buscar</button>
							</div>
							<?php if (!empty($erroresConsultaDatosAlumno)): ?>
								<div class="alert error">
									<?php echo $erroresConsultaDatosAlumno; ?>
								</div>
							<?php endif ?>
							<fieldset class="datosAcademicosModificables">
								<legend>Datos academicos</legend>
								<div class="contenedorDatosAcademicos">
									<div class="inputsDatosAcademicos">
										<input type="text" name="boletaModificable" id="boletaModificable" maxlength="10" placeholder="Boleta" onkeypress="return validacionNumeros(event)" onpaste="return noCopy(event)" autocomplete="off" value="<?php if(isset($boletaModificable)) echo $boletaModificable; ?>" disabled>
										<select name="grupoAlumnoConfig" id="grupoModificable" disabled>
											<option value="0">GRUPO</option>
											<?php if (isset($grupoModificable) && $grupoModificable == '1IM1'): ?>
												<option value="1IM1" selected>1IM1</option>
											<?php else: ?>
												<option value="1IM1">1IM1</option>
											<?php endif ?>
											<?php if (isset($grupoModificable) && $grupoModificable == '1IM2'): ?>
												<option value="1IM2" selected>1IM2</option>
											<?php else: ?>
												<option value="1IM2">1IM2</option>
											<?php endif ?>
											<?php if (isset($grupoModificable) && $grupoModificable == '1IM3'): ?>
												<option value="1IM3" selected>1IM3</option>
											<?php else: ?>
												<option value="1IM3">1IM3</option>
											<?php endif ?>
											<?php if (isset($grupoModificable) && $grupoModificable == '3IM1'): ?>
												<option value="3IM1" selected>3IM1</option>
											<?php else: ?>
												<option value="3IM1">3IM1</option>
											<?php endif ?>
											<?php if (isset($grupoModificable) && $grupoModificable == '3IM2'): ?>
												<option value="3IM2" selected>3IM2</option>
											<?php else: ?>
												<option value="3IM2">3IM2</option>
											<?php endif ?>
											<?php if (isset($grupoModificable) && $grupoModificable == '3IM3'): ?>
												<option value="3IM3" selected>3IM3</option>
											<?php else: ?>
												<option value="3IM3">3IM3</option>
											<?php endif ?>
											<?php if (isset($grupoModificable) && $grupoModificable == '5IM1'): ?>
												<option value="5IM1" selected>5IM1</option>
											<?php else: ?>
												<option value="5IM1">5IM1</option>
											<?php endif ?>
											<?php if (isset($grupoModificable) && $grupoModificable == '5IM3'): ?>
												<option value="5IM3" selected>5IM3</option>
											<?php else: ?>
												<option value="5IM3">5IM3</option>
											<?php endif ?>
										</select>
										<select name="semestreAlumnoConfig" id="semestreModificable" disabled>
											<option value="0">SEMESTRE</option>
											<?php if (isset($semestreModificable) && $semestreModificable == '1'): ?>
												<option value="1" selected>1° Semestre</option>
											<?php else: ?>
												<option value="1">1° Semestre</option>
											<?php endif ?>
											<?php if (isset($semestreModificable) && $semestreModificable == '2'): ?>
												<option value="2" selected>2° Semestre</option>
											<?php else: ?>
												<option value="2">2° Semestre</option>
											<?php endif ?>
											<?php if (isset($semestreModificable) && $semestreModificable == '3'): ?>
												<option value="3" selected>3° Semestre</option>
											<?php else: ?>
												<option value="3">3° Semestre</option>
											<?php endif ?>
											<?php if (isset($semestreModificable) && $semestreModificable == '4'): ?>
												<option value="4" selected>4° Semestre</option>
											<?php else: ?>
												<option value="4">4° Semestre</option>
											<?php endif ?>
											<?php if (isset($semestreModificable) && $semestreModificable == '5'): ?>
												<option value="5" selected>5° Semestre</option>
											<?php else: ?>
												<option value="5">5° Semestre</option>
											<?php endif ?>
											<?php if (isset($semestreModificable) && $semestreModificable == '6'): ?>
												<option value="6" selected>6° Semestre</option>
											<?php else: ?>
												<option value="6">6° Semestre</option>
											<?php endif ?>
										</select>
									</div>
									<div class="editarBtn" id="datosAcademicosBtn">
										<i class="fas fa-pen"></i>
									</div>
								</div>
							</fieldset>
							<fieldset class="datosPersonalesModificables">
								<legend>Datos personales</legend>
								<div class="contenedorDatosPersonales">
									<div class="inputsNombre">
										<input type="text" name="nombreModificable" id="nombreModificable" maxlength="30" placeholder="Nombre(s)" onkeypress="return validacionLetras(event)" onpaste="return noCopy(event)" autocomplete="off" value="<?php if(isset($nombreModificable)) echo $nombreModificable; ?>" disabled>
										<input type="text" name="apePatModificable" id="apePatModificable" maxlength="15" placeholder="Apellido Paterno" onkeypress="return validacionLetras(event)" onpaste="return noCopy(event)" autocomplete="off" value="<?php if(isset($apePatModificable)) echo $apePatModificable; ?>" disabled>
										<input type="text" name="apeMatModificable" id="apeMatModificable" maxlength="15" placeholder="Apellido Materno" onkeypress="return validacionLetras(event)" onpaste="return noCopy(event)" autocomplete="off" value="<?php if(isset($apeMatModificable)) echo $apeMatModificable; ?>" disabled>
									</div>
									<div class="editarBtn" id="datosPersonalesBtn">
										<i class="fas fa-pen"></i>
									</div>
								</div>
							</fieldset>
							<fieldset class="datosUsuarioModificables">
								<legend>Datos de usuario</legend>
								<div class="contenedorDatosUsuario">
									<div class="inputsUsuario">
										<input type="password" name="passwordModificable" id="passwordModificable" maxlength="50" placeholder="Contraseña" onpaste="return noCopy(event)" autocomplete="off" value="<?php if(isset($contraseniaModificable)) echo $contraseniaModificable; ?>" disabled>
									</div>
									<div class="editarBtn" id="datosUsuarioBtn">
										<i class="fas fa-pen"></i>
									</div>
								</div>
							</fieldset>
							<?php if (!empty($modificacionErrores)): ?>
								<div class="alert error">
									<?php echo $modificacionErrores; ?>
								</div>
							<?php endif ?>
							<?php if (!empty($modificacionExitosa)): ?>
								<div class="alert success">
									<?php echo $modificacionExitosa; ?>
								</div>
							<?php endif ?>
							<div class="modificarDatosAlumnoBtn">
								<button type="submit" name="modificarBtn" id="modificarBtn" class="modificarBtn">Guardar</button>
							</div>
						</form>
					</section>
				</div>	
			</section>
		</div>
	</main>
	<script src="../../../js/noCopy.js"></script>
	<script src="../../../js/panel.admin.js"></script>
	<script src="../../../js/validacionesCaracteres.js"></script>
</body>
</html>
