var formulario_filtros = document.getElementById('formulario_filtros'),
	panel = document.getElementById('panel');

var docs, no, date, filtro_estado;

function cargar_registros(e){
	var peticion_registros = new XMLHttpRequest();
	peticion_registros.open('POST', 'historial.php');
	docs = formulario_filtros.docs.value;
	no = formulario_filtros.no.value;
	date = formulario_filtros.date.value;
	filtro_estado = formulario_filtros.filtro_estado.value;
	if(e.type == 'input'){
		var parametros = 'pagina=1&docs=' + docs + '&no=' + no + '&date=' + date + '&filtro_estado=' + filtro_estado;
	}else if(e.type == 'load'){
		var parametros = 'pagina=' + pagina() + '&docs=' + docs + '&no=' + no + '&date=' + date + '&filtro_estado=' + filtro_estado;
	}
	peticion_registros.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	peticion_registros.onload = function(){
		var respuesta_registros = JSON.parse(peticion_registros.responseText);
		while(panel.firstChild) {
   			panel.removeChild(panel.firstChild);
		}
		if(!respuesta_registros.error){
			var paginacion = document.createElement('section');
				paginacion.classList.add('paginacion');
				panel.appendChild(paginacion);
			if( !respuesta_registros.registros ){
				var aviso_no_registros = document.createElement('p');
				aviso_no_registros.classList.add('aviso_no_registros');
				aviso_no_registros.innerHTML = 'No hay solicitudes';
				paginacion.appendChild(aviso_no_registros);
			}else{
				for(var tupla = 0; tupla < respuesta_registros.registros.length; tupla++){
					var registro = document.createElement('div');
					registro.classList.add('registro');
					var nombre = document.createElement('p');
					nombre.innerHTML = respuesta_registros.registros[tupla].documento;
					registro.appendChild(nombre);
					var folio = document.createElement('p');
					folio.innerHTML = respuesta_registros.registros[tupla].folio;
					registro.appendChild(folio);
					var fecha = document.createElement('p');
					fecha.innerHTML = respuesta_registros.registros[tupla].fecha;
					registro.appendChild(fecha);
					var estado = document.createElement('span');
					if(respuesta_registros.registros[tupla].estado == 1){
						estado.setAttribute('title', 'En espera');
						estado.setAttribute('class', 'fas fa-clock en_espera');
					}else if(respuesta_registros.registros[tupla].estado == 2){
						estado.setAttribute('title', 'Autorizado');
						estado.setAttribute('class', 'fas fa-check-circle autorizado');
					}else if(respuesta_registros.registros[tupla].estado == 3){
						estado.setAttribute('title', 'Cancelado');
						estado.setAttribute('class', 'fas fa-times-circle cancelado');
					}
					registro.appendChild(estado);
					panel.insertBefore(registro, paginacion);
				}
				if( respuesta_registros.paginacion.numeroPaginas > 1 ){
					var ul = document.createElement('ul');
					var left_li = document.createElement('li');
					var span_arrow_left = document.createElement('span');
					span_arrow_left.setAttribute('class', 'fas fa-chevron-left');
					if(respuesta_registros.paginacion.pagina == 1){
						left_li.classList.add('disabled');
						left_li.appendChild(span_arrow_left);
						ul.appendChild(left_li);
					}else{
						var a_arrow_left = document.createElement('a');
						var pagina_anterior = pagina() - 1;
						a_arrow_left.setAttribute('href', '?pagina=' + pagina_anterior);
						left_li.appendChild(span_arrow_left);
						a_arrow_left.appendChild(left_li);
						ul.appendChild(a_arrow_left);
					}
					for(var x = 1; x <= respuesta_registros.paginacion.numeroPaginas; x++){
						var pagina_a = document.createElement('a');
						pagina_a.setAttribute('href', '?pagina=' + x);
						var pagina_li = document.createElement('li');
						if(pagina() == x){
							pagina_li.classList.add('active');
						}
						pagina_li.innerHTML = x;
						pagina_a.appendChild(pagina_li);
						ul.appendChild(pagina_a);
					}
					var right_li = document.createElement('li');
					var span_arrow_right = document.createElement('span');
					span_arrow_right.setAttribute('class', 'fas fa-chevron-right');
					if(respuesta_registros.paginacion.pagina == respuesta_registros.paginacion.numeroPaginas){
						right_li.classList.add('disabled');
						right_li.appendChild(span_arrow_right);
						ul.appendChild(right_li);
					}else{
						var a_arrow_right = document.createElement('a');
						var pagina_siguiente = pagina() + 1;
						a_arrow_right.setAttribute('href', '?pagina=' + pagina_siguiente);
						right_li.appendChild(span_arrow_right);
						a_arrow_right.appendChild(right_li);
						ul.appendChild(a_arrow_right);
					}
					paginacion.appendChild(ul);
				}
			}			
		}else{
			location.href = '../historial/';
		}
	}
	peticion_registros.send(parametros);
}

function pagina() {
	function obtencion(name){
	    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
	    results = regex.exec(location.search);
	    return results === null ? false : parseInt(decodeURIComponent(results[1].replace(/\+/g, " ")));
	}
	if(!obtencion('pagina')){
		var num_pagina = 1;
	}else{
		var num_pagina = obtencion('pagina');
	}
	return num_pagina;
}

formulario_filtros.addEventListener('input', cargar_registros);
window.addEventListener('load', cargar_registros);