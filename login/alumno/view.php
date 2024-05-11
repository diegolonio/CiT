<!DOCTYPE html>
<html lang="es">
<head>
	<?php require '../../views/head.php'; ?>
	<title>CIT | Inicio de Sesión</title>
	<link rel="stylesheet" href="<?php echo RUTA; ?>/css/login.alumno.css">
</head>
<body>

	<?php require '../../views/toasts.php'; ?>

	<main>

		<!-- Inicio Ventana -->
		<div class="ventana animated fadeInDown">

			<?php require '../../views/header.php'; ?>

			<section class="login">

				<h2>Inicio de Sesión</h2>

				<!-- Formulario Inicio Sesión -->
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" id="formulario">

					<!-- Input Boleta -->
					<input type="text" id="boleta" placeholder="Boleta" name="boleta" maxlength="10" autocomplete="off" class="num text">

					<!-- Input Contraseña -->
					<input type="password" id="password" placeholder="Contraseña" name="password" maxlength="50" class="text">

					<!-- Alerta errores -->
					<div class="alert error hidden" id="error_box"></div>

					<!-- Loader -->
					<div id="loader" class="alert hidden"><span class="fas fa-circle-notch fa-spin fa-3x" style="color: #a22c29"></span></div>

					<!-- Botón Iniciar Sesión -->
					<button type="submit" id="ingbtn" name="ing">Ingresar</button>
					
					<!-- Enlace contraseña olvidada -->
					<p class="forgottenPassword"><a href="#">¿Olvidaste tu contraseña?</a></p>

				</form>
				<!-- Fin Formulario Inicio de Sesión -->
				
				<!-- Enlace registrarse -->
				<p class="registrate">¿Aún no tienes cuenta? <a href="../../registro/">Regístrate</a></p>

			</section>

		</div>
		<!-- Fin Ventana -->

	</main>
	<?php require '../../views/javascript.php'; ?>
	<script src="<?php echo RUTA; ?>/js/alumno.login.js"></script>
</body>
</html>
