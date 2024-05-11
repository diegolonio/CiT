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
			
			<!-- Registro Administrador -->
			<section class="registrar animated fadeIn">

				<h2>Registro de Administradores</h2>

				<!-- Inicio Panel -->
				<div class="panel">

					<!-- Formulario Registro Administrador -->
					<form action="" class="regadmin" id="formulario" method="POST">

						<!-- Input Código Empleado  -->
						<input type="text" name="noEmpleado" class="text num" id="codigo" maxlength="4 " placeholder="Empleado" autocomplete="off">

						<!-- Input Email -->
						<input type="email" name="correoIngresado" class="text" id="correo" placeholder="Correo" autocomplete="off">

						<!-- Input confirmación Email -->
						<input type="email" name="confirmacionDelCorreoIngresado" class="text" id="confirmacion_correo" placeholder="Confirma tu correo" autocomplete="off">

						<!-- Input Contraseña -->
						<input type="password" name="passwordIngresado" class="text" id="password" placeholder="Contraseña">

						<!-- Input confirmación Contraseña -->
						<input type="password" name="confirmacionDelPasswordIngresado" class="text" id="confirmacion_password" placeholder="Confirma tu contraseña">
						
						<!-- Alerta error -->
						<div class="alert error hidden" id="error"></div>
						
						<!-- Alerta éxito -->
						<div class="alert success hidden" id="success"></div>

						<div id="loader" class="alert loader hidden"><span class="fas fa-circle-notch fa-spin fa-3x"></span></div>
						
						<!-- Botón Registrar Administrador -->
						<div class="box_btn">
							<button type="submit" name="registrarAdministrador" class="registrarAdministradorBtn" id="registrar_btn">Registrar Administrador</button>
						</div>

					</form>

				</div>
				<!-- Fin Panel -->

			</section>
			

		</div>
		<!-- Fin Ventana -->

	</main>
	<?php require '../../../views/javascript.php'; ?>
	<script src="../../../js/admin.registro.js"></script>
	<script src="../../../js/admin.cerrarsesion.js"></script>
</body>
</html>
