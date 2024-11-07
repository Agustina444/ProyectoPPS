<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Bakbak+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="/static/css/custom.css">
    <link rel="stylesheet" href="/static/css/productos.css">
    <title>Productos</title>
</head>

<body>

<?php

// Conecta a la BD
require '../lib/conexion_bd.php';
// Comienza sesión y verifica si el usuario está logueado
require '../lib/esta_logueado.php';

$sql = "SELECT p.*, c.nombre AS categoria_nombre FROM productos p JOIN categorias c ON p.categoria_id = c.id";
$result = mysqli_query($conexion, $sql);

include "sidebar.php"; // Incluimos el sidebar

// Ajuste para que el contenido no se solape con el sidebar//
echo '<div class="content-wrapper" style="margin-left: 270px">'; // Margen izquierdo para compensar el sidebar

if (mysqli_num_rows($result) > 0) {
    echo '<h1 class="text-center mb-4">Nuestros Productos</h1>';
    echo '<a href="insertar_producto.php" class="btn btn-success mb-4">Insertar Nuevo Producto</a>';
    echo '<div class="row">';

    while ($producto = mysqli_fetch_assoc($result)) {
        echo '<div class="col-md-4 mb-4 d-flex align-items-stretch">';
        echo '<div class="card border-0 h-100" style="background-color: #f8f9fa; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">'; // Tarjeta con sombra y bordes redondeados
        echo '<div style="width: 100%; height: 100px; overflow: hidden;">';
        echo '<img src="/static/' . $producto['imagen_url'] . '" class="card-img-top" alt="' . $producto['nombre'] . '" style="width: 100%; height: 100%; object-fit: contain;">'; // Imagen ajustada para llenar el contenedor
        echo '</div>';
        echo '<div class="card-body d-flex flex-column">';
        echo '<h5 class="card-title mb-3" style="font-weight: 700; color: #333;">' . htmlspecialchars($producto['nombre']) . '</h5>';
        echo '<p class="card-text text-muted flex-grow-1" style="font-size: 0.9rem;">' . htmlspecialchars($producto['descripcion']) . '</p>';
        echo '<p class="card-text text-price fw-bold mt-2" style="color: #e63946; font-size: 1.1rem;">$' . number_format($producto['precio'], 2) . '</p>';
        echo '</div>';
        echo '<div class="card-footer bg-transparent border-top-0 text-center mt-3">';

        // Botones de Modificar y Eliminar
        echo '<a href="update_producto.php?id=' . $producto['id'] . '" class="btn btn-primary btn-sm" style="width: 100%; font-weight: bold; border-radius: 20px; padding: 10px; margin-bottom: 5px; background-color: #007bff; border: none;">Modificar</a>';
        echo '<a href="#" onclick="confirmDelete(' . $producto['id'] . ')" class="btn btn-danger btn-sm" style="width: 100%; font-weight: bold; border-radius: 20px; padding: 10px; background-color: #dc3545; border: none;">Eliminar</a>';

        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';
} else {
    echo '<div class="container mt-5">';
    echo '<h1 class="text-center">No hay productos disponibles.</h1>';
    echo '</div>';
}

echo '</div>'; // Cerrar content-wrapper
// Cerrar conexión
mysqli_close($conexion);
?>

<script>
function confirmDelete(productId) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "No podrás deshacer esta acción",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'delete_producto.php?id=' + productId;
        }
    })
}
</script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<!-- Incluir SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>
