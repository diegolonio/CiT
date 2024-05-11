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
		.contenedor {
			width: 100%;
		}
		.documento, .boleta {
			margin: 0 auto;
			text-align: center;
			position: relative;
		}
		.documento {
			margin-bottom: 20px;
			font-size: 35px;
			font-weight: bold;
			top: 40%;
		}
		.boleta {
			font-size: 20px;
			top: 45%;
		}
	</style>
</head>
<body>
	<div class="contenedor">
		<p class="documento">Boleta Global de Calificaciones Certificada</p>
		<p class="boleta">Boleta: <?php echo $boletaAlumno; ?></p>
	</div>
	<script type="text/javascript">
		document.title = <?php echo $boletaAlumno; ?>;
		this.print();
	</script> 
</body>
</html>
