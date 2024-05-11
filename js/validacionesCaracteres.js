var toastContainer = document.getElementById('toastContainer'),
	toastnum = document.getElementById('toastnum'),
	toastchar = document.getElementById('toastchar'),
	inputNum = document.getElementsByClassName('num'),
	inputChar = document.getElementsByClassName('txt');
function validacionNumeros(evt){
	key = evt.keyCode || evt.which;
	teclado = String.fromCharCode(key);
	numero = "0123456789";
	teclasEspeciales = "8-37-38-46";
	teclado_especial = false; 
	for(var i in teclasEspeciales){
		if(key == teclasEspeciales[i]){
			teclado_especial = true;
		}
	}
	if(numero.indexOf(teclado) == -1 && !teclado_especial){
		evt.preventDefault();
		toastContainer.classList.remove('hidden');
		toastContainer.classList.add('show', 'fadeIn', 'faster');
		toastnum.classList.remove('hidden');
		toastnum.classList.add('show');
		return false;
	}
}
function validacionLetras(e){
    key = e.keyCode || e.which;
    teclado = String.fromCharCode(key).toLowerCase();
    letra = " .áéíóúabcdefghijklmnñopqrstuvwxyz";
    teclasEspeciales = "8-37-39-46";
    teclado_especial = false
    for(var i in teclasEspeciales){
        if(key == teclasEspeciales[i]){
        	teclado_especial = true;
        }
    }
    if(letra.indexOf(teclado) == -1 && !teclado_especial){
    	e.preventDefault();
    	toastContainer.classList.remove('hidden');
		toastContainer.classList.add('show', 'fadeIn', 'faster');
		toastchar.classList.remove('hidden');
		toastchar.classList.add('show');
        return false;
    }
}
function cerrarVentanas(){
	var toasts = document.getElementsByClassName('toast');
	for(var no_toast = 0; no_toast < toasts.length; no_toast++){
		toasts[no_toast].classList.remove('show');
		toasts[no_toast].classList.add('hidden');
	}
	toastContainer.classList.remove('show');
	toastContainer.classList.add('hidden');
}
for(var input = 0; input < inputNum.length; input++){
	inputNum[input].addEventListener('keypress', validacionNumeros);
}
for(var input = 0; input < inputChar.length; input++){
	inputChar[input].addEventListener('input', validacionLetras);
}