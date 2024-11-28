<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../static/css/custom.css">
    <link rel="stylesheet" href="../admin/ver_productos.css">
    <title>Productos</title>
</head>

<body>

<?php
// Conecta a la BD
require '../lib/conexion_bd.php';
// Comienza sesión y verifica si el usuario está logueado
require '../lib/esta_logueado.php';

if ($_SESSION['categoria'] != 1) {
    // Si no es administrador, lo redirigimos a una página de error o al inicio
    header("Location: error_page.php");
    exit();
}

$sql = "SELECT p.*, c.nombre AS categoria_nombre FROM productos p JOIN categorias c ON p.categoria_id = c.id";
$result = mysqli_query($conexion, $sql);

include "sidebar.php"; // Incluimos el sidebar
?>

<div class="content-wrapper" style="margin-left: 270px">
    <h1 class="text-center mb-4">Nuestros Productos</h1>
    <a href="insertar_producto.php" class="btn btn-success mb-4">Insertar Nuevo Producto</a>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <div class="row">
            <?php while ($producto = mysqli_fetch_assoc($result)): ?>
                <div class="col-md-4 mb-4 d-flex align-items-stretch">
                    <div class="card border-0">
                        <div>
                            <img src="<?= htmlspecialchars($producto['imagen_url']) ?>" 
                                 class="card-img-top" 
                                 alt="<?= htmlspecialchars($producto['nombre']) ?>" 
                                 >
                        </div>
                        <div class="card-body">
                            <h5 class="card-title mb-3">
                                <?= htmlspecialchars($producto['nombre']) ?>
                            </h5>
                            <p class="card-text" s>
                                <?= htmlspecialchars($producto['descripcion']) ?>
                            </p>
                            <p class="card-text">
                                $<?= number_format($producto['precio'], 2) ?>
                            </p>
                        </div>
                        <div class="card-footer d-flex alig-items-center justify-conter-center">
                            <a href="update_producto.php?id=<?= $producto['id'] ?>" 
                               class="btn btn-primary "> 

                                Modificar
                            </a>
                            <a href="#" onclick="confirmDelete(<?= $producto['id'] ?>)" 
                               class="btn btn-danger btn-sm eliminar"  >
                              
                                Eliminar
                            </a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <div class="container mt-5">
            <h1 class="text-center">No hay productos disponibles.</h1>
        </div>
    <?php endif; ?>
</div>

<?php
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

<script>
    const currentLocation = location.href;
    const sidebarLinks = document.querySelectorAll('.sidebar-link');
    const sidebarLenght = sidebarLinks.length;
    for(let i = 0; i < sidebarLenght; i++){
        if(sidebarLinks[i].href === currentLocation){
            sidebarLinks[i].className = "nav-link sidebar-link sidebar-link-active"
        }
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
