<?php 
    if(!isset($_SESSION)){ 
        session_start(); 
    } 

	include("conexion.php");

	//si no esta loggeado, volver
	if(!isset($_SESSION['logueado'])){  
		header("Location: form_login.php");
		exit;
	}

	//consulta para ver datos de esas 2 tablas
	$clases = mysqli_query($conexion, " SELECT * 
											FROM clases");

	$usuarios = mysqli_query($conexion, "SELECT usuario, email, usuario_id
											FROM usuarios");

	//consulta para eliminar alguno de sus datos
	if(isset($_GET['claseEliminada'])){     
		$eliminar = $_GET['claseEliminada'];

		mysqli_query($conexion, "DELETE 
									FROM clases
									WHERE clase_id = '$eliminar'");
		header("Location: administrador.php");
		exit();
	}

	if(isset($_GET['usuarioEliminado'])){     
		$eliminar = $_GET['usuarioEliminado'];

		mysqli_query($conexion, "DELETE 
									FROM usuarios
									WHERE usuario_id = '$eliminar'");
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
 	<link rel="stylesheet" type="text/css" href="administrador.css">
 	<title></title>
 </head>
 <body>
 		
 	<header>
		<div class="menu">	
			<nav>
				<ul>
					<li><a href="buscador.php">BUSCAR CLASES</a></li>
					<li><a href="salir.php">CERRAR SESIÓN</a></li>
					<li><a href="pagina.html">INICIO</a></li>
				</ul>
			</nav>	
		</div>
	</header>

	<p> <?php  	
 			echo (" Hola ").$_SESSION['nombre'].("  sos administrador de la página").("<br/>").("<br/>"); 
		?>
	</p>

 	<div class="contenedor">
 		<div class="clases"> 
	 		<div class="tabla1">
			 	<table>
				 	<tr>
				 		<th colspan="2"> CLASES </th>
				 	</tr>
			 		
			 		<?php while ($recorroClases = mysqli_fetch_array($clases)){ ?>
			 		<tr>
			 			<td><?php echo $recorroClases['nombre'] ?> </td>
			 			<td><?php echo $recorroClases['horario'] ?></td>
			 			<td><form action="" method="get">
								<input type="submit" class="botonEliminar" value="✖">
								<input type = "hidden" name="claseEliminada" value="<?php  echo $recorroClases['clase_id'] ?>"/>
							</form>
							<form action="modificaClase.php" method="get">	
								<input type="submit" class="botonModificar" value="✏">
								<input type="hidden" name="claseModificada" value="<?php  echo $recorroClases['clase_id'] ?>"/>
							</form>		 
						</td>
			 		</tr>
					<?php } ?>	
			 	</table>
			</div>	

			<br/><br/>

			<div class="boton1">
			 	<a href="agregaClase.php"> AGREGAR CLASE </a>
			</div>
		</div>

		<div class="usuarios">
			<div class="tabla2">	
			 	<table>
			 		<tr>
			 			<th> USUARIOS </th>
			 			<th> EMAIL </th>
			 		</tr>

			 		<?php while ($recorroUsuarios = mysqli_fetch_array($usuarios)){ ?>
			 		<tr>
			 			<td><?php echo $recorroUsuarios['usuario'] ?> </td>
			 			<td><?php echo $recorroUsuarios['email']   ?> </td>
			 			<td><form action="" method="get">
								<input type="submit" class="botonEliminar"  value="✖">
								<input type="hidden" name="usuarioEliminado" value="<?php  echo $recorroUsuarios['usuario_id'] ?>"/>
							</form>
							<form action="modificaUsuario.php" method="get">	
								<input type="submit" class="botonModificar" value="✏">
								<input type="hidden" name="usuarioModificado" value="<?php  echo $recorroUsuarios['usuario_id'] ?>"/>
							</form>	
						</td>
			 		</tr>
					<?php } ?>	
			 	</table>
			</div>	

			<br/><br/>
			
			<div class="boton2">
			 	<a href="agregaUsuario.php"> AGREGAR USUARIO </a>
			</div>	
		</div>	

	</div>
 </body>
 </html>
