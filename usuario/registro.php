<?php session_start();

if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['email']) && isset($_POST['usuario']) && isset($_POST['contrasenia'])) {
	
	$_SESSION['logueado'] = true;
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$email = $_POST['email'];
	$usuario = $_POST['usuario'];
	$contraseniaHash = password_hash($_POST['contrasenia'], PASSWORD_DEFAULT);
	$categoria = '2';

	include '../lib/conexion.php';
	mysqli_query(
		$conexion,
		"INSERT INTO usuarios (nombre, apellido, email, usuario, contrasenia, categoria_id)
				VALUES ('$nombre', '$apellido', '$email', '$usuario', '$contraseniaHash', '$categoria')"
	);

	//me guardo el ID del usuario
	$consulta = mysqli_query(
		$conexion,
		"SELECT usuario_id, nombre
					FROM usuarios
					WHERE usuario = '$usuario'"
	);

	$datosUsuario = mysqli_fetch_array($consulta);

	$_SESSION['nombre'] = $datosUsuario['nombre'];
	$_SESSION['id_usuario'] = $datosUsuario['usuario_id'];

	mysqli_close($conexion);
	header("Location: ../index.php");
	exit();
}

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Registro </title>
	<link rel="stylesheet" type="text/css" href="../static/css/form.css">
	<link href="https://fonts.googleapis.com/css2?family=Bakbak+One&display=swap" rel="stylesheet">
</head>

<body>

	<header>
		<?php include '../lib/barra_nav.php'; ?>
	</header>
	
	<?php if (isset($_SESSION['logueado']) && $_SESSION['logueado']){
		header("Location: ../index.php");
		exit();
	}?>
	<div class="contenedor">
		<form action="" method="post" autocomplete="off">
			<label for="nombre"> Nombre </label>
			<br />
			<input type="text" name="nombre" id="nombre" required />

			<br />
			<label for="apellido"> Apellido </label>
			<br />
			<input type="text" name="apellido" id="apellido" required />

			<br />
			<label for="email"> Correo electrónico </label>
			<br />
			<input type="email" name="email" id="email" required />

			<br />
			<label for="usuario"> Usuario </label>
			<br />
			<input type="text" name="usuario" id="usuario" required />

			<br />
			<label for="contrasenia"> Contraseña </label>
			<br />
			<input type="password" name="contrasenia" id="contrasenia" required />

			<br /><br />

			<input type="submit" class="boton" value="REGISTRAR" />
		</form>
	</div>
</body>

</html>