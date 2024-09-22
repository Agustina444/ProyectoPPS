<?php
	session_start();
	include("conexion.php");

	//si no esta loggeado, volver
	if(!isset($_SESSION['logueado'])){  
		header("Location: form_login.php");
		exit;
	}

	if (isset($_GET['claseModificada'])) {
		$consulta = mysqli_query($conexion,"SELECT *
												FROM clases
												WHERE clase_id = ".$_GET['claseModificada']);

		$datosClase = mysqli_fetch_array($consulta); //para que me aparezcan en el text los datos "viejos"
	}


	if(isset($_GET['nombreClase']) && isset($_GET['horarioClase'])){
		$nombre = $_GET['nombreClase'];
		$horario = $_GET['horarioClase'];

		$consulta = mysqli_query($conexion, "UPDATE clases
												SET nombre = '$nombre', horario = '$horario'
												WHERE clase_id =". $_GET['idClase']);										
		header("Location: administrador.php");
	}  
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="formularios.css">
	<link href="https://fonts.googleapis.com/css2?family=Bakbak+One&display=swap" rel="stylesheet">
	<title> Modificación clase </title>
</head>
<body>
	
	<header>
		<div class="menu">	
			<nav>
				<ul>
					<li><a href="salir.php">CERRAR SESION</a></li>
					<li><a href="pagina.html">INICIO</a></li>
				</ul>
			</nav>	
		</div>
	</header>

	<div class="contenedor">
		<form action="" method="get" autocomplete="off">
			<label for="nombreClase"> Nombre Clase </label>
			<br/>
			<input type="text" name="nombreClase" id="nombreClase" value="<?php echo $datosClase['nombre'] ?>" required/>
			<br/>
			<label for="horarioClase"> Horario </label>
			<br/>
			<input type="text" name="horarioClase" id="horarioClase" value="<?php echo $datosClase['horario'] ?>" required/>
			<br/>
			<input type="hidden" name="idClase" value="<?php echo $datosClase['clase_id'] ?>"/>
			<br/><br/>
			<input type="submit" class="boton" value="CONTINUAR"/>
		</form>
	</div>
</body>
</html>