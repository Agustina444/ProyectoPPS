<?php
// Comienza sesión y verifica si el usuario está logueado
require '../lib/esta_logueado.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idProducto = $_POST['idProducto'];
    $nuevaCantidad = (int)$_POST['cantidad'];

    // Verificamos que la nueva cantidad sea válida
    if ($nuevaCantidad > 0 && isset($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as &$producto) {
            if ($producto['id'] == $idProducto) {
                // Actualizamos la cantidad
                $producto['cantidad'] = $nuevaCantidad;
                break;
            }
        }
    }

    // Redirigimos de regreso a la página del carrito
    header("Location: ver_carrito.php");
    exit;
}
