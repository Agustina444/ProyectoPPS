<?php session_start();
	include("conexion.php");

	//si no esta loggeado, volver
	if(!isset($_SESSION['logueado'])){  
		header("Location: form_login.php");
		exit;
	}
	
	if(isset($_GET['nombreClase']) && isset($_GET['horarioClase'])){
		$clase = $_GET['nombreClase'];
		$horario = $_GET['horarioClase'];

		$consulta = mysqli_query($conexion, "INSERT INTO clases
												(nombre,horario)
												VALUES ('$clase','$horario')");
		header("Location: administrador.php");
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css2?family=Bakbak+One&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="formularios.css">
	<title> Nueva Clase </title>
</head>
<body>
	
	<header>
		<div class="menu">	
			<nav>
				<ul>
					<li><a href="salir.php">CERRAR SESIÓN</a></li>
					<li><a href="pagina.html">INICIO</a></li>
				</ul>
			</nav>	
		</div>
	</header>

	<div class="contenedor">
		<form action="" method="get" autocomplete="off">
			<label for="nombreClase"> Nombre Clase </label>
			<br/>
			<input type="text" name="nombreClase" id="nombreClase" required/>
			<br/>
			<label for="horarioClase"> Horario </label>
			<br/>
			<input type="text" name="horarioClase" id="horarioClase" required/>
			<br/><br/>

			<input type="submit" class="boton" value="CONTINUAR"/>
		</form>
	</div>

</body>
</html>