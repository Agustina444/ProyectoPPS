<?php
// Conecta a la BD
require '../lib/conexion_bd.php';
// Comienza sesión y verifica si el usuario está logueado
require '../lib/esta_logueado.php';

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

	// Calcula la fecha de fin sumando 30 días a la fecha de inicio
	$fechaFin = date('Y-m-d', strtotime($fechaInicio . ' + 30 days'));

	// Actualizar los datos del usuario en la base de datos
	$consulta = mysqli_query($conexion, "UPDATE usuarios
											SET nombre = '$nombre', apellido = '$apellido', email = '$email', categoria_id = '$categoria', 
												fecha_inicio = '$fechaInicio', fecha_fin = '$fechaFin', es_premium = '$esPremium'
											WHERE usuario_id = " . $_GET['idUsuario']);
	header("Location: administrador.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Incluir Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bakbak+One&display=swap" rel="stylesheet">
    <style>
        /* Estilo personalizado: Naranja y negro */
        body {
            background-color: #F1F1F1; /* Fondo oscuro */
            color: #fff; /* Texto blanco */
        }

        .navbar {
            background-color: #000000; /* Naranja */
        }

        .contenedor {
            background-color:  #8E8E8E; /* Fondo oscuro para el contenedor */
            padding: 30px;
            border-radius: 8px;
			width: 800px;
			margin-left: 200px;
        }

        .form-label {
            color: #ff6f00; /* Naranja para las etiquetas */
			font-weight: bold;
        }

        .btn-primary {
            background-color: #ff6f00; /* Naranja para los botones */
            border: none;
        }

        .btn-primary:hover {
            background-color: #e65c00; /* Un naranja más oscuro al pasar el ratón */
        }

        .form-control {
            background-color: #FFFF; /* Fondo oscuro para inputs */
            border: 1px solid #ff6f00; /* Borde naranja */
            color: #000000; /* Texto blanco */
        }

        .form-control:focus {
            border-color: #ff6f00; /* Borde naranja cuando se selecciona */
            box-shadow: 0 0 0 0.25rem rgba(255, 111, 0, 0.5); /* Sombra naranja */
        }

        .checkbox-label {
            color: #ff6f00; /* Naranja para las etiquetas del checkbox */
			font-weight: bold;
        }
    </style>
    <title> Modificación Usuario </title>
</head>
<body>

<header>
    <div class="menu">    
        <nav class="navbar navbar-expand-lg navbar-dark">
            <a class="navbar-brand ml-5 mx-auto" href="#">Modificar usuario</a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="/lib/cerrar_sesion.php">CERRAR SESION</a></li>
                <li class="nav-item"><a class="nav-link" href="/index.php">INICIO</a></li>
            </ul>
        </nav>
    </div>
</header>

<div class="container mt-5">
    <div class="contenedor">
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
</div>

<!-- Incluir Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


