var btn_cerrar_sesion = document.getElementById('btn_cerrar_sesion');

function cerrar_sesion(e){
	e.preventDefault();
	var peticion_cerrar_sesion = new XMLHttpRequest();
	peticion_cerrar_sesion.open('POST', '../cerrarsesion.php');
	peticion_cerrar_sesion.onload = function(){
		if(peticion_cerrar_sesion.readyState == 4 && peticion_cerrar_sesion.status == 200){
			var respuesta_cerrar_sesion = JSON.parse(peticion_cerrar_sesion.responseText);
			if(respuesta_cerrar_sesion.sesionCerrada){
				location.href = respuesta_cerrar_sesion.path;
			}
		}
	}
	peticion_cerrar_sesion.send();
}

btn_cerrar_sesion.addEventListener('click', cerrar_sesion);