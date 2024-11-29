<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesar Pago</title>

<style>body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    flex-direction: column;  /* Asegura que los elementos se apilen verticalmente */
}

.payment-receipt {
    background-color: #ffffff;
    border: 1px solid #ddd;
    border-radius: 10px;
    width: 400px;
    padding: 20px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    margin-bottom: 20px;  /* Separación entre el comprobante y el mensaje */
}

.success-message {
    color: #28a745;
    font-size: 24px;
    margin-bottom: 20px;
}

.receipt {
    background-color: #f9f9f9;
    border: 1px solid #ccc;
    border-radius: 10px;
    padding: 15px;
    text-align: left;
}

.receipt h2 {
    font-size: 20px;
    color: #333;
    margin-bottom: 15px;
    text-align: center;
}

.receipt p {
    margin: 8px 0;
    font-size: 16px;
    color: #555;
}

.receipt p strong {
    color: #333;
}

.contact-message {
    background-color: #81C784;  /* Fondo rojo claro */
    color: #2C6B3F;  /* Texto rojo oscuro */
    border: 1px solid #f5c6cb;  /* Borde delgado en rojo claro */
    border-radius: 10px;  /* Bordes redondeados */
    padding: 20px;
    font-size: 18px;
    font-family: Arial, sans-serif;
    text-align: center;
    width: 80%;
    max-width: 600px;
    margin: 20px auto;
}

.contact-message p {
    margin: 0;
    font-weight: bold;
}



/* Opcional: Estilo para imprimir */
@media print {
    body {
        background-color: #fff;
        margin: 0;
    }
    .payment-receipt {
        border: none;
        box-shadow: none;
        width: 100%;
    }
    .success-message {
        font-size: 20px;
    }
    .receipt {
        border: none;
    }
    
}
</style>

    
</head>
<body>
<div class="payment-receipt">
    <h1 class="success-message">¡Pago Exitoso!</h1>
    <div class="receipt">
        <h2>Comprobante de Pago</h2>
        <p><strong>Usuario:</strong> Lucas</p>
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
