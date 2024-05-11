<!DOCTYPE html>
<html lang="es">
<head>
	<link rel="stylesheet" href="<?php echo RUTA; ?>/css/bootstrap.css">
	<?php require '../../../views/head.php'; ?>
	<title>CIT | Panel del Alumno</title>
	<link rel="stylesheet" href="<?php echo RUTA; ?>/css/panel.alumno.css">
</head>
<body>

	<?php require '../../../views/toasts.php'; ?>

	<main>

		<!-- Inicio Ventana -->
		<div class="ventana">
			
			<?php require '../../../views/header.php'; ?>

			<?php require '../../../views/nav.php'; ?>

			<!-- Inicio Panel -->
			<section class="solicitar animated fadeIn">

				<h2>Solicitar Documento</h2>

				<!-- Recordatorio Solicitudes disponibles / Máximo solicitudes disponibles por periodo escolar -->
				<div class="recordatorio">
					<p id="disponibles"></p>
					<p>Solo puedes solicitar 10 documentos por periodo escolar.</p>
				</div>

				<!-- Inicio Tarjetas Documentos -->
				<div class="panel container-fluid" id="panel">

					<hr id="top" class="top">

					<!-- Mensaje Solicitud Exitosa -->
					<div class="alert success hidden" id="success_box"></div>

					<!-- Mensaje Sin Solicitudes Disponibles -->
					<div class="alert error hidden" id="error_box"></div>

					<!-- Loader -->
					<div id="loader" class="loader alert hidden"><span class="fas fa-circle-notch fa-spin fa-3x"></span></div>

				</div>
				<!-- Fin Tarjetas Documentos -->

			</section>
			<!-- Fin Panel -->

		</div>
		<!-- Fin Ventana -->

	</main>
	<?php require '../../../views/javascript.php'; ?>
	<script src="<?php echo RUTA; ?>/js/alumno.solicitar.js"></script>
	<script src="<?php echo RUTA; ?>/js/alumno.cerrarsesion.js"></script>
</body>
</html>