<?php

// Conecta a la BD
require '../lib/conexion_bd.php';
// Comienza sesión y verifica si el usuario está logueado
require '../lib/esta_logueado.php';

// Obtener el ID del usuario
$usuario_id = $_SESSION['id_usuario'];

// Eliminar reserva si el usuario toco el boton
if (isset($_POST['clase_id'])) {
    $id = $_POST['clase_id'];
    $sql = "DELETE FROM reservas WHERE clase_id = '$id'";
    mysqli_query($conexion, $sql);
}

// Consultar las reservas del usuario
$sql = "
    SELECT reservas.clase_id, clases.nombre, clases.horario 
    FROM reservas 
    JOIN clases ON reservas.clase_id = clases.clase_id 
    WHERE reservas.usuario_id = '$usuario_id'
";
$result = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="lista.css">
    <title>Mis Reservas</title>
</head>
<body>

<!-- Barra de nav -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="#">LEMA Fit</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="lista.php">Lista de clases</a>
                </li>
                <?php if (isset($_SESSION['logueado'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger ml-5" href="../lib/cerrar_sesion.php">Cerrar Sesión</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../usuario/login.php">Iniciar Sesión</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <h2 class="mb-4">Mis Reservas</h2>
    <?php if (mysqli_num_rows($result) > 0) { ?>
        <table class="table table-bordered text-center">
            <thead class= "table-dark">
                <tr>
                    <th>Clase</th>
                    <th>Horario</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($reserva = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $reserva['nombre']; ?></td>
                        <td><?php echo $reserva['horario']; ?></td>
                        <td>
                            <form action="" method="POST" onsubmit="return confirm('¿Estas seguro de cancelar la reserva?');">
                                <input type="hidden" name="clase_id" value="<?= $reserva['clase_id']; ?>">
                                <button type="submit" class="btn btn-danger">Cancelar</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>No tienes reservas.</p>
    <?php } ?>
</div>

<!-- Bootstrap y JQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
<?php mysqli_close($conexion); ?>