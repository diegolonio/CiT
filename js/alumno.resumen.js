var nombre = document.getElementById('nombre'),
	boleta = document.getElementById('boleta'),
	grupo = document.getElementById('grupo'),
	semestre = document.getElementById('semestre');

var peticion = new XMLHttpRequest();
peticion.open('POST', 'resumen.php');
peticion.onload = function(){
	var respuesta = JSON.parse(peticion.responseText);
	if( peticion.readyState == 4 && peticion.status == 200 ){
		nombre.innerHTML = 'Nombre: ' + respuesta.nombre;
		boleta.innerHTML = 'Boleta: ' + respuesta.boleta;
		grupo.innerHTML = 'Grupo: ' + respuesta.grupo;
		semestre.innerHTML = 'Semestre: ' + respuesta.semestre;

	}
}
peticion.send();