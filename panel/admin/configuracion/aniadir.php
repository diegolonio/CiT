<?php

if( $_SERVER['REQUEST_METHOD'] == 'POST' ){

	if( !empty($_FILES) ){

		// Comprobación Archivo cargado
		if( $_FILES['csv']['error'] == 4 ){
			$errores = 'Por favor selecciona un archivo para cargar.';
		}else if( pathinfo($_FILES['csv']['name'], PATHINFO_EXTENSION) != 'csv' ){ // Comprobación Archivo de tipo CSV cargado
			$errores = 'El archivo que intentaste cargar no es de tipo CSV';
		}else{

			// Obtención del archivo
			$archivo = file($_FILES['csv']['tmp_name']);

			// Contador número de línea
			$nummero_linea = 0;

			// Contador registros erroneos
			$registros_erroneos = 0;

			foreach($archivo as $registro => $tupla){

				if($nummero_linea != 0){ // Salto de encabezados del archivo csv

					// Obtención de los datos de la línea en un array
					$datos = explode(',', $tupla);

					// Boleta
					$boleta = $datos[0];

					// Nombre
					$nombre = $datos[1];

					// Apellido paterno
					$apePat = $datos[2];

					// Apellido materno
					$apeMat = $datos[3];

					// Grupo
					$grupo = $datos[4];

					// Semestre
					$semestre = $datos[5];

					// Comprobación alumno ya registrado
					$comprobacionAlumnoExistente = $conexion->prepare("SELECT * FROM alumno WHERE boleta = :boleta");
					$comprobacionAlumnoExistente->execute(array(':boleta' => $boleta));
					$existenciaAlumno = $comprobacionAlumnoExistente->fetchAll();

					// Comprobación alumno no registrado
					if( empty($existenciaAlumno) ){

						// Registro alumno
						$registrarAlumno = $conexion->prepare("INSERT INTO alumno VALUES(:boleta, :nombre, :apePat, :apeMat, :grupo, :semestre)");
						$registroExitoso = $registrarAlumno->execute(array(':boleta' => $boleta, ':nombre' => $nombre, ':apePat' => $apePat, ':apeMat' => $apeMat, ':grupo' => $grupo, ':semestre' => $semestre));

						// Comprobación registro exitoso
						if( $registroExitoso ){
							$exito = 'Los datos han sido cargados con éxito.';
						}

					}

				}

				// Incremento en una unidad el contador número de línea
				$nummero_linea++;
			}

		}

	}

}
