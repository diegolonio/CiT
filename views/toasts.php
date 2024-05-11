<!-- Inicio toasts -->
<div class="toastContainer animated hidden" id="toastContainer">

	<!-- Toast números -->
	<div class="toast hidden" id="toastnum">
		<header><span class="fas fa-times" onclick="cerrarVentanas()"></span></header>
		<section><p>Solo puedes ingresar números</p></section>
	</div>

	<!-- Toast letras -->
	<div class="toast hidden" id="toastchar">
		<header><span class="fas fa-times" onclick="cerrarVentanas()"></span></header>
		<section><p>Solo puedes ingresar letras</p></section>
	</div>

	<!-- Toast motivo solicitud -->
		<div class="toast motivo hidden" id="toastMotivo">
			<header><span class="fas fa-times" onclick="cerrarVentanas()"></span></header>
			<section>
				<textarea name="motivo" id="motivo" maxlength="100" placeholder="Motivo del documento" class="text"></textarea>
				<div class="alert error hidden" id="motivo_error"></div>
				<button id="solicitar_btn" class="solicitar_btn">Enviar</button>
				<button id="cancelar_btn" class="cancelar_btn" onclick="cerrarVentanas()">Cancelar</button>
				<p>Al presionar el botón 'Enviar' la solicitud será enviada.</p>
			</section>
		</div>

		<!-- Toast archivo inexistente -->
		<div class="toast hidden" id="toast404">
			<header><span class="fas fa-times" onclick="cerrarVentanas()"></span></header>
			<section><p>El archivo no existe</p></section>
		</div>

		<!-- Toast cancelar solicitud -->
		<div class="toast cancelar hidden" id="toastCancelar">
			<header><span class="fas fa-times" onclick="cerrarVentanas()"></span></header>
			<section>
				<p class="mensaje_rectificar" id="mensaje_rectificar"></p>
				<button class="cancelar_aceptar" id="cancelar_aceptar">Aceptar</button>
				<button class="cancelar_descartar" id="cancelar_descartar">Descartar</button>
			</section>
		</div>

		<!-- Toast confirmar alta/baja -->
		<div class="toast cancelar hidden" id="toast">
			<header><span class="fas fa-times" onclick="cerrarVentanas()"></span></header>
			<section>
				<p>Ingresa tu contraseña para continuar:</p>
				<form action="" method="POST" id="formulario">
					<input type="password" id="password" placeholder="Contraseña" style="width: 100%; margin-top: 10px; padding: 10px; border: 1px solid #a22c29; font-family: 'Raleway', sans-serif; font-size: 16px;">
					<div class="alert error hidden" id="alert_password" style="margin-top: 10px;"></div>
					<button type="submit" class="cancelar_aceptar">Aceptar</button>
				</form>
				<button class="cancelar_descartar" id="descartar">Descartar</button>
			</section>
		</div>

</div>
<!-- Fin toasts -->
