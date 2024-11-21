<?php
// Verifica que el usuario este logueado
require '../lib/esta_logueado.php';
// Conecta a la BD
require '../lib/conexion_bd.php';

// Si se envio el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Actualiza los datos del usuario
	$usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
	$nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
	$apellido = mysqli_real_escape_string($conexion, $_POST['apellido']);
	$email = mysqli_real_escape_string($conexion, $_POST['email']);

	// Guarda la consulta sql para modificar los datos
	$sql = "UPDATE usuarios 
					SET usuario='$usuario',
							nombre='$nombre',
							apellido='$apellido',
							email='$email'";

	// Si el usuario modifico la contraseña, la agrega a la consulta
	if (isset($_POST['contra']) && !empty($_POST['contra'])) {
		$contra = password_hash(mysqli_real_escape_string($conexion, $_POST['contra']), PASSWORD_DEFAULT);
		$sql .= ", contrasenia='$contra'";
	}

	// Completa la consulta
	$sql .= " WHERE usuario_id='{$_SESSION['id_usuario']}'";

	// Realiza los cambios
	mysqli_query($conexion, $sql);
	mysqli_close($conexion);
	header("Location: ../index.php");
	exit;
}

// Busca al usuario en la BD
$resultado = mysqli_query($conexion, "
	SELECT *
	FROM usuarios 
	WHERE usuario_id = '" . $_SESSION['id_usuario'] . "'
");

// Almacena los datos de usuario en una variable
if (!$resultado) {
    echo 'Error en la consulta: ' . mysqli_error($conexion);
} elseif (mysqli_num_rows($resultado) == 0) {
    echo 'Usuario no encontrado';
} else {
    $usuario = mysqli_fetch_assoc($resultado);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
  <title>Perfil</title>
</head>

<body>

<header>
    <?php include '../lib/barra_nav.php'; ?>
</header>

<br>
<!-- Formulario para editar el perfil -->
<main class="bg-light col-6 p-3 m-4 mx-auto">
    <h4 class="text-center">Editar perfil</h4>
    <hr>
    <form action="" method="post" autocomplete="off">
        <div class="px-5">
            <div class="form-group">
                <label for="usuario">Usuario</label>
                <input type="text" class="form-control" name="usuario" id="usuario" value="<?= $usuario['usuario']; ?>" />
            </div>
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="nombre" value="<?= $usuario['nombre']; ?>" />
            </div>
            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" class="form-control" name="apellido" id="apellido" value="<?= $usuario['apellido']; ?>" />
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="email" id="email" value="<?= $usuario['email']; ?>" />
            </div>
            <div class="form-group">
                <label for="contra">Contraseña</label>
                <input type="password" class="form-control" name="contra" id="contra" />
            </div>
        </div>
        <br>
        <div class="form-group text-right mr-5">
            <input type="submit" class="btn btn-primary" value="Guardar cambios" />
        </div>
    </form>
</main>

<?php mysqli_close($conexion); ?>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>