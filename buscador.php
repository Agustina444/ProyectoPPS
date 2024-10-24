<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="formularios.css">
	<link href="https://fonts.googleapis.com/css2?family=Bakbak+One&display=swap" rel="stylesheet">
	<title> Buscar </title>
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
		<form action="resultadoBuscador.php" method="get" autocomplete="off">	
		    <input type="search" name="buscar" placeholder="BUSCAR"/>
		    <input type="submit" class="boton" value="BUSCAR">
		</form>
	</div>

</body>
</html>