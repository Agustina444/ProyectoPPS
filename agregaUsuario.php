<?php session_start();
	include("conexion.php");

	//si no esta loggeado, volver
	if(!isset($_SESSION['logueado'])){  
		header("Location: form_login.php");
		exit;
	}

	if(isset($_GET['nombre']) && isset($_GET['apellido']) && isset($_GET['email']) && isset($_GET['usuario']) && isset($_GET['contrasenia']) && isset($_GET['categoria'])){
		$nombre = $_GET['nombre'];
		$apellido = $_GET['apellido'];
		$email = $_GET['email'];
		$usuario = $_GET['usuario'];
		$contraseniaHash = password_hash($_GET['contrasenia'], PASSWORD_DEFAULT);
		$categoria = $_GET['categoria'];
		
		$consulta = mysqli_query($conexion, "INSERT INTO usuarios
												(nombre,apellido,email,usuario,contrasenia,categoria_id)
												VALUES ('$nombre','$apellido','$email','$usuario','$contraseniaHash','$categoria')");										
		header("Location: administrador.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css2?family=Bakbak+One&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="formularios.css">
	<title> Nuevo Usuario </title>
</head>
<body>
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
			<label for="nombre"> Nombre </label>
			<br/>
			<input type="text" name="nombre" id="nombre" required/>

			<br/>
			<label for="apellido"> Apellido </label>
			<br/>
			<input type="text" name="apellido" id="apellido" required/>

			<br/>
			<label for="email"> Correo electrónico </label>
			<br/>
			<input type="email" name="email" id="email" required/>

			<br/>
			<label for="usuario"> Usuario </label>
			<br/>
			<input type="text" name="usuario" id="usuario" required/>
				
			<br/>	
			<label for="contrasenia"> Contraseña </label> 
			<br/>
			<input type="password" name="contrasenia" id="contrasenia" required/>

			<br/>
			<label for="categoria"> Categoría </label> 
			<br/>
			<input type="text" name="categoria" id="categoria" required/>

			<br/><br/>
		
			<input type="submit" class="boton" value="REGISTRAR"/>
		</form>	
	</div>
</body>
</html>