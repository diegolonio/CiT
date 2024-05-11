var formulario = document.getElementById('formulario'),
	success = document.getElementById('success'),
	error = document.getElementById('error'),
	loader = document.getElementById('loader');

var codigo, correo, confirmacion_correo, password, confirmacion_password;

function ocultar_alerts(){
	var alerts = document.getElementsByClassName('alert');
	for( var i = 0; i < alerts.length; i++ ){
		alerts[i].classList.add('hidden');
	}
}

function registrar_admin(parametros){
	var peticion = new XMLHttpRequest();
	peticion.open('POST', 'registro.php');
	peticion.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	loader.classList.remove('hidden');
	peticion.onload = function(){
		var respuesta = JSON.parse(peticion.responseText);
		if( !respuesta.error ){
			success.innerHTML = respuesta.mensaje;
			success.classList.remove('hidden');
			formulario.codigo.value = '';
			formulario.correo.value = '';
			formulario.confirmacion_correo.value = '';
			formulario.password.value = '';
			formulario.confirmacion_password.value = '';
		}else{
			formulario.password.value = '';
			formulario.confirmacion_password.value = '';
			error.innerHTML = respuesta.mensaje;
			error.classList.remove('hidden');
		}
		setTimeout(ocultar_alerts, 5000);
	}
	peticion.onreadystatechange = function(){
		if( peticion.readyState == 4 && peticion.status == 200 ){
			loader.classList.add('hidden');
		}
	}
	peticion.send(parametros);
}

function peticion(e){
	e.preventDefault();
	codigo = formulario.codigo.value.trim();
	correo = formulario.correo.value.trim();
	confirmacion_correo = formulario.confirmacion_correo.value.trim();
	password = formulario.password.value.trim();
	confirmacion_password = formulario.confirmacion_password.value.trim();
	if( datos_correctos() ){
		var parametros = 'codigo=' + codigo + '&correo=' + correo + '&confirmacion_correo=' + confirmacion_correo + '&password=' + password + '&confirmacion_password=' + confirmacion_password;
		registrar_admin(parametros);
	}else{
		error.classList.remove('hidden');
		error.textContent = 'Debes rellenar el formulario correctamente';
		setTimeout(ocultar_alerts, 5000);
	}
}

function datos_correctos(){
	if( codigo ==  '' || isNaN(parseInt(codigo)) ){
		return false;
	}else if( correo == '' ){
		return false;
	}else if( confirmacion_correo == '' ){
		return false
	}else if( password == '' ){
		return false;
	}else if( confirmacion_password == '' ){
		return false;
	}
	return true;
}

formulario.addEventListener('submit', peticion);