<?php 
// Comienza sesión y verifica si el usuario está logueado
require '../lib/esta_logueado.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Bakbak+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="productos.css">
    <title>Productos</title>
</head>

<body>
<header>
<link rel="stylesheet" href="../static/css/barra_nav.css">
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="../index.php">LEMA Fit</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav d-flex align-items-center ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">Inicio</a>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <a href="ver_carrito.php">
                        <i class="fas fa-shopping-cart"></i> Carrito
                        <span>(<?php echo isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0; ?>)</span>
                    </a>
                </li>
                <?php if (isset($_SESSION['logueado'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger ml-5" href="../lib/cerrar_sesion.php">Cerrar Sesión</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../usuario/login.php">Iniciar Sesión</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>

</header>
<?php 
require '../lib/esta_logueado.php';
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
        echo '<div class="col-md-3 mb-3 d-flex align-items-stretch">';
        echo '<div class="card">';
        echo '<div class="card-img-container">';
        echo '<img src="' . $producto['imagen_url'] . '" class="card-img-top producto-nombre" alt="' . $producto['nombre'] . '">';
        echo '</div>';
        echo '<div class="card-body d-flex flex-column">';
        echo '<h5 class="card-title mb-3">' . htmlspecialchars($producto['nombre']) . '</h5>';
        echo '<p class="card-text text-muted flex-grow-1">' . htmlspecialchars($producto['descripcion']) . '</p>';
        echo '<p class="card-text categoria"><small class="text-muted categoria">Categoría: ' . htmlspecialchars($producto['categoria_nombre']) . '</small></p>';
        echo '<p class="card-text text-price fw-bold ">$' . number_format($producto['precio'], 2) . '</p>';
        
        echo '</div>';

        // Formulario para agregar al carrito
        echo '<div class="card-footer bg-transparent border-top-0 text-center mt-3">';
        echo '<form action="agregar_carrito.php" method="POST">';
        echo '<input type="hidden" name="idProducto" value="' . $producto['id'] . '">';
        echo '<input type="hidden" name="nombre" value="' . htmlspecialchars($producto['nombre']) . '">';
        echo '<input type="hidden" name="descripcion" value="' . htmlspecialchars($producto['descripcion']) . '">';
        echo '<input type="number" class="cantidad" name="cantidad" value="1" min="1" class="form-control mb-2" style="width: 50px;;">';
        echo '<input type="hidden" class="precio" name="precio" value="' . $producto['precio'] . '">';
        echo '<button type="submit" class="btn btn-danger compra btn-sm">Agregar al Carrito</button>';
        echo '</form>';
        echo '</div>';
        echo '</div>'; 
        echo '</div>'; 
    }

    echo '</div>'; 
    echo '</div>'; 
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
    <!-- Mercado pago -->
    <script src="https://sdk.mercadopago.com/js/v2"></script>

</body>
</html>