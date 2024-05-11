<?php

require __DIR__.'/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

function pdf($html, $ruta_de_destino){
	if( file_exists($html) ){
		ob_start();
		require $html;
		$contenido = ob_get_clean();
		try{
			$archivo = new Html2Pdf('P', 'LETTER', 'es', true, 'UTF-8', array(25, 30, 25, 30), false);
			$archivo->setDefaultFont('Courier');
			$archivo->writeHTML($contenido);
			$archivo->output($ruta_de_destino, 'F');
			return true;
		}catch(Html2PdfException $e){
			$error = new ExceptionFormatter($e);
			return $error->getMessage();
		}
	}else{
		return 'El archivo "' . str_replace('/', '\\', $html) . '" no existe';
	}
}