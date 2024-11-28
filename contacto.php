<?php session_start();

// Si se completo el formulario
if (isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['msj'])) {

	// Conecta a la BD
	require './lib/conexion_bd.php';

	$nombre = $_POST['nombre'];
	$email = $_POST['email'];
	$msj = $_POST['msj'];

	$destino = "paginaGym@gmail.com";

	$header = "De: " . $nombre;
	//	$emailEnviado = mail($destino,$msj,$header);

	$emailEnviado = true;

	if ($emailEnviado == true) {
			$consulta = mysqli_query($conexion,
				"INSERT INTO contactos (nombre,email,msj)
					VALUES ('$nombre','$email','$msj')");

			echo '<script>
				document.addEventListener("DOMContentLoaded", function() {
					Swal.fire({
						title: "Éxito!",
							text: "Su mensaje se envio correctamente.",
								icon: "success",
									confirmButtonText: "Aceptar"
					})  .then((result) => {
							if (result.isConfirmed) {
								window.location.href = "index.php";
							}
						});
				});
			</script>';
	} else {

		echo 	'<script>
					document.addEventListener("DOMContentLoaded", function() {
						Swal.fire({
							title: "Ocurrio un error!",
								text: "Su mensaje no se pudo enviar.",
									icon: "error",
										confirmButtonText: "Aceptar"
						})  .then((result) => {
								if (result.isConfirmed) {
									window.location.href = "index.php";
								}
							});
					});
			    </script>';
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
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<title>Contacto</title>
</head>

<body>

	<header>
		<?php include 'lib/barra_nav.php'; ?>
	</header>
		<div class="contacto">
			<form action='' method="post" autocomplete="off">

				<input type="text" name="nombre" required placeholder="Nombre" class="datos"
       					oninvalid="this.setCustomValidity('Debes ingresar tu nombre')"
       					oninput="this.setCustomValidity('')"/>
				
				<br /><br />

				<input type="email" name="email" required placeholder="Email" class="datos"
       					oninvalid="this.setCustomValidity('Debes ingresar tu email')"
       					oninput="this.setCustomValidity('')"/>
				
				<br /><br />

				<textarea name="msj" class="datos" required></textarea>
				
				<br /><br />

				<input type="submit" class="boton" value="ENVIAR" />

			</form>
		</div>

	<!-- Popperjs -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->
 	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>