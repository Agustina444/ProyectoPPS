<?php
	session_start();
	include("conexion.php");

	//si no esta loggeado, volver
	if(!isset($_SESSION['logueado'])){  
		header("Location: form_login.php");
		exit;
	}

	if (isset($_GET['usuarioModificado'])) {
		$consulta = mysqli_query($conexion,"SELECT *
												FROM usuarios
												WHERE usuario_id = ".$_GET['usuarioModificado']);

		$datosUsuario = mysqli_fetch_array($consulta);
	}

	if(isset($_GET['idUsuario'])){  //cuando se realiza el submit(abajo) le doy el ok a guardar los datos nuevos
		$nombre = $_GET['nombre'];
		$apellido =	$_GET['apellido'];
		$email = $_GET['email'];
		$categoria = $_GET['categoria'];

		$consulta = mysqli_query($conexion, "UPDATE usuarios
												SET nombre = '$nombre', apellido = '$apellido', email = '$email', categoria_id = '$categoria'
												WHERE usuario_id =". $_GET['idUsuario']);										
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
	<title> Modificación Usuario </title>
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
			<label for="nombre"> Nombre </label>
			<br/>
			<input type="text" name="nombre" id="nombre" value="<?php echo $datosUsuario['nombre'] ?>" required/>
			<br/>
			<label for="apellido"> Apellido </label>
			<br/>
			<input type="text" name="apellido" id="apellido" value="<?php echo $datosUsuario['apellido'] ?>" required/>
			<br/>
			<label for="email"> Email </label>
			<br/>
			<input type="email" name="email" id="email" value="<?php echo $datosUsuario['email'] ?>" required/>
			<br/>
			<label for="categoria"> Categoría </label>
			<br/>
			<select name="categoria">
					<option value="1"> Administrador </option>
					<option value="2"> Suscriptor </option>
			</select>
		    <br/>
			<input type="hidden" name="idUsuario" value="<?php echo $datosUsuario['usuario_id'] ?>"/>
			<br/>
			<input type="submit" class="boton" value="CONTINUAR"/>
		</form>
	</div>
</body>
</html>