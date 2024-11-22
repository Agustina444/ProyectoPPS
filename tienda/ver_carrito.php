<?php
session_start();

require __DIR__ . '/vendor/autoload.php';

use MercadoPago\MercadoPagoConfig;
use MercadoPago\Resources\Preference;
use MercadoPago\Resources\Preference\Item;
use MercadoPago\Client\Preference\PreferenceClient;




// Verifica si la clase Preference se puede cargar
if (!class_exists('MercadoPago\Resources\Preference')) {
    die("La clase Preference NO se pudo cargar. Verifica la instalación del SDK de Mercado Pago.");
}

// Configura el Access Token
MercadoPagoConfig::setAccessToken("APP_USR-679245900783224-102721-0126dca4d0d7932957039e8934670eef-2063607924");

// Inicializa el carrito
$carrito = $_SESSION['carrito'] ?? [];
$total = 0;

if (!empty($carrito)) {
    // Inicializa los items para la preferencia
    $items = [];
    foreach ($carrito as $producto) {
        $item = new Item();
        $item->title = htmlspecialchars($producto['nombre']); // Sanitiza el nombre del producto
        $item->quantity = $producto['cantidad'];
        $item->unit_price = (float)$producto['precio']; // Asegúrate de que el precio sea un número flotante

        $items[] = $item; // Agrega el producto al array de items
        $total += $item->unit_price * $item->quantity; // Calcula el total
    }
    
    $preference = new Preference();
    $preference->items = $items; 
    
    // Asigna los items a la preferencia
    $preference->back_urls = [
        "success" => "https://localhost/tienda/captura.php", // URL para el éxito
        "failure" => "https://localhost/tienda/fallo.php", // URL para fallo
         // URL para pendiente
    ];
    
    
    $client = new PreferenceClient();
    $createdPreference = $client->create([
        "items" => $preference->items,
        "back_urls" => [
            "success" => "https://localhost/tienda/captura.php",
            "failure" => "https://localhost/tienda/fallo.php",
            
        ],
        "notification_url" => "https://ba89-2802-8010-8435-be00-4ee-3bc0-f8a2-dcc1.ngrok-free.app/tienda/notificaciones",
    ]);
    
    $preference->auto_return = "approved";
    $preference->binary_mode = "true";
    // Accede al ID de la preferencia
    $preferenceId = $createdPreference->id; // Aquí tienes el ID de la preferencia
    echo "ID de la preferencia: " .$preferenceId;
    
   
}
else{
    echo "JAJAA";
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://sdk.mercadopago.com/js/v2"></script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Carrito de Compras</h2>

        <?php if (!empty($carrito)) : ?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Subtotal</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($carrito as $producto) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                                <td><?php echo $producto['cantidad']; ?></td>
                                <td>$<?php echo number_format($producto['precio'], 2); ?></td>
                                <td>$<?php echo number_format($producto['precio'] * $producto['cantidad'], 2); ?></td>
                                <td>
                                    <form action="actualizar_carrito.php" method="POST" class="d-inline">
                                        <input type="hidden" name="idProducto" value="<?php echo $producto['id']; ?>">
                                        <input type="number" name="cantidad" value="<?php echo $producto['cantidad']; ?>" min="1" class="form-control d-inline" style="width: 70px;">
                                        <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                                    </form>
                                    <form action="eliminar_carrito.php" method="POST" class="d-inline">
                                        <input type="hidden" name="idProducto" value="<?php echo $producto['id']; ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            <?php $total += $producto['precio'] * $producto['cantidad']; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="text-right mt-3 w wallet_container ">
                <h4>Total: $<?php echo number_format($total, 2); ?></h4>
                <a href="#" class=" btn-lg mt-3 "></a>
            </div>
        <?php else : ?>
            <div class="alert alert-info text-center">
                <strong>El carrito está vacío.</strong>
            </div>
        <?php endif; ?>
    </div>

    

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const mp = new MercadoPago('APP_USR-3b322bd8-f5d7-4466-8d8a-e3162704777b', {
            locale: 'es-AR'
        });
        
        const preferencia = <?php echo  json_encode($createdPreference->id) ?>;

        if (preferencia) {
             // Debugging output
            mp.checkout({
                preference: {
                   id:'<?php echo $createdPreference->id ?>',
                }, // Corregido: se eliminó "echo" innecesario
                render: {
                    container:'.wallet_container',
                    label:'Pagar con MP'
                }
            });
        } else {
            console.error("La preferencia de pago no está definida.");
        }

        // Check if the wallet_container exists
       
    });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>
