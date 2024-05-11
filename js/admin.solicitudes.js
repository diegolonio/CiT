	// Toast archivo no encontrado
var toast404 = document.getElementById('toast404'),
	// Toast cancelar solicitud
	toastCancelar = document.getElementById('toastCancelar'),
	mensaje = document.getElementById('mensaje_rectificar'),
	aceptar_btn = document.getElementById('cancelar_aceptar'),
	descartar_btn = document.getElementById('cancelar_descartar'),
	formulario_filtros = document.getElementById('formulario_filtros'),
	panel = document.getElementById('panel');

var docs, no, date, boleta;

// Funcion abrir archivo solicitud
function abrir(nombre){
	var url = '../../../documentos/' + nombre;

	// Funcion comprobación archivo existente
	function urlExistente(url){
   		var http = new XMLHttpRequest();
   		http.open('POST', url);
   		http.onreadystatechange = function(){
		   	if( http.readyState == 4 && http.status == 200 ){
		   		return true;
		   	}else{
		   		return false;
		   	}
   		}
   		http.send();
   		if( http.onreadystatechange ){
   			return true;
   		}else{
   			return false;
   		}
	}
	if(urlExistente(url)){

		// Apertura de nueva pestaña en el navegador con el archivo de la solicitud
		var win = window.open(url, 'target=_blank');
		win.focus();
	}else{

		// Toast archivo no existente
		toastContainer.classList.remove('hidden');
		toastContainer.classList.add('show', 'fadeIn', 'faster');
		toast404.classList.remove('hidden');
		toast404.classList.add('show');
	}
}

