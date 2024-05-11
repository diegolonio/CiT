<!DOCTYPE html>
<html lang="es">
<head>
	<?php require '../../views/head.php'; ?>
	<title>CIT | Inicio de Sesión del Administrador</title>
	<link rel="stylesheet" href="<?php echo RUTA; ?>/css/login.admin.css">
</head>
<body>

	<?php require '../../views/toasts.php'; ?>

	<main>

		<!-- Inicio Ventana -->
		<div class="ventana animated fadeInDown">

			<?php require '../../views/header.php'; ?>

			<section>

				<h2>Inicio de Sesión <br> del Administrador</h2>

				<!-- Formulario Inicio de Sesión -->
				<form action="" method="POST" id="formulario">

					<!-- Input Código -->
					<input type="text" id="ingresoCodigo" name="codigo" placeholder="Empleado" maxlength="4" autocomplete="off" class="num text">

					<!-- Input Contraseña -->
					<input type="password" id="ingresoPassword" name="password" placeholder="Contraseña" maxlength="50" class="text">
					
					<!-- Alerta errores -->
					<div id="error_box" class="alert error hidden"></div>

					<!-- Loader -->
					<div id="loader" class="alert hidden"><span class="fas fa-circle-notch fa-spin fa-3x" style="color: #a22c29"></span></div>

					<!-- Botón pestaña Inicio de Sesión -->
					<button type="submit" id="ingresarAdminBtn" name="ingresar">Ingresar</button>

					<!-- Enlace contraseña olvidada -->
					<p class="forgottenPassword"><a href="#">¿Olvidaste tu contraseña?</a></p>

				</form>
				<!-- Fin Formulario Inicio de Sesión -->

			</section>

		</div>
		<!-- Fin Ventana -->

	</main>
	<?php require '../../views/javascript.php'; ?>
	<script src="<?php echo RUTA; ?>/js/admin.login.js"></script>
</body>
</html>
