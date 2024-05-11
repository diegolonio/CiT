var nombre = document.getElementById('nombreDeEmpleado'),
	codigo = document.getElementById('codigoDeEmpleado');

var peticion = new XMLHttpRequest();
peticion.open('POST', 'resumen.php');
peticion.onload = function(){
	var respuesta = JSON.parse(peticion.responseText);
	if( peticion.readyState == 4 && peticion.status == 200 ){
		nombre.innerHTML = 'Nombre: ' + respuesta.nombre;
		codigo.innerHTML = 'No. Empleado: ' + respuesta.codigo;
	}
}
peticion.send();