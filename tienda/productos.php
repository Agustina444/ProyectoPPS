<!DOCTYPE html>
 


<?php 



?>



  
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Bakbak+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/static/css/tienda.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="productos.css">
    


    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <title>Productos</title>
</head>

<body>
    <header>
    <?php session_start(); ?>
<link rel="stylesheet" href="/static/css/barra_nav.css">
<nav>
    <ul>
        <li><a href="/index.php">INICIO</a></li>
        <li><a href="/sede.php">SEDE</a></li>
        <li><a href="/contacto.php">CONTACTO</a></li>
        <li><a href="/clases/lista.php">CLASES</a></li>
        <li>
    <a href="ver_carrito.php">
        <i class="fas fa-shopping-cart"></i> Carrito
        <span>(<?php echo isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0; ?>)</span>
    </a>
</li>
        <?php if (isset($_SESSION['logueado']) && $_SESSION['logueado']) { ?>
            <?php if ($_SESSION['categoria'] == 1) { // es admin ?>
                <li><a href="/admin/administrador.php">ADMIN</a></li>
            <?php } ?>
            <li><a href="/lib/cerrar_sesion.php">CERRAR SESIÓN</a></li>
        <?php } else { ?>
            <li><a href="/usuario/login.php">INGRESAR</a></li>
            <li><a href="/usuario/registro.php">REGISTRO</a></li>
        <?php } ?>
    </ul>
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
        echo '<div class="col-md-4 mb-4 d-flex align-items-stretch">';
        echo '<div class="card">';
        echo '<div class="card-img-container">';
        echo '<img src="/static/' . $producto['imagen_url'] . '" class="card-img-top" alt="' . $producto['nombre'] . '">';
        echo '</div>';
        echo '<div class="card-body d-flex flex-column">';
        echo '<h5 class="card-title mb-3">' . htmlspecialchars($producto['nombre']) . '</h5>';
        echo '<p class="card-text text-muted flex-grow-1">' . htmlspecialchars($producto['descripcion']) . '</p>';
        echo '<p class="card-text text-price fw-bold mt-2">$' . number_format($producto['precio'], 2) . '</p>';
        echo '<p class="card-text mt-auto"><small class="text-muted">Categoría: ' . htmlspecialchars($producto['categoria_nombre']) . '</small></p>';
        echo '</div>';

        // Formulario para agregar al carrito
        echo '<div class="card-footer bg-transparent border-top-0 text-center mt-3">';
        echo '<form action="agregar_carrito.php" method="POST">';
        echo '<input type="hidden" name="idProducto" value="' . $producto['id'] . '">';
        echo '<input type="hidden" name="nombre" value="' . htmlspecialchars($producto['nombre']) . '">';
        echo '<input type="hidden" name="precio" value="' . $producto['precio'] . '">';
        echo '<input type="number" name="cantidad" value="1" min="1" class="form-control mb-2" style="width: 70px; margin: 0 auto;">';
        echo '<button type="submit" class="btn btn-danger btn-sm">Agregar al Carrito</button>';
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


<script>

   
</script>

</body>
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</html>

