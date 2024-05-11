<!DOCTYPE html>
<html lang="en">
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
			<section class="solicitudes animated fadeIn">

				<h2>Solicitudes de Documentos</h2>

				<!-- Inicio Filtro registros -->
				<div class="filtros_registros">
					
					<p>Filtrar por:</p>

					<!-- Formulario filtros -->
					<form action="" method="POST" id="formulario_filtros" class="formulario_filtros">

						<!-- Filtro Documento -->
						<div class="filtro_item filtro_documento">
							<select name="docs" id="filtroDocumentos">
								<option value="" selected>--Documento--</option>
								<option value="1001">Constancia de Inscripción</option>
								<option value="1002">Constancia para Trámite de Servicio Social</option>
								<option value="1003">Constancia de Estudios</option>
								<option value="1004">Constancia de Periodo Vacacional</option>
								<option value="1005">Constancia para Trámite de Prácticas Profesionales</option>
								<option value="1006">Boleta de Calificaciones Informativa</option>
								<option value="1007">Boleta Departamental</option>
								<option value="1008">Boleta Global de Calificaciones Certificada</option>
							</select>
						</div>
						
						<!-- Filtro Boleta -->
						<div class="filtro_item filtro_boleta">
							<input type="text" name="boleta" id="boleta" class="num text" maxlength="10" placeholder="Boleta">
						</div>

						<!-- Filtro Número Solicitud -->
						<div class="filtro_item filtro_noSolicitud">
							<input type="text" name="no" id="noSolicitud" class="num text" maxlength="3" placeholder="Folio">
						</div>

						<!-- Filtro Fecha -->
						<div class="filtro_item filtro_fecha">
							<input type="date" name="date" id="filtroFecha" title="Fecha">
						</div>

					</form>
					<!-- Fin formulario filtros -->

				</div>
				<!-- Fin Filtros registros -->

				<!-- Inicio Solicitudes pendientes -->
				<div class="panel" id="panel">

				</div>
				<!-- Fin Solicitudes pendientes -->

			</section>
			<!-- Fin Panel -->

		</div>
		<!-- Fin Ventana -->

	</main>
	<?php require '../../../views/javascript.php'; ?>
	<script src="../../../js/admin.cerrarsesion.js"></script>
	<script src="../../../js/admin.solicitudes.js"></script>
</body>
</html>
