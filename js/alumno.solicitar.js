var panel = document.getElementById('panel'),
	disponibles = document.getElementById('disponibles'),
	error_box = document.getElementById('error_box'),
	success_box = document.getElementById('success_box'),
	loader = document.getElementById('loader'),
	toastMotivo = document.getElementById('toastMotivo'),
	motivo = document.getElementById('motivo');

function cerrarVentanas(){
	var toasts = document.getElementsByClassName('toast');
	for(var no_toast = 0; no_toast < toasts.length; no_toast++){
		toasts[no_toast].classList.remove('show');
		toasts[no_toast].classList.add('hidden');
	}
	toastContainer.classList.remove('show');
	toastContainer.classList.add('hidden');
}

function cargar_documentos(){
	var peticion_documentos = new XMLHttpRequest();
	peticion_documentos.open('POST', 'documentos.php');
	peticion_documentos.onload = function(){
		var respuesta_documentos = JSON.parse(peticion_documentos.responseText);
		var fila, tupla;
		for( fila = 1; fila <= 3; fila++ ){
			var row = document.createElement('div');
			row.classList.add('row');
			for( tupla = (fila*3) - 3; tupla < fila*3; tupla++ ){
				if(respuesta_documentos[tupla] !== undefined){
					var col = document.createElement('div');
					col.classList.add('col-3', 'border', 'rounded', 'm-2', 'mx-auto', 'tarjetaDocumento');
					var descripcionDocumento = document.createElement('div');
					descripcionDocumento.classList.add('descripcionDocumento');
					var nombre_documento = document.createElement('h6');
					var descripcion_documento = document.createElement('p');
					var espera_documento = document.createElement('p');
					nombre_documento.innerHTML = respuesta_documentos[tupla].nombre;
					descripcion_documento.innerHTML = respuesta_documentos[tupla].descripcion;
					espera_documento.innerHTML = 'Tiempo de espera:<br>' + respuesta_documentos[tupla].espera;
					descripcionDocumento.appendChild(nombre_documento);
					descripcionDocumento.appendChild(descripcion_documento);
					descripcionDocumento.appendChild(espera_documento);
					var formulario_documento = document.createElement('form');
					formulario_documento.setAttribute('action', '');
					formulario_documento.setAttribute('method', 'POST');
					var boton_formulario = document.createElement('button');
					boton_formulario.setAttribute('name', 'codDoc');
					boton_formulario.setAttribute('value', respuesta_documentos[tupla].codigo);
					boton_formulario.classList.add('btn', 'btn-outline-danger', 'btn-block');
					boton_formulario.innerHTML = 'Solicitar';
					boton_formulario.addEventListener('click', ingresar_motivo);
					formulario_documento.appendChild(boton_formulario);
					// formulario_documento.addEventListener('submit', solicitar_documento);
					col.appendChild(descripcionDocumento);
					col.appendChild(formulario_documento);
					row.appendChild(col);
				}
			}
			panel.appendChild(row);
		}
	}
	peticion_documentos.send();
}

function cargar_solicitudes_disponibles(){
	var peticion_disponibles = new XMLHttpRequest();
	peticion_disponibles.open('POST', 'disponibles.php');
	peticion_disponibles.onload = function(){
		var respuesta_disponibles = JSON.parse(peticion_disponibles.responseText);
		disponibles.innerHTML = 'Solicitudes disponibles: ' + respuesta_disponibles.solicitudesDisponibles;
	}
	peticion_disponibles.send();
}

function solicitar_documento(codDoc, motivo){
	var peticion_solicitud = new XMLHttpRequest();
	peticion_solicitud.open('POST', 'solicitar.php');
	var motivo_solicitud = motivo;
	codigo_doc = codDoc;
	var parametros = 'codDoc=' + codigo_doc + '&motivo=' + motivo;
	peticion_solicitud.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	ocultar_alerts();
	loader.classList.remove('hidden');
	window.location = '#top';
	peticion_solicitud.onload = function(){
		var respuesta_solicitud = JSON.parse(peticion_solicitud.responseText);
		loader.classList.add('hidden');
		cargar_solicitudes_disponibles();
		if(respuesta_solicitud.exito){
			success_box.innerHTML = respuesta_solicitud.mensaje;
			success_box.classList.remove('hidden');
		}
		if(respuesta_solicitud.error){
			error_box.innerHTML = respuesta_solicitud.mensaje;
			error_box.classList.remove('hidden');
		}
		var timer = setTimeout(ocultar_alerts, 7000);
		clearTimeout(ocultar_alerts);
	}
	peticion_solicitud.send(parametros);
}

function ocultar_alerts(){
	var alerts = document.getElementsByClassName('alert');
	for( var alert = 0; alert < alerts.length; alert++ ){
		alerts[alert].classList.remove('show');
		alerts[alert].classList.add('hidden');
	}
}

function ingresar_motivo(e){
	e.preventDefault();
	toastContainer.classList.remove('hidden');
	toastContainer.classList.add('show', 'fadeIn', 'faster');
	toastMotivo.classList.remove('hidden');
	toastMotivo.classList.add('show');
	solicitar_btn.value = this.value;
	solicitar_btn.addEventListener('click', function(){
		if(motivo.value.trim() != ''){
			cerrarVentanas();
			solicitar_documento(parseInt(solicitar_btn.value.trim()) ,motivo.value.trim());
			motivo.value = '';
			solicitar_btn.value = '';
		}else{
			motivo_error.textContent = 'Debes ingresar el motivo de tu solicitud';
			motivo_error.classList.remove('hidden');
			setTimeout(ocultar_alerts, 5000);
			clearTimeout(ocultar_alerts);
		}	
	});
}

motivo.addEventListener('keypress', function(e){
	key = e.keyCode || e.which;
    teclado = String.fromCharCode(key).toLowerCase();
    letra = " áéíóúabcdefghijklmnñopqrstuvwxyz";
    teclasEspeciales = "8-37-39-46";
    teclado_especial = false
    for(var i in teclasEspeciales){
        if(key == teclasEspeciales[i]){
        	teclado_especial = true;
        }
    }
    if(letra.indexOf(teclado) == -1 && !teclado_especial){
    	e.preventDefault();
		motivo_error.textContent = 'Solo puedes ingresar letras';
		motivo_error.classList.remove('hidden');
		setTimeout(ocultar_alerts, 5000);
		clearTimeout(ocultar_alerts);
		return false;
    }
});

window.addEventListener('load', cargar_documentos);
window.addEventListener('load', cargar_solicitudes_disponibles);