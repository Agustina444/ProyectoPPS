<?php
session_start();

$conexion = mysqli_connect("localhost", "root", "", "proyecto");

if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Verificar si el usuario está logueado
if (!isset($_SESSION['logueado'])) {
    header("Location: login.php"); // Redirigir a la página de inicio de sesión si no está logueado
    exit();
}

// Obtener el ID del usuario
$usuario_id = $_SESSION['id_usuario'];

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
    <title>Mis Reservas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Mis Reservas</h2>
        
        <?php if (mysqli_num_rows($result) > 0) { ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Clase</th>
                        <th>Horario</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($reserva = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $reserva['nombre']; ?></td>
                            <td><?php echo $reserva['horario']; ?></td>
                            <td>
                                <a href="cancelar_reserva.php?clase_id=<?php echo $reserva['clase_id']; ?>" class="btn btn-danger btn-sm">Cancelar</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>No tienes reservas.</p>
        <?php } ?>
        
    </div>
</body>
</html>

<?php
mysqli_close($conexion);
?>
