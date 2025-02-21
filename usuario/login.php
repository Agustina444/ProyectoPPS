<?php

// Comienza la sesión si no esta creada
if(!isset($_SESSION)) session_start(); 

$msj = "";

if (isset($_POST['usuario']) && isset($_POST['contrasenia'])) {

	// Conecta a la BD
	require '../lib/conexion_bd.php';

	$usuario = $_POST['usuario'];
	$contrasenia = $_POST['contrasenia'];

	// Busca al usuario en la BD
	$sql = "
		SELECT *
		FROM usuarios 
		WHERE usuario = '$usuario'
	";
	$consulta = mysqli_query($conexion, $sql);

	$resultado = mysqli_num_rows($consulta); //si la funcion me devuelve mas de 1 fila

	if ($resultado != 0) {
		$datosUsuario = mysqli_fetch_assoc($consulta);
		$contraseniaHash = $datosUsuario['contrasenia'];

		if (password_verify($contrasenia, $contraseniaHash)) {  //corroboro la contraseña

			$_SESSION['logueado'] = true;
			$_SESSION['nombre'] = $datosUsuario['nombre'];
			$_SESSION['id_usuario'] = $datosUsuario['usuario_id'];
			$_SESSION['categoria'] = $datosUsuario['categoria_id'];
			$_SESSION['es_premium'] = $datosUsuario['is_premium'];

			if ($_SESSION['categoria'] == 1) {
				// Si el usuario es admin
				header("Location: ../admin/administrador.php");
			} else {
				// Si es un usuario normal
				header("Location: ../index.php"); //
			}
			exit();
			
		} else {
			$msj = "Contraseña mal ingresada, pruebe nuevamente";
		}

	} else {
		$msj = "No es un usuario registrado";
	}
	mysqli_close($conexion);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="../static/css/form.css">
	<link href="https://fonts.googleapis.com/css2?family=Bakbak+One&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
		<form action='' method="post" autocomplete="off">
			<label for="usuario"> Usuario </label>
			<br />
			<input type="text" name="usuario" id="usuario" required />
			<br />
			<label for="contrasenia"> Contraseña </label>
			<br />
			<input type="password" name="contrasenia" id="contrasenia" required />
			<br /><br />

			<input type="submit" class="boton" value="INGRESAR" />
		</form>

		<?php if ($msj != "") { ?>
			<p> <?php echo $msj; ?> </p>
		<?php } ?>
	</div>
	
	<!-- Popperjs -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>