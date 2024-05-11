var formulario = document.getElementById('formulario'),
	error_box = document.getElementById('error_box'),
	loader = document.getElementById('loader');

var boleta,
	password;

function datosValidos(boleta, password){
	if( isNaN(boleta) ){
		return false;
	}else if( password == '' ){
		return false;
	}
	return true;
}

function iniciarSesion(e){
	e.preventDefault();
	var peticion = new XMLHttpRequest();
	peticion.open('POST', 'login.php');
	boleta = parseInt(formulario.children.boleta.value.trim());
	password = formulario.children.password.value.trim();
	if(datosValidos(boleta, password)){
		var parametros = 'boleta=' + boleta + '&password=' + password;
		console.log(parametros);
		peticion.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		error_box.classList.add('hidden');
		loader.classList.remove('hidden');
		peticion.onload = function(){
			var respuesta = JSON.parse(peticion.responseText);
			if( peticion.readyState == 4 && peticion.status == 200 ){
				loader.classList.add('hidden');
				if( respuesta.exito ){
					location.href = respuesta.path;
				}
				if( respuesta.error ){
					formulario.password.value = '';
					error_box.classList.remove('hidden');
					error_box.innerHTML = 'Usuario y/o Contraseña incorrectos';
				}
			}
		}
		peticion.send(parametros);
	}else{
		error_box.classList.remove('hidden');
		error_box.innerHTML = 'Usuario y/o Contraseña incorrectos';
	}
}

formulario.addEventListener('click', iniciarSesion);