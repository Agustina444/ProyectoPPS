



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobante de Pago</title>
    <link rel="stylesheet" href="styles.css">
</head>

<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    text-align: center;
}

.ticket {
    background-color: #fff;
    width: 350px;
    border: 2px dashed #333;
    padding: 20px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}

.ticket h1 {
    font-size: 24px;
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

.ticket h2 {
    font-size: 25px;
    text-align: center;
    text-transform: uppercase;
    color: white;
    margin-bottom: 10px;
    background-color: #00C700;
}

.ticket h3 {
    font-size: 18px;
    margin-top: 15px;
    color: #555;
}

.ticket p, .ticket span {
    font-size: 14px;
    line-height: 1.6;
    color: #333;
}

.ticket strong {
    color: #000;
}

.ticket p:last-child {
    margin-top: 10px;
    text-align: center;
    font-size: 16px;
    color: #e8491d;
    font-weight: bold;
}

</style>
<body>
    <div class="ticket">
        <?php
        session_start();

        // Obtener datos de la sesión
        $usuario = $_SESSION['nombre'] ?? null;

        // Obtener datos de la URL
        $titulo = $_GET['Titulo'] ?? null;
        $cantidad = $_GET['Cantidad'] ?? null;
        $precio = $_GET['Precio'] ?? null;
        $collection_id = $_GET['collection_id'] ?? null;
        $collection_status = $_GET['collection_status'] ?? null;
        $payment_id = $_GET['payment_id'] ?? null;
        $status = $_GET['status'] ?? null;
        $external_reference = $_GET['external_reference'] ?? null;
        $payment_type = $_GET['payment_type'] ?? null;
        $merchant_order_id = $_GET['merchant_order_id'] ?? null;
        $preference_id = $_GET['preference_id'] ?? null;
        $site_id = $_GET['site_id'] ?? null;
        $processing_mode = $_GET['processing_mode'] ?? null;
        $merchant_account_id = $_GET['merchant_account_id'] ?? null;

        echo "<h1>Comprobante de Pago</h1>";
        echo "<h3>Datos del Pago</h3>";
        echo "Collection ID: " . htmlspecialchars($collection_id) . "<br>";
        echo "Collection Status: " . htmlspecialchars($collection_status) . "<br>";
        echo "Payment ID: " . htmlspecialchars($payment_id) . "<br>";
        echo "Status: " . htmlspecialchars($status) . "<br>";
        echo "External Reference: " . htmlspecialchars($external_reference) . "<br>";
        echo "Payment Type: " . htmlspecialchars($payment_type) . "<br>";
        echo "Merchant Order ID: " . htmlspecialchars($merchant_order_id) . "<br>";
        echo "Preference ID: " . htmlspecialchars($preference_id) . "<br>";
        echo "Site ID: " . htmlspecialchars($site_id) . "<br>";
        echo "Processing Mode: " . htmlspecialchars($processing_mode) . "<br>";
        echo "Merchant Account ID: " . htmlspecialchars($merchant_account_id) . "<br>";

        echo "<h3>Datos del Usuario</h3>";
        echo "Usuario: " . htmlspecialchars($usuario) . "<br>";

        echo "<h3>Datos del Producto</h3>";
        echo "Título: " . htmlspecialchars($titulo) . "<br>";
        echo "Cantidad: " . htmlspecialchars($cantidad) . "<br>";
        echo "Precio: $" . htmlspecialchars($precio) . "<br>";

        echo "<h2>Pago exitoso</h2>";
        ?>
    </div>
</body>
</html>
