<?php session_start();

// Si se completo el formulario
if (isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['msj'])) {

	// Conecta a la BD
	require 'lib/conexion_bd.php';

	$nombre = $_POST['nombre'];
	$email = $_POST['email'];
	$msj = $_POST['msj'];

	$destino = "paginaGym@gmail.com";

	$header = "De: " . $nombre;
	//	$emailEnviado = mail($destino,$msj,$header);

	$emailEnviado = true;

	if ($emailEnviado == true) {
		$mensaje = "Su correo se envio con éxito";
		$consulta = mysqli_query(
			$conexion,
			"INSERT INTO contactos (nombre,email,msj)
				 		VALUES ( '$nombre','$email','$msj')"
		);
	} else {
		$mensaje = "Su correo no se pudo enviar";
	}
	mysqli_close($conexion);
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="static/css/form.css">
	<link href="https://fonts.googleapis.com/css2?family=Bakbak+One&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
	<title>Contacto</title>
</head>

<body>

	<header>
		<?php include 'lib/barra_nav.php'; ?>
	</header>

	<?php if (isset($emailEnviado) && $emailEnviado == true) { ?>
		<p> <?php echo $nombre . ":  " . $mensaje; ?> </p>
	<?php } else { ?>
		<div class="contacto">
			<form action="" method="post" autocomplete="off">

				<input type="text" placeholder="Nombre" name="nombre" class="datos" required />
				<br /><br />
				<input type="text" placeholder="Email" name="email" class="datos" required />
				<br /><br />
				<textarea name="msj" class="datos">  </textarea>
				<br /><br />

				<input type="submit" class="boton" value="ENVIAR" />

			</form>
		</div>
	<?php } ?>

	<!-- jQuery -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>