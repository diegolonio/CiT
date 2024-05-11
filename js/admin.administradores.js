var panel = document.getElementById('panel'),
	descartar_btn = document.getElementById('descartar');

function cargar_administradores(){
	var peticion_datos_admins = new XMLHttpRequest();
	peticion_datos_admins.open('POST', 'administradores.php');
	peticion_datos_admins.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	peticion_datos_admins.onreadystatechange = function(){
		if( peticion_datos_admins.readyState == 4 && peticion_datos_admins.status == 200 ){
			var datos = JSON.parse(peticion_datos_admins.responseText);
			if( !datos.error ){
				while(panel.firstChild) panel.removeChild(panel.firstChild);
				for( var tupla = 0; tupla < datos.administradores.length; tupla++ ){
					crear_tarjeta_admin(
						datos.administradores[tupla].codigo,
						datos.administradores[tupla].nombre,
						datos.administradores[tupla].estado,
						datos.id
					);
				}
			}
		}
	}
	peticion_datos_admins.send();
}

function crear_tarjeta_admin(codigo, nombre, estado, id){
	// Tarjeta del administrador
	var tarjeta_admin = document.createElement('div');
	tarjeta_admin.classList.add('administrador');
	// Nombre del administrador
	var nombre_admin = document.createElement('p');
	nombre_admin.innerHTML = '<b>Nombre: </b>' + nombre;
	tarjeta_admin.appendChild(nombre_admin);
	// Codigo del administrador
	var codigo_admin = document.createElement('p');
	codigo_admin.innerHTML = '<b>Codigo: </b>' + codigo;
	tarjeta_admin.appendChild(codigo_admin);
	// Estado del administrador
	var boton = document.createElement('button');
	boton.value = codigo;
	if( estado == 1 ){
		boton.id = 'baja';
		boton.classList.add('baja_btn');
		boton.textContent = 'Dar de baja';
		if( codigo == id ){
			boton.setAttribute('disabled', true);
			boton.classList.add('not_allowed');
		}
	}else if( estado == 0 ){
		boton.id = 'alta';
		boton.classList.add('alta_btn');
		boton.textContent = 'Dar de alta';
	}
	boton.addEventListener('click', function (){ cambiar_estado(this.id, this.value); });
	tarjeta_admin.appendChild(boton);
	panel.appendChild(tarjeta_admin);
}

function cambiar_estado(accion, codigo){
	var formulario = document.getElementById('formulario'),
		alert_password = document.getElementById('alert_password');
	toastContainer.classList.remove('hidden');
	toast.classList.remove('hidden');
	formulario.addEventListener('submit', function(e){
		e.preventDefault();
		var password = formulario.password.value.trim();
		if( password != '' ){
			var verificacion_password = new XMLHttpRequest();
			verificacion_password.open('POST', 'password.php');
			verificacion_password.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			var password = 'password=' + password;
			verificacion_password.onreadystatechange = function(){
				if( verificacion_password.readyState == 4 && verificacion_password.status == 200 ){
					var respuesta = JSON.parse(verificacion_password.responseText);
					if( respuesta.exito ){
						var peticion_cambiar_estado = new XMLHttpRequest();
						peticion_cambiar_estado.open('POST', 'estado.php');
						if( accion == 'alta' ){
							var parametro = 'alta=' + codigo;
						}else if( accion == 'baja' ){
							var parametro = 'baja=' + codigo;
						}
						peticion_cambiar_estado.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
						peticion_cambiar_estado.onreadystatechange = function(){
							if( peticion_cambiar_estado.readyState == 4 && peticion_cambiar_estado.status == 200 ){
								var respuesta = JSON.parse(peticion_cambiar_estado.responseText);
								if( respuesta.exito ){
									cerrarVentanas();
									formulario.password.value = '';
									setTimeout(cargar_administradores, 1000);
								}
							}
						}
						peticion_cambiar_estado.send(parametro);
					}else if( respuesta.error ){
						alert_password.textContent = 'Contraseña incorrecta';
						alert_password.classList.remove('hidden');
						setTimeout(cerrarAlerts, 5000);
					}
				}
			}
			verificacion_password.send(password);
		}else{
			alert_password.textContent = 'Contraseña incorrecta';
			alert_password.classList.remove('hidden');
			setTimeout(cerrarAlerts, 5000);
		}
	});	
}

function cerrarVentanas(){
	var toasts = document.getElementsByClassName('toast');
	for(var no_toast = 0; no_toast < toasts.length; no_toast++){
		toasts[no_toast].classList.add('hidden');
	}
	toastContainer.classList.add('hidden');
}

function cerrarAlerts(){
	var alerts = document.getElementsByClassName('alert');
	for( var i = 0; i < alerts.length; i++ ){
		alerts[i].classList.add('hidden');
	}
}

descartar_btn.addEventListener('click', cerrarVentanas);

window.addEventListener('load', cargar_administradores);
