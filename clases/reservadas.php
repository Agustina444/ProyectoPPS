<?php session_start();

//si no inicio sesión, lo manda al formulario para iniciar sesión
include '../lib/necesita_permiso.php';
include '../lib/conexion.php';

$usuario = $_SESSION['id_usuario'];

//comparo usuario con clases reservadas
$tabla = mysqli_query(
	$conexion,
	"SELECT clases.nombre, clases.clase_id, clases.horario
			FROM reservas
			LEFT JOIN clases ON clases.clase_id = reservas.clase_id
			WHERE usuario_id = '$usuario'");	

if(isset($_POST['claseEliminada'])){  
	$eliminar = $_POST['claseEliminada'];

	mysqli_query(
		$conexion,
		"DELETE 
				FROM reservas
				WHERE clase_id = '$eliminar' and usuario_id = '$usuario'");

	header("Location: reservadas.php");
	exit();
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="/static/css/reserva.css">
	<link href="https://fonts.googleapis.com/css2?family=Bakbak+One&display=swap" rel="stylesheet">
	<title> Reservas </title>
</head>
<body>

	<header>
		<?php include '../lib/barra_nav.php'; ?>
	</header>
	
	<div class="contenedor"> 
		<?php 
		if(mysqli_num_rows($tabla)==0){
			echo "<p>no tienes clases reservadas</p>";
		} else { ?>
			<div class="tabla">
				<table>
					<tr>
						<th colspan="2"> RESERVAS </th>
					</tr>
					<?php while ($recorroTabla = mysqli_fetch_array($tabla)) { ?>
					<tr>
						<td><?php echo $recorroTabla['nombre']; ?></td>
						<td><?php echo $recorroTabla['horario']; ?></td>
						<td> 	
							<form action="" method="post">
								<input type="submit" value="✖"/>
								<input type="hidden" name="claseEliminada" value=<?php  echo $recorroTabla['clase_id'] ?>>
							</form>
						</td> 		 
					</tr>	
					<?php   } ?> 
				</table> 
			</div>
		<?php } ?>		

		<div class="boton1">
			<a href="reservar.php"> RESERVAR CLASES </a>
		</div>	

		<div class="boton2">
			<a href="/lib/cerrar_sesion.php"> CERRAR SESIÓN </a>
		</div>
	</div>
</body>
</html>