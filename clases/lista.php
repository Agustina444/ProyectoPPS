<?php 
// Comienza la sesión si no esta creada
if(!isset($_SESSION)) session_start(); 

// Conecta a la BD
require '../lib/conexion_bd.php';

$usuario_id = $_SESSION['id_usuario'];

// Realiza la reserva si el usuario toco el boton de reservar
if (isset($_POST['clase_id'])) {
    $clase_id = $_POST['clase_id'];
    $sql = "INSERT INTO reservas (usuario_id, clase_id) VALUES ('$usuario_id', '$clase_id')";
    mysqli_query($conexion, $sql);
}

// Obtener clases
$sql = "SELECT * FROM clases";
$result = mysqli_query($conexion,$sql);
$reservas = [];

// Obtener reservas
$sql = "
    SELECT usuario_id, clase_id
    FROM reservas
    WHERE usuario_id = '$usuario_id'
";
$reservas_result = mysqli_query($conexion, $sql); 
while ($row = mysqli_fetch_assoc($reservas_result)) {
    $reservas[] = $row['clase_id'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
     	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="lista.css">
    <title>Reservar Clases</title>
</head>
<body>

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
                    <a class="nav-link" href="mis_reservas.php">Mis Reservas</a>
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

<?php 
$consulta_premium = "SELECT es_premium FROM usuarios WHERE usuario_id = $usuario_id";
$resultado_premium = mysqli_query($conexion, $consulta_premium);

// Verifica si el usuario es premium
$es_premium = 0; // Por defecto no es premium
if ($fila = mysqli_fetch_assoc($resultado_premium)) {
    $es_premium = $fila['es_premium'];
}

?>

<div class="container mt-4">
    <h2 class="mb-4">Clases Disponibles</h2>
    <div class="row">
        <?php while ($clase = mysqli_fetch_assoc($result)) { ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="<?php echo $clase['imagen_url']; ?>" class="card-img-top" alt="<?php echo $clase['nombre']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $clase['nombre']; ?></h5>
                        <p class="card-text">Lunes a viernes</p>
                        <p class="card-text">Horario: <?php echo $clase['horario']; ?></p>
                        <?php if (in_array($clase['clase_id'], $reservas)) { ?>
                            <button class="btn btn-secondary" disabled>Registrado</button>
                        <?php } else { ?>

                            <?php if ($es_premium == 1) { ?>

                            <form action="" method="POST" onsubmit="return confirm('¿Desea confirmar la reservar para esta clase?');">
                                <input type="hidden" name="clase_id" value="<?= $clase['clase_id']; ?>">
                                <button type="submit" class="btn btn-primary">Reservar</button>
                                <?php } else { ?>
                                    <?php if ($es_premium != 1) { ?>
                                    <a href="../index.php"><button type="disabled" class="btn btn-suscribirse">Hazte Premium!</button></a>
                                    <?php }  ?>
                            </form>
                        <?php } ?>
                        <?php }  ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<br>

<script>
    function confirmarReserva(claseId) {
        if (confirm("¿Desea confirmar la reserva para esta clase?")) {
            window.location.href = "reservar.php?clase_id=" + claseId;
        }
    }
</script>

<!-- Bootstrap y jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php mysqli_close($conexion); ?>
</body>
</html>
