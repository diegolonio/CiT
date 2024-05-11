<?php 
class ALUMNO {
	public $boleta;
	public $nombre;
	public $apePat;
	public $apeMat;
	public $grupo;
	function __construct($boleta, $nombre, $apePat, $apeMat, $grupo){
		$this->boleta = $boleta;
		$this->nombre = $nombre . ' ' . $apePat . ' ' . $apeMat;
		$this->grupo = $grupo;
	}
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(isset($_POST['consultarAlumnoBtn'])){
		$erroresConsultaAlumno = '';
		if(!empty($_POST['boletaBusquedaConfig'])){
			$boletaBusquedaConfig = $_POST['boletaBusquedaConfig'];
			$boletaBusquedaConfig = trim($boletaBusquedaConfig);
			$boletaBusquedaConfig = filter_var($boletaBusquedaConfig, FILTER_SANITIZE_STRING);
			$consultaDatosAlumno = $conexion->prepare("SELECT boleta, nombre, apePat, apeMat, grupo FROM alumno WHERE boleta = :boleta");
			$consultaDatosAlumno->execute(array(':boleta' => $boletaBusquedaConfig));
			$datosAlumno = $consultaDatosAlumno->fetchAll();
			if(empty($datosAlumno)){
				$erroresConsultaAlumno .= 'La boleta ingresada no existe.';
			}else{
				$alumno = new ALUMNO($datosAlumno[0]['boleta'], $datosAlumno[0]['nombre'], $datosAlumno[0]['apePat'], $datosAlumno[0]['apeMat'], $datosAlumno[0]['grupo']);
			}
		}else{
			$erroresConsultaAlumno .= 'Por favor, ingrese una boleta para consultar';
		}
	}
}
