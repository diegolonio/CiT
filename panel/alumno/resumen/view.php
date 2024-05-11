<!DOCTYPE html>
<html lang="es">
<head>
	<?php require '../../../views/head.php'; ?>
	<title>CIT | Panel del Alumno</title>
	<link rel="stylesheet" href="<?php echo RUTA; ?>/css/panel.alumno.css">
</head>
<body>
	<main>

		<!-- Inicio Ventana -->
		<div class="ventana">

			<?php require '../../../views/header.php'; ?>

			<?php require '../../../views/nav.php'; ?>
			
			<!-- Inicio Panel -->
			<section class="resumen animated fadeIn">

				<h2>Datos</h2>

				<!-- Imágen Usuario -->
				<div class="img"><img src="<?php echo RUTA; ?>/img/user.png" alt="Foto de Usuario"></div>

				<!-- Datos Alumno -->
				<p id="nombre" class="nombre"></p>
				<p id="boleta" class="boleta"></p>
				<p id="grupo" class="grupo"></p>
				<p id="semestre" class="turno"></p>
				
			</section>
			<!-- Fin Panel -->

		</div>
		<!-- Fin Ventana -->

	</main>
	<script src="<?php echo RUTA; ?>/js/alumno.resumen.js"></script>
	<script src="<?php echo RUTA; ?>/js/alumno.cerrarsesion.js"></script>
</body>
</html>
