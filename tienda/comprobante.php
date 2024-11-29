<?php
    // Timezone argentina
    date_default_timezone_set('America/Argentina/Buenos_Aires');

    // Si viene desde la tienda, vacia el carrito
    if (isset($_GET['compra']) && $_GET['compra'] == 1) {
        $_SESSION['carrito'] = [];
    }
?>

<?php
session_start(); // Inicia la sesión para acceder a $_SESSION

// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "proyecto");

// Verifica la conexión
if (!$conexion) {
    die("Error en la conexión a la base de datos: " . mysqli_connect_error());
}

// Verifica si el usuario está logueado
if (isset($_SESSION['id_usuario'])) {
    // Obtiene el ID del usuario de la sesión
    $usuario_id = $_SESSION['id_usuario'];
    
    // Consulta SQL para actualizar el campo 'es_premium'
    $sql = "UPDATE usuarios SET es_premium = 1 WHERE usuario_id = $usuario_id";
    
    // Ejecutar la consulta
    if (mysqli_query($conexion, $sql)) {
        echo "El usuario ha sido actualizado a Premium con éxito.";
        $_SESSION['es_premium'] = 1;
    } else {
        echo "Error al actualizar el usuario: " . mysqli_error($conexion);
    }
} else {
    echo "No hay usuario en la sesión.";
}


// Cierra la conexión
mysqli_close($conexion);
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../static/css/form.css">
    <link rel="stylesheet" href="../static/css/comprobante.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Comprobante de pago</title>
</head>

<body>

<!-- Barra de navegacion -->
<?php include '../lib/barra_nav.php'; ?>

<div class="contenedor">
    <!-- Recibo -->
    <div class="payment-receipt">
        <h1 class="success-message">¡Pago Exitoso!</h1>
        <div class="receipt">
            <h2>Comprobante de Pago</h2>
            <p><strong>Usuario:</strong> <?= $_GET['usuario']; ?></p>
            <p><strong>Nombre del Producto:</strong> <?= $_GET['nombre']; ?></p>
            <p><strong>Descripción:</strong> <?= $_GET['descripcion']; ?></p>
            <p><strong>Precio:</strong> <?= $_GET['precio']; ?></p>
            <p><strong>Cantidad:</strong> <?= $_GET['cantidad']; ?></p>
            <p><strong>ID de Transacción:</strong> <?= $_GET['payment_id']; ?></p>
            <p><strong>Estatus del Pago:</strong> Aprobado</p>
            <p><strong>Fecha:</strong> <?php echo date("d/m/Y H:i"); ?></p>
        </div>
    </div>
    <?php if (isset($_GET['compra']) && $_GET['compra']) { ?>
        <!-- Boton para volver a la tienda -->
        <a id="btn-clases" class="btn" href="/ProyectoPPS/tienda/productos.php">Volver a la tienda</a>
    <?php } else { ?>
        <!-- Boton de reservar clases -->
        <a id="btn-clases" class="btn" href="/ProyectoPPS/clases/lista.php">Comenzá a reservar tus clases!</a>
    <?php } ?>
</div>

<!-- Popperjs -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
