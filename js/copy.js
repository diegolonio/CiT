var texts = document.getElementsByClassName('text');

function copy(evt){
	evt.preventDefault();
	return false;
}

for(var input = 0; input < texts.length; input++){
	texts[input].addEventListener('paste', copy);
}