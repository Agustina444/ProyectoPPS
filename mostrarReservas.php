<?php  
	if(!isset($_SESSION)){ 
        session_start(); 
    } 
    
	$usuario = $_SESSION['id_usuario'];
	
	include("conexion.php");

	//si no esta loggeado, volver
	if(!isset($_SESSION['logueado'])){  
		header("Location:form_login.php");
		exit();
	}

	//comparo usuario con clases reservadas
	$tabla = mysqli_query($conexion, " SELECT clases.nombre, clases.clase_id, clases.horario
											FROM reservas
											LEFT JOIN clases ON clases.clase_id = reservas.clase_id
											WHERE usuario_id = '$usuario'");	

	if(isset($_GET['claseEliminada'])){  
		$eliminar = $_GET['claseEliminada'];

		mysqli_query($conexion, "DELETE 
									FROM reservas
									WHERE clase_id = '$eliminar' and usuario_id = '$usuario'");
		header("Location:mostrarReservas.php");
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="reserva.css">
	<link href="https://fonts.googleapis.com/css2?family=Bakbak+One&display=swap" rel="stylesheet">
	<title> Reservas </title>
</head>
<body>

	<header>
		<div class="menu">	
			<nav>
				<ul>
					<li><a href="salir.php">CERRAR SESIÓN</a></li>
				</ul>
			</nav>	
		</div>
	</header>

	<p> 
		<?php  	
 		echo (" Hola ").$_SESSION['nombre'].("  sos suscriptor de la página").("<br/>"); 
		?>
	</p>
	
	<div class="contenedor"> 
		<?php
			if(mysqli_num_rows($tabla)==0){ ?>
				<p> <?php echo "no tienes clases reservadas";?> </p>
		<?php } else { ?>
				<div class="tabla">
					<table>
						<tr>
				 			<th colspan="2"> RESERVAS </th>
				 		</tr>
						<?php 	while ($recorroTabla = mysqli_fetch_array($tabla)) { ?>
						<tr>
							<td><?php echo $recorroTabla['nombre']; ?></td>
							<td><?php echo $recorroTabla['horario']; ?></td>
							<td> 	
								<form action="" method="get">
									<input type="submit" value="✖"/>
									<input type="hidden" name="claseEliminada" value=<?php  echo $recorroTabla['clase_id'] ?>>
								</form>
							</td> 		 
						</tr>	
						<?php   } ?> 
					</table> 
				</div>
	<?php   } ?>		

		<div class="boton1">
			<a href="reserva.php"> RESERVAR CLASE </a>
		</div>	

		<div class="boton2">
			<a href="salir.php"> CERRAR SESIÓN </a>
		</div>
	</div>
</body>
</html>