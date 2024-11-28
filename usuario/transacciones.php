<?php 
// Verifica que el usuario este logueado
require '../lib/esta_logueado.php';
// Conecta a la BD
require '../lib/conexion_bd.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../static/css/transacciones.css">
    <title>Historial de compras</title>
</head>

<body> 
    <header>
        <?php include '../lib/barra_nav.php'; ?>
    </header>

    <div class="container mt-5">
        <h2 class="text-center fw-bold mb-4">Historial de Compras</h2>

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
                                <td><?= htmlspecialchars($producto['nombre']); ?></td>
                                <td><?= $producto['cantidad']; ?></td>
                                <td>$<?= number_format($producto['precio'], 2); ?></td>
                                <td>$<?= number_format($producto['precio'] * $producto['cantidad'], 2); ?></td>
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
                <strong>No se ha realizado ninguna compra.</strong>
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

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Mercado pago -->
    <script src="https://sdk.mercadopago.com/js/v2"></script>
</body>
</html>
