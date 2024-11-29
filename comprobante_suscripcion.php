<?php
   // Comienza la sesión si no esta creada
    if(!isset($_SESSION)) session_start();

    // Si el usuario no inicio sesión, lo manda al formulario para logearse
    if(!isset($_SESSION['logueado']) || !$_SESSION['logueado']){
        header("Location: usuario/login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="static/css/comprobante.css">
    <title>Comprobante de pago</title>
</head>

<body>
<div class="payment-receipt">
    <h1 class="success-message">¡Pago Exitoso!</h1>
    <div class="receipt">
        <h2>Comprobante de Pago</h2>
        <p><strong>Usuario:</strong> <?= $_SESSION['nombre'] ?></p>
        <p><strong>Nombre del Producto:</strong> Suscripción Mensual</p>
        <p><strong>Descripción:</strong> Acceso completo al gimnasio por un mes</p>
        <p><strong>Precio:</strong> $25,000</p>
        <p><strong>Cantidad:</strong> 1</p>
        <p><strong>ID de Transacción:</strong> 94726414348</p>
        <p><strong>Estatus del Pago:</strong> Aprobado</p>
        <p><strong>Fecha:</strong> <?php echo date("d/m/Y H:i"); ?></p>
    </div>
</div>

<div class="contact-message d-block">
    <p>Pónganse en contacto para habilitar su suscripción</p>
</div>

</body>
</html>
