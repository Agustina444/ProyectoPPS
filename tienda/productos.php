<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Bakbak+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/static/css/tienda.css">
    <title>Productos</title>
</head>

<body>
    <header>
        <?php include '../lib/barra_nav.php'; ?>
    </header>

<?php session_start();
// Conectar a la base de datos
include '../lib/conexion_bd.php';

// Consulta para obtener productos
$sql = "SELECT p.*, c.nombre AS categoria_nombre FROM productos p JOIN categorias c ON p.categoria_id = c.id";
$result = mysqli_query($conexion, $sql);

if (mysqli_num_rows($result) > 0) {
    echo '<div class="container mt-5">';
    echo '<h1 class="text-center mb-4">Nuestros Productos</h1>';
    echo '<div class="row">';

    while ($producto = mysqli_fetch_assoc($result)) {
        echo '<div class="col-md-4 mb-4 d-flex align-items-stretch">'; // Alineamos las tarjetas para que tengan la misma altura
        echo '<div class="card border-0 h-100" style="background-color: #f8f9fa; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">'; // Tarjeta con sombra y bordes redondeados
        echo '<div style="width: 100%; height: 100px; overflow: hidden;">'; // Contenedor para mantener el tamaño fijo de la imagen
        echo '<img src="/static/' . $producto['imagen_url'] . '" class="card-img-top" alt="' . $producto['nombre'] . '" style="width: 100%; height: 100%; object-fit: contain;">'; // Imagen ajustada para llenar el contenedor
        echo '</div>'; // cerrar contenedor de imagen
        echo '<div class="card-body d-flex flex-column">'; 
        echo '<h5 class="card-title mb-3" style="font-weight: 700; color: #333;">' . htmlspecialchars($producto['nombre']) . '</h5>'; // Título con un estilo fuerte
        echo '<p class="card-text text-muted flex-grow-1" style="font-size: 0.9rem;">' . htmlspecialchars($producto['descripcion']) . '</p>'; // Descripción más compacta
        echo '<p class="card-text text-price fw-bold mt-2" style="color: #e63946; font-size: 1.1rem;">$' . number_format($producto['precio'], 2) . '</p>'; // Precio destacado
        echo '<p class="card-text mt-auto"><small class="text-muted">Categoría: ' . htmlspecialchars($producto['categoria_nombre']) . '</small></p>';
        echo '</div>'; // cerrar card-body
        echo '<div class="card-footer bg-transparent border-top-0 text-center mt-3">'; 
        echo '<button class="btn btn-danger btn-sm" style="width: 100%; font-weight: bold; background-color: #e63946; border: none; border-radius: 20px; padding: 10px; transition: background-color 0.3s;">Comprar Ahora</button>'; // Botón de compra estilo gym
        echo '</div>'; // cerrar card-footer
        echo '</div>'; // cerrar card
        echo '</div>'; // cerrar col-md-4
    }
    
    echo '</div>'; // cerrar row
    
} else {
    echo '<div class="container mt-5">';
    echo '<h1 class="text-center">No hay productos disponibles.</h1>';
    echo '</div>';
}

// Cerrar conexión
mysqli_close($conexion);
?>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

