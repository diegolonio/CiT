<!DOCTYPE html>
<html lang="es">
<head>
	<?php require '../views/head.php'; ?>
	<title>CIT | Registro</title>
	<link rel="stylesheet" href="<?php echo RUTA; ?>/css/registro.css">
</head>
<body>

	<?php require '../views/toasts.php'; ?>

	<main>

		<!-- Inicio Ventana -->
		<div class="ventana animated fadeInDown">

			<?php require '../views/header.php'; ?>

			<section>

				<!-- Formulario Registro -->
				<form action="" class="registro" method="POST" id="formulario">

					<h2>Registro</h2>

					<!-- Input Boleta -->
					<input type="text" id="ingresoBoleta" name="ingresoBoleta" placeholder="Boleta" maxlength="10" autocomplete="off" class="num text">

					<!-- Input Correo -->
					<input type="email" id="ingresoCorreo" name="ingresoCorreo" placeholder="Correo" maxlength="60" autocomplete="off" class="text">

					<!-- Input confirmación de Correo -->
					<input type="email" id="confirmacionDeCorreo" name="confirmacionDeCorreo" placeholder="Confirma tu Correo" maxlength="60" autocomplete="off" class="text">

					<!-- Input Contraseña -->
					<input type="password" id="ingresoPassword" name="ingresoPassword" placeholder="Contraseña" maxlength="50" class="text">

					<!-- Input confirmación de Contraseña -->
					<input type="password" id="confirmacionDePassword" name="confirmacionDePassword" placeholder="Confirma tu Contraseña" maxlength="50" class="no_margin text">
					
					<!-- Mensaje error -->
					<div id="error_box" class="alert error hidden"><p id="mensajeError"></p></div>
					
					<!-- Mensaje éxito -->
					<div id="success_box" class="alert success hidden"><p id="mensajeExito"></p></div>
						
					<!-- Loader -->
					<div id="loader" class="alert loader hidden"><span class="fas fa-circle-notch fa-spin fa-3x"></span></div>

					<!-- Botón Registrarse -->
					<button type="submit" id="registrarseBtn" name="registrarseBtn">Registrarse</button>

				</form>
				<!-- Fin Formulario Registro -->

				<!-- Enlace pestaña Inicio de Sesión -->
				<p class="iniciarSesion">¿Ya tienes cuenta? <a href="../login/alumno/">Inicia sesión</a></p>

			</section>
			
		</div>
		<!-- Fin Ventana -->

	</main>
	<?php require '../views/javascript.php'; ?>
	<script src="../js/registro.js"></script>
</body>
</html>
