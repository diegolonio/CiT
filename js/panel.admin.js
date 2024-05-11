var grupoModificable = document.getElementById('grupoModificable');
var semestreModificable = document.getElementById('semestreModificable');
var nombreModificable = document.getElementById('nombreModificable');
var apePatModificable = document.getElementById('apePatModificable');
var apeMatModificable = document.getElementById('apeMatModificable');
var passwordModificable = document.getElementById('passwordModificable');
var datosAcademicosBtn = document.getElementById('datosAcademicosBtn');
var datosPersonalesBtn = document.getElementById('datosPersonalesBtn');
var datosUsuarioBtn = document.getElementById('datosUsuarioBtn');
var modificarDatosBtn = document.getElementById('modificarBtn');
var boletaDeReferencia = document.getElementById('boletaBuscadaModificable');
datosAcademicosBtn.addEventListener('click', function(){
	boletaModificable.toggleAttribute('disabled');
	grupoModificable.toggleAttribute('disabled');
	semestreModificable.toggleAttribute('disabled');
});
datosPersonalesBtn.addEventListener('click', function(){
	nombreModificable.toggleAttribute('disabled');
	apePatModificable.toggleAttribute('disabled');
	apeMatModificable.toggleAttribute('disabled');
});
datosUsuarioBtn.addEventListener('click', function(){
	passwordModificable.toggleAttribute('disabled');
	if(passwordModificable.type == 'password'){
		passwordModificable.removeAttribute('type');
		passwordModificable.setAttribute('type', 'text');
	}else if(passwordModificable.type == 'text'){
		passwordModificable.removeAttribute('type');
		passwordModificable.setAttribute('type', 'password');
	}
});
modificarDatosBtn.addEventListener('click', function(){
	boletaDeReferencia.removeAttribute('disabled');
	boletaModificable.removeAttribute('disabled');
	grupoModificable.removeAttribute('disabled');
	semestreModificable.removeAttribute('disabled');
	nombreModificable.removeAttribute('disabled');
	apePatModificable.removeAttribute('disabled');
	apeMatModificable.removeAttribute('disabled');
	passwordModificable.removeAttribute('disabled');
});
