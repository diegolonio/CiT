<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="icon" href="../../img/favicon.ico" type="image/x-icon">
	<style>
		* {
			margin: 0;
			padding: 0;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			font-family: 'Courier New';
		}
		.header {
			width: 100%
		}
		.header p {
			width: 100%;
			text-align: center;
		}
		.header .institucion {
			margin-bottom: 10px;
			font-size: 14px;
			font-weight: bold;
		}
		.header .plantel {
			margin-bottom: 10px;
			line-height: 20px;
			font-size: 12px;
		}
		.header .departamento {
			margin-bottom: 10px;
			line-height: 20px;
			font-size: 13px;
		}
		.header .documento {
			font-size: 13px;
			font-weight: bold;
		}
		.main {
			width: 100%;
		}
		.main p {
			width: 100%;
			font-size: 14px;
		}
		.main .presentacion {
			margin-top: 20px;
			line-height: 25px;
		}
		.main .alumno {
			margin: 20px 0;
			text-align: center;
			font-weight: bold;
			text-transform: uppercase;
		}
		.main .constancia {
			line-height: 25px;
			text-align: justify;
		}
		.main .observaciones {
			margin-top: 20px;
			line-height: 25px;
			text-align: justify;
		}
		.footer {
			width: 100%;
		}
		.footer p {
			width: 100%;
			text-align: center;
		}
		.footer .despedida {
			margin-top: 80px;
			line-height: 20px;
			text-align: center;
		}
		.footer .firma {
			margin-top: 60px;
			line-height: 20px;
		}
		.footer .nota {
			margin-top: 70px;
			font-size: 9px;
		}
	</style>
</head>
<body>
	<div class="header">
		<p class="institucion">INSTITUTO POLITÉCNICO NACIONAL</p>
		<p class="plantel">CENTRO DE ESTUDIOS CIENTÍFICOS Y TECNOLÓGICOS No. 14<br>LUIS ENRIQUE ERRO SOLER</p>
		<p class="departamento">SUBDIRECCIÓN DE SERVICIOS EDUCATIVOS E INTEGRACIÓN SOCIAL<br>DEPARTAMENTO DE GESTIÓN ESCOLAR</p>
		<p class="documento">CONSTANCIA DE ESTUDIOS</p>
	</div>
	<div class="main">
		<p class="presentacion">A QUIEN CORRESPONDA:<br>EL QUE SUSCRIBE HACE CONSTAR QUE EL ALUMNO</p>
		<p class="alumno"><?php echo $nombreAlumno; ?></p>
		<p class="constancia">
			CON NÚMERO DE BOLETA <b><?php echo $boletaAlumno; ?></b> ESTÁ INSCRITO EN ESTE PLANTEL CURSANDO ASIGNATURAS DEL <b><?php echo $nivelAlumno; ?></b>, GRUPO <b><?php echo $grupoAlumno; ?></b> DE LA <b>CARRERA DE TÉCNICO EN INFORMÁTICA</b> COMO ALUMNO <b>REGULAR</b> EN EL TURNO <b>MATUTINO</b> CUBRIENDO EL <b>47.98%</b> DE CRÉDITOS CON UN PROMEDIO GENERAL DE <b>8.21</b>.
		</p>
		<p class="observaciones">
			<b>OBSERVACIONES:</b><br>LA CARRERA CONSTA DE <b>6</b> NIVELES, CON UN TOTAL DE <b>245.23</b> CRÉDITOS.<br>LA VIGENCIA ES DEL <b>1 DE FEBRERO DE <?php echo $anio; ?></b> AL <b>26 DE JUNIO DE <?php echo $anio; ?></b> SE EXTIENDE LA PRESENTE A PETICIÓN DEL INTERESADO EN LA CIUDAD DE MÉXICO, A LOS <?php echo $dia; ?> DÍAS DEL MES DE <?php echo $mes; ?> DEL <?php echo $anio; ?>
		</p>
	</div>
	<div class="footer">
		<p class="despedida">A T E N T A M E N T E<br>"LA TÉCNICA AL SERVICIO DE LA PATRIA"</p>
		<p class="firma"><b>____________________________________<br>LIC. OSCAR FERNANDO SÁNCHEZ SERVÍN<br>DEPARTAMENTO DE GESTIÓN ESCOLAR</b></p>
		<p class="nota"><b>NOTA: </b>ESTE DOCUMENTO CARECE DE VALIDÉZ SIN FÍRMA NI SELLO OFICIAL Y EN CASO DE TENER RASPADURAS O ENMENDADURAS</p>
	</div>
</body>
</html>
