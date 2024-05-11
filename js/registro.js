var formulario = document.getElementById('formulario'),
	loader = document.getElementById('loader'),
	error_box = document.getElementById('error_box'),
	mensajeError = document.getElementById('mensajeError'),
	success_box = document.getElementById('success_box'),
	mensajeExito = document.getElementById('mensajeExito'),
	boton = document.getElementById('registrarseBtn');

var boleta,
	correo,
	confirmacionCorreo,
	password,
	confirmacionPassword;

function datosValidos(){
	if( isNaN(boleta) ){
		return false;
	}else if( correo == '' ){
		return false;
	}else if( confirmacionCorreo == '' ){
		return false;
	}else if( password == '' ){
		return false;
	}else if( confirmacionPassword == '' ){
		return false;
	}
	return true;
}

function registrar(e){
	e.preventDefault();
	var peticion = new XMLHttpRequest();
	peticion.open('POST', 'registro.php');
	boleta = parseInt(formulario.ingresoBoleta.value.trim());
	correo = formulario.ingresoCorreo.value.trim();
	confirmacionCorreo = formulario.confirmacionDeCorreo.value.trim();
	password = formulario.ingresoPassword.value.trim();
	confirmacionPassword = formulario.confirmacionDePassword.value.trim();
	if(datosValidos()){
		var parametros = 'ingresoBoleta=' + boleta + '&ingresoCorreo=' + correo + '&confirmacionDeCorreo=' + confirmacionCorreo + '&ingresoPassword=' + password + '&confirmacionDePassword=' + confirmacionPassword;
		peticion.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		error_box.classList.remove('show');
		success_box.classList.remove('show');
		loader.classList.add('show');
		peticion.onload = function(){
			var respuesta = JSON.parse(peticion.responseText);
			if(peticion.readyState == 4 && peticion.status == 200){
				loader.classList.remove('show');
				if(respuesta.exito){
					formulario.ingresoBoleta.value = '';
					formulario.ingresoCorreo.value = '';
					formulario.confirmacionDeCorreo.value = '';
					formulario.ingresoPassword.value = '';
					formulario.confirmacionDePassword.value = '';
					success_box.classList.add('show');
					mensajeExito.innerHTML = respuesta.mensaje;
				}
				if(respuesta.error){
					error_box.classList.add('show');
					formulario.ingresoPassword.value = '';
					formulario.confirmacionDePassword.value = '';
					mensajeError.innerHTML = respuesta.mensaje;
				}
			}
		}
		peticion.send(parametros);
	}else{
		error_box.classList.add('show');
		formulario.ingresoPassword.value = '';
		formulario.confirmacionDePassword.value = '';
		mensajeError.innerHTML = 'Por favor llena todos los campos.';
	}
}

formulario.addEventListener('submit', registrar);