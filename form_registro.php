<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Registro </title>
	<link rel="stylesheet" type="text/css" href="formularios.css">
	<link href="https://fonts.googleapis.com/css2?family=Bakbak+One&display=swap" rel="stylesheet">
</head>
<body>

	<header>
		<div class="menu">	
			<nav>
				<ul>
					<li><a href="form_login.php"> INICIAR SESION </a></li>
					<li><a href="pagina.html"> INICIO </a></li>
				</ul>
			</nav>	
		</div>
	</header>
	
	<div class="contenedor">
		<form action="registro.php" method="get" autocomplete="off">
			<label for="nombre"> Nombre </label>
			<br/>
			<input type="text" name="nombre" id="nombre" required/>

			<br/>
			<label for="apellido"> Apellido </label>
			<br/>
			<input type="text" name="apellido" id="apellido" required/>

			<br/>
			<label for="email"> Mail </label>
			<br/>
			<input type="email" name="email" id="email" required/>

			<br/>
			<label for="usuario"> Nombre de Usuario </label>
			<br/>
			<input type="text" name="usuario" id="usuario" required/>
				
			<br/>	
			<label for="contrasenia"> Contraseña </label> 
			<br/>
			<input type="password" name="contrasenia" id="contrasenia" required/>

			<br/><br/>
		
			<input type="submit" class="boton" value="REGISTRARSE"/>	
		</form>	
	</div>
</body>
</html>