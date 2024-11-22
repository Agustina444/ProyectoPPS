<?php
session_start();

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idProducto = $_POST['idProducto'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];

    // Verifica si el producto ya está en el carrito
    $encontrado = false;
    foreach ($_SESSION['carrito'] as &$producto) {
        if ($producto['id'] == $idProducto) {
            $producto['cantidad'] += $cantidad;
            $encontrado = true;
            break;
        }
    }

    // Si el producto no está en el carrito, agrégalo como un nuevo item
    if (!$encontrado) {
        $_SESSION['carrito'][] = [
            'id' => $idProducto,
            'nombre' => $nombre,
            'precio' => $precio,
            'cantidad' => $cantidad
        ];
    }

    header("Location: productos.php?mensaje=agregado");
    exit;
}
