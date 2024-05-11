<!DOCTYPE html>
<html lang="es">
<head>
	<?php require '../../../views/head.php'; ?>
	<title>CIT | Panel del Administrador</title>
	<link rel="stylesheet" href="<?php echo RUTA; ?>/css/panel.admin.css">
</head>
<body>
	<main>

		<!-- Inicio Ventana -->
		<div class="ventana">

			<?php require '../../../views/header.php'; ?>

			<?php require '../../../views/admin.nav.php'; ?>
			
			<!-- Datos Administrador -->
			<section class="resumen animated fadeIn">

				<h2>Datos</h2>
				
				<div class="img"><img src="<?php echo RUTA; ?>/img/user.png" alt="User Profile Image"></div>
				<p class="nombre" id="nombreDeEmpleado"></p>
				<p class="codigoDeEmpleado" id="codigoDeEmpleado"></p>

			</section>
			
		</div>
		<!-- Fin Ventana -->

	</main>
	<script src="../../../js/admin.resumen.js"></script>
	<script src="../../../js/admin.cerrarsesion.js"></script>
</body>
</html>
