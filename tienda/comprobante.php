<?php
    // Timezone argentina
    date_default_timezone_set('America/Argentina/Buenos_Aires');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <!-- Boton de reservar clases -->
    <a id="btn-clases" class="btn" href="/ProyectoPPS/clases/lista.php">Comenzá a reservar tus clases!</a>
</div>

<!-- Popperjs -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
