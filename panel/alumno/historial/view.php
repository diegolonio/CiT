<!DOCTYPE html>
<html lang="es">
<head>
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
			<section class="historial animated fadeIn">
				
				<h2>Historial de Solicitudes</h2>

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

						<!-- Filtro Número Solicitud -->
						<div class="filtro_item filtro_noSolicitud">
							<input type="text" name="no" id="noSolicitud" maxlength="3" placeholder="Folio" autocomplete="off" class="num text">
						</div>

						<!-- Filtro Fecha -->
						<div class="filtro_item filtro_fecha">
							<input type="date" name="date" id="filtroFecha" title="Fecha">
						</div>

						<!-- Filtro Autorización -->
						<div class="filtro_item filtro_autorizacion">
							<select name="filtro_estado" id="filtroEstado">
								<option value="" selected>--Autorización--</option>
								<option value="1">En espera</option>
								<option value="2">Autorizado</option>
								<option value="3">Cancelado</option>
							</select>
						</div>

					</form>
					<!-- Fin formulario filtros -->

				</div>
				<!-- Fin Filtros registros -->

				<div class="encabezados">
					<p>Documento</p>
					<p>Folio</p>
					<p>Fecha de Solicitud</p>
					<p>Autorización</p>
				</div>

				<!-- Registros -->
				<div class="panel" id="panel">
					
				</div>
				<!-- Fin registros -->

			</section>
			<!-- Fin Panel -->

		</div>
		<!-- Fin Ventana -->

	</main>
	<?php require '../../../views/javascript.php'; ?>
	<script src="<?php echo RUTA; ?>/js/alumno.historial.js"></script>
	<script src="<?php echo RUTA; ?>/js/alumno.cerrarsesion.js"></script>
</body>
</html>
