<!DOCTYPE html>
<html lang="es">
<head>
	<?php require '../../../views/head.php'; ?>
	<title>CIT | Panel del Administrador</title>
	<link rel="stylesheet" href="<?php echo RUTA; ?>/css/panel.admin.css">
</head>
<body>
	
	<?php require '../../../views/toasts.php'; ?>

	<main>

		<!-- Inicio Ventana -->
		<div class="ventana">
			
			<?php require '../../../views/header.php'; ?>

			<?php require '../../../views/admin.nav.php'; ?>
			
			<!-- Inicio Panel -->
			<section class="administradores animated fadeIn">

				<h2>Administradores</h2>

				<!-- Inicio registros administradores -->
				<div class="panel" id="panel">
					
				</div>
				<!-- Fin registros administradores -->

			</section>
			<!-- Fin Panel -->

		</div>
		<!-- Fin Ventana -->

	</main>
	<script src="../../../js/admin.administradores.js"></script>
	<script src="../../../js/admin.cerrarsesion.js"></script>
</body>
</html>
