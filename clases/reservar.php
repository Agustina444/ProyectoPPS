<?php session_start();

//si no inicio sesión, lo manda al formulario para iniciar sesión
include '../lib/necesita_permiso.php';
include '../lib/conexion.php';

$id = $_SESSION['id_usuario'];

//muestra en el select
$consulta = mysqli_query(
	$conexion,
	"SELECT * 
			FROM clases");	

//si selecciono alguna clase
if(isset($_POST['clases'])){
	$clase = $_POST['clases'];

	//reviso si ya reservo esa clase
	$consulta = mysqli_query(
		$conexion,
		"SELECT * 
				FROM reservas 
				WHERE usuario_id = '$id' and clase_id = '$clase'");

	$resultado = mysqli_num_rows($consulta);

	//si es 0, no reservo nunca esa clase
	if($resultado!=1){
		mysqli_query(
			$conexion,
			"INSERT INTO reservas (usuario_id, clase_id)
					VALUES ('$id' , '$clase')");

		header("Location: reservadas.php");
		exit();
	} 
	else{   //si es 1, ya la reservo
		header("Location: reservadas.php");
		exit();
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css2?family=Bakbak+One&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/static/css/reserva.css">
	<title> Clases	</title>
</head>
<body>
	
	<header>
		<?php include '../lib/barra_nav.php'; ?>
	</header>

	<div class="contenedor">
		<div class="reserva">

			<form action="" method="post">
				<select name="clases">
					<?php while($muestroClases= mysqli_fetch_array($consulta)) { ?>	
						<option value="<?php echo $muestroClases['clase_id'] ?>"> <?php echo $muestroClases['nombre'] ?></option>
					<?php } ?>
				</select>
				<input type="submit" class="botonReservar" value="RESERVAR">
			</form>
			
		</div>		
	</div>	
</body>
</html>