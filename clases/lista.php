<?php 
// Comienza la sesión si no esta creada
if(!isset($_SESSION)) session_start(); 

// Conecta a la BD
require '../lib/conexion_bd.php';

// Obtener clases
$sql = "SELECT * FROM clases";
$result = mysqli_query($conexion,$sql);

$usuario_id = $_SESSION['id_usuario'];
$reservas = [];

// Obtener reservas
$sql = "
    SELECT clase_id
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <title>Reservar Clases</title>
</head>
<body>

<header>
    <?php include '../lib/barra_nav.php'; ?>
</header>

<div class="container mt-5">
    <h2>Clases Disponibles</h2>
    <div class="row">

        <?php while ($clase = mysqli_fetch_assoc($result)) { ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="<?php echo '/static/'.$clase['imagen_url']; ?>" class="card-img-top" alt="<?php echo $clase['nombre']; ?>">
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

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php mysqli_close($conexion); ?>