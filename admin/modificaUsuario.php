<?php
// Conecta a la BD
require '../lib/conexion_bd.php';
// Comienza sesión y verifica si el usuario está logueado
require '../lib/esta_logueado.php';

if ( $_SESSION['categoria'] != 1) {
    // Si no es administrador, lo redirigimos a una página de error o al inicio
    header("Location: error_page.php");
    exit();
  }

if (isset($_GET['usuarioModificado'])) {
	$consulta = mysqli_query($conexion,"SELECT *
											FROM usuarios
											WHERE usuario_id = ".$_GET['usuarioModificado']);
	$datosUsuario = mysqli_fetch_array($consulta);
}

// Procesar el formulario cuando se hace submit
if (isset($_GET['idUsuario'])) {
	$nombre = $_GET['nombre'];
	$apellido = $_GET['apellido'];
	$email = $_GET['email'];
	$categoria = $_GET['categoria'];
	$fechaInicio = $_GET['fecha_inicio'];  // Fecha de inicio seleccionada por el usuario
	$esPremium = isset($_GET['es_premium']) ? 1 : 0;  // Obtiene el valor de es_premium, 1 si está marcado, 0 si no
    $_SESSION['es_premium'] = $esPremium;
    
	// Calcula la fecha de fin sumando 30 días a la fecha de inicio
	$fechaFin = date('Y-m-d', strtotime($fechaInicio . ' + 30 days'));

	// Actualizar los datos del usuario en la base de datos
	$consulta = mysqli_query($conexion, "UPDATE usuarios
											SET nombre = '$nombre', apellido = '$apellido', email = '$email', categoria_id = '$categoria', 
												fecha_inicio = '$fechaInicio', fecha_fin = '$fechaFin', es_premium = '$esPremium'
											WHERE usuario_id = " . $_GET['idUsuario']);
	header("Location: usuarios.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Bakbak+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="modificaUsuario.css">
    <title>Modificación Usuario</title>
</head>

<body class="layout-fixed">
    <div class="wrapper">
        <!-- Barra de nav y sidebar -->
        <?php include "sidebar.php"; ?>

        <!-- Contenido -->
        <div class="content-wrapper">
            <section class="container-fluid py-5">
                <h1 class="font-weight-bold pb-5 text-center">Modificar usuario</h1>
                <div class="contenedor mx-auto">
                    <form action="" method="get" autocomplete="off">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $datosUsuario['nombre'] ?>" required />
                        </div>
                        <div class="mb-3">
                            <label for="apellido" class="form-label">Apellido</label>
                            <input type="text" name="apellido" id="apellido" class="form-control" value="<?php echo $datosUsuario['apellido'] ?>" required />
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="<?php echo $datosUsuario['email'] ?>" required />
                        </div>
                        <div class="mb-3">
                            <label for="categoria" class="form-label">Categoría</label>
                            <select name="categoria" class="form-control">
                                <option value="1" <?php echo $datosUsuario['categoria_id'] == 1 ? 'selected' : ''; ?>>Administrador</option>
                                <option value="2" <?php echo $datosUsuario['categoria_id'] == 2 ? 'selected' : ''; ?>>Suscriptor</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" value="<?php echo $datosUsuario['fecha_inicio'] ?>" required />
                        </div>

                        <!-- Campo para modificar el estado de es_premium -->
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="es_premium" id="es_premium" class="form-check-input" <?php echo $datosUsuario['es_premium'] == 1 ? 'checked' : ''; ?>>
                            <label class="form-check-label checkbox-label" for="es_premium">Es Premium</label>
                        </div>

                        <!-- No mostrar el campo de fecha_fin -->
                        <input type="hidden" name="idUsuario" value="<?php echo $datosUsuario['usuario_id'] ?>" />
                        <button type="submit" class="btn btn-primary mt-3">CONTINUAR</button>
                    </form>

                </div>
            </section>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>


