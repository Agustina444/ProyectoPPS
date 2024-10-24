<?php  
	if(!isset($_SESSION)){ 
        session_start(); 
    } 
    
	$usuario = $_SESSION['id_usuario'];
	
	include("conexion.php");

	?>

	<?php


$conexion = mysqli_connect("localhost", "root", "", "proyecto");

if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Verificar si el usuario está logueado y es un suscriptor
if (!isset($_SESSION['logueado']) || $_SESSION['categoria'] != 2) {
    die("Acceso denegado. Debes estar logueado como suscriptor.");
}

// Obtener clases
$result = mysqli_query($conexion, "SELECT * FROM clases");
$usuario_id = $_SESSION['id_usuario'];
$reservas = [];
$reservas_result = mysqli_query($conexion, "SELECT clase_id FROM reservas WHERE usuario_id = '$usuario_id'");
while ($row = mysqli_fetch_assoc($reservas_result)) {
    $reservas[] = $row['clase_id'];
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservar Clases</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Lutina Gym</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="mis_reservas.php">Mis Reservas</a>
                </li>
                <?php if (isset($_SESSION['logueado'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="salir.php">Cerrar Sesión</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Iniciar Sesión</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Incluye los scripts de Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.11/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <div class="container mt-5">
        <h2>Clases Disponibles</h2>
        <div class="row">

            <?php while ($clase = mysqli_fetch_assoc($result)) { ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="<?php echo $clase['imagen_url']; ?>" class="card-img-top" alt="<?php echo $clase['nombre']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $clase['nombre']; ?></h5>
                            <p class="card-text">Horario: <?php echo $clase['horario']; ?></p>
							<?php if (in_array($clase['clase_id'], $reservas)) { ?>
                                <button class="btn btn-secondary" disabled>Registrado</button>
                            <?php } else { ?>
                                <button class="btn btn-primary" onclick="confirmarReserva(<?php echo $clase['clase_id']; ?>)">Reservar</button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>

    <script>
        function confirmarReserva(claseId) {
            if (confirm("¿Desea confirmar la reserva para esta clase?")) {
                window.location.href = "reservar.php?clase_id=" + claseId;
            }
        }
    </script>
</body>
</html>

<?php
mysqli_close($conexion);
?>

	