// Funcion cargar solicitudes
function cargar_solicitudes(e){
	var peticion_solicitudes =  new XMLHttpRequest();
	peticion_solicitudes.open('POST', 'solicitudes.php');
	boleta = formulario_filtros.boleta.value;
	docs = formulario_filtros.docs.value;
	no = formulario_filtros.no.value;
	date = formulario_filtros.date.value;

	// Comprobación origen del accionamiento de la funcion
	if( e.type == 'input' ){
		var parametros = 'pagina=1' + '&boleta=' + boleta + '&docs=' + docs + '&no=' + no + '&date=' + date;
	}else if( e.type == 'load' || e.type == 'click' ){
		var parametros = 'pagina=' + pagina() + '&docs=' + docs + '&no=' + no + '&date=' + date;
	}

	// Cabecera de la petición
	peticion_solicitudes.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

	peticion_solicitudes.onload = function(){

		// Respuesta
		var solicitudes = JSON.parse(peticion_solicitudes.responseText);

		if( peticion_solicitudes.readyState == 4 && peticion_solicitudes.status == 200 ){

			// Eliminación de las tarjetas de las solicitudes
			while( panel.firstChild ) {
	   			panel.removeChild(panel.firstChild);
			}

			if( !solicitudes.error ){ // Si no hay errores

				// Creación del contenedor de la paginación
				var paginacion = document.createElement('section');
					paginacion.classList.add('paginacion');
					panel.appendChild(paginacion);

				if( !solicitudes.registros ){ // Si no hay registros
					var aviso_no_registros = document.createElement('p');
					aviso_no_registros.classList.add('aviso_no_registros');
					aviso_no_registros.innerHTML = 'No hay solicitudes';
					paginacion.appendChild(aviso_no_registros);
				}else{ // Si hay registros
					for( var tupla = 0; tupla < solicitudes.registros.length; tupla++ ){
						// Div solicitud
						var solicitud = document.createElement('div');
						solicitud.classList.add('solicitud');
						// P documento
						var documento = document.createElement('p');
						documento.innerHTML = '<b>' + solicitudes.registros[tupla].documento + '</b>';
						solicitud.appendChild(documento);
						// P boleta
						var boleta = document.createElement('p');
						boleta.innerHTML = '<b>Boleta:</b> ' + solicitudes.registros[tupla].boleta;
						solicitud.appendChild(boleta);
						// P folio
						var folio = document.createElement('p');
						folio.innerHTML = '<b>Folio:</b> ' + solicitudes.registros[tupla].folio;
						solicitud.appendChild(folio);
						// P fecha
						var fecha = document.createElement('p');
						fecha.innerHTML = '<b>Fecha:</b> ' + solicitudes.registros[tupla].fecha;
						solicitud.appendChild(fecha);
						var motivo = document.createElement('p');
						motivo.innerHTML = '<b>Motivo:</b> ' + solicitudes.registros[tupla].motivo;
						solicitud.appendChild(motivo);
						// FORM autorizar
						var formulario_autorizar = document.createElement('form');
						formulario_autorizar.setAttribute('action', '');
						formulario_autorizar.setAttribute('method', 'POST');
						formulario_autorizar.classList.add('formulario_autorizar');
						formulario_autorizar.id = 'formulario_autorizar';
						// BUTTON autorizar
						var btn_autorizar = document.createElement('button');
						btn_autorizar.setAttribute('type', 'submit');
						btn_autorizar.setAttribute('class', 'autorizado_btn');
						btn_autorizar.setAttribute('name', 'autorizar');
						btn_autorizar.setAttribute('value', solicitudes.registros[tupla].folio);
						btn_autorizar.addEventListener('click', autorizar);
						btn_autorizar.textContent = 'Autorizar';
						formulario_autorizar.appendChild(btn_autorizar);
						// BUTTON Cancelar
						var btn_cancelar = document.createElement('button');
						btn_cancelar.setAttribute('class', 'cancelado_btn');
						btn_cancelar.setAttribute('name', 'cancelar');
						btn_cancelar.setAttribute('value', solicitudes.registros[tupla].folio);
						btn_cancelar.addEventListener('click', rectificar);
						btn_cancelar.textContent = 'Cancelar';
						formulario_autorizar.appendChild(btn_cancelar);
						solicitud.appendChild(formulario_autorizar);
						panel.insertBefore(solicitud, paginacion);
					}

					// Paginación
					if( solicitudes.numeroPaginas > 1 ){

						// Botón retroceder
						var ul = document.createElement('ul');
						var left_li = document.createElement('li');
						var span_arrow_left = document.createElement('span');
						span_arrow_left.setAttribute('class', 'fas fa-chevron-left');
						if(solicitudes.paginacion.pagina == 1){
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

						// Botones páginas
						for(var x = 1; x <= solicitudes.paginacion.numeroPaginas; x++){
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

						// Botón avanzar
						var right_li = document.createElement('li');
						var span_arrow_right = document.createElement('span');
						span_arrow_right.setAttribute('class', 'fas fa-chevron-right');
						if(solicitudes.paginacion.pagina == solicitudes.paginacion.numeroPaginas){
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
					}else{
						panel.removeChild(paginacion);
					}
				}
			}else{ // Si hay errores
				location.href = '../solicitudes/';
			}
		}
	}
	peticion_solicitudes.send(parametros);
}

// Funcion obtención página actual
function pagina() {

	// Funcion obtención del valor de cualquier parametro get del buscador cuyo nombre se pase como argumento
	function obtencion(name){
	    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
	    results = regex.exec(location.search);
	    return results === null ? false : parseInt(decodeURIComponent(results[1].replace(/\+/g, " ")));
	}

	if(!obtencion('pagina')){ // Si no hay página especificada
		var num_pagina = 1;
	}else{
		var num_pagina = obtencion('pagina');
	}
	return num_pagina;
}

// Funcion autorizar solicitud
function autorizar(e){
	e.preventDefault();
	peticion_autorizar = new XMLHttpRequest();
	peticion_autorizar.open('POST', 'autorizar.php');

	// Parametros de la solicitud
	var folio = document.getElementById('formulario_autorizar').autorizar.value;
	var parametro_folio = 'autorizar=' + folio;

	// Cabecera
	peticion_autorizar.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

	peticion_autorizar.onreadystatechange =  function(){
		if(peticion_autorizar.readyState == 4 && peticion_autorizar.status == 200){
			var respuesta = JSON.parse(peticion_autorizar.responseText);
			if(respuesta.autorizado){
				cargar_solicitudes(e);
				abrir(respuesta.archivo);
			}
		}
	}
	peticion_autorizar.send(parametro_folio);
}

// Funcion cancelar solicitud
function cancelar(e){
	cerrarVentanas();
	peticion_cancelar = new XMLHttpRequest();
	peticion_cancelar.open('POST', 'autorizar.php');

	// Parametros de la solicitud
	var folio = this.value;
	var parametro_folio = 'cancelar=' + folio;

	// Cabecera
	peticion_cancelar.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

	peticion_cancelar.onreadystatechange =  function(){
		if(peticion_cancelar.readyState == 4 && peticion_cancelar.status == 200){
			var respuesta = JSON.parse(peticion_cancelar.responseText);
			if(respuesta.cancelado){
				cargar_solicitudes(e);
			}
		}
	}
	peticion_cancelar.send(parametro_folio);
}

// Funcion rectificación cancelar solicitud
function rectificar(e){
	e.preventDefault();
	var folio = this.value;
	toastContainer.classList.remove('hidden');
	toastContainer.classList.add('show', 'fadeIn', 'faster');
	mensaje.innerHTML = '¿Estás seguro que deseas cancelar la solicitud con<br>folio: <b>' + folio + '</b> ?';
	toastCancelar.classList.remove('hidden');
	toastCancelar.classList.add('show');
	aceptar_btn.value = folio;
	aceptar_btn.addEventListener('click', cancelar);
	descartar_btn.addEventListener('click', cerrarVentanas);
}

formulario_filtros.addEventListener('input', cargar_solicitudes);
window.addEventListener('load', cargar_solicitudes);