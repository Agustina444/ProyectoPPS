<?php
// Comienza sesión y verifica si el usuario está logueado
require '../lib/esta_logueado.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idProducto = $_POST['idProducto'];

    // Verificamos que el carrito esté inicializado y que el producto exista en el carrito
    if (isset($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $index => $producto) {
            if ($producto['id'] == $idProducto) {
                // Eliminamos el producto del carrito
                unset($_SESSION['carrito'][$index]);
                break;
            }
        }

        // Reindexamos el array del carrito para evitar problemas con los índices
        $_SESSION['carrito'] = array_values($_SESSION['carrito']);
    }

    // Redirigimos de regreso a la página del carrito
    header("Location: ver_carrito.php");
    exit;
}
