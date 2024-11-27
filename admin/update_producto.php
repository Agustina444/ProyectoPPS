<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Bakbak+One&display=swap" rel="stylesheet">
	 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <link rel="stylesheet" href="../admin/modificar_producto.css">
   <link rel="stylesheet" href="../static/css/custom.css">
    <title>Document</title>

<?php
// Conecta a la BD
require '../lib/conexion_bd.php';
// Comienza sesión y verifica si el usuario está logueado
require '../lib/esta_logueado.php';

if ( $_SESSION['categoria'] != 1) {
    // Si no es administrador, lo redirigimos a una página de error o al inicio
    header("Location: error_page.php");
    exit();
  }

// Obtener el ID del producto a actualizar
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Obtener los datos del producto
    $sql = "SELECT * FROM productos WHERE id = $id";
    $result = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($result) == 1) {
        $producto = mysqli_fetch_assoc($result);
    } else {
        echo "Producto no encontrado.";
        exit;
    }
} else {
    echo "ID de producto no especificado.";
    exit;
}

// Obtener las categorías para el menú desplegable
$sql_categorias = "SELECT * FROM categorias";
$result_categorias = mysqli_query($conexion, $sql_categorias);

// Actualizar producto cuando se envía el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);
    $precio = mysqli_real_escape_string($conexion, $_POST['precio']);
    $categoria_id = mysqli_real_escape_string($conexion, $_POST['categoria_id']);
    $stock = mysqli_real_escape_string($conexion, $_POST['stock']);

    // Verificar si se ha subido una nueva imagen
    if (isset($_FILES['imagen']['name']) && $_FILES['imagen']['name'] != '') {
        $imagen_nombre = $_FILES['imagen']['name'];
        $imagen_tmp = $_FILES['imagen']['tmp_name'];
        $imagen_ruta = "../static/uploads/" . $imagen_nombre;

        // Mover la imagen a la carpeta 'uploads'
        if (move_uploaded_file($imagen_tmp, $imagen_ruta)) {
            $imagen_url = $imagen_ruta;
        } else {
            echo "Error al subir la imagen.";
            exit;
        }
    } else {
        // Si no se sube una nueva imagen, mantener la URL de la imagen existente
        $imagen_url = $producto['imagen_url'];
    }

    // Actualizar la base de datos con los nuevos datos
    $sql_update = "UPDATE productos SET nombre = '$nombre', descripcion = '$descripcion', precio = '$precio', categoria_id = '$categoria_id', stock = '$stock', imagen_url = '$imagen_url' WHERE id = $id";
    
    if (mysqli_query($conexion, $sql_update)) {
        echo "Producto actualizado correctamente.";
        header("Location: ver_productos.php"); // Redireccionar después de actualizar
        exit;
    } else {
        echo "Error actualizando producto: " . mysqli_error($conexion);
    }
}

include "sidebar.php"; // Incluir sidebar

?>

<!-- Formulario para editar el producto -->
<div class="content-wrapper" style="margin-left: 250px;"> <!-- Asegurar que el contenido no se solape con el sidebar -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">Editar Producto</h2>
        <form action="update_producto.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data"> <!-- Asegurar el enctype para subir archivos -->
            <div class="form-group">
                <label for="nombre">Nombre del Producto</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($producto['nombre']); ?>" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required><?php echo htmlspecialchars($producto['descripcion']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="precio">Precio</label>
                <input type="number" class="form-control" id="precio" name="precio" value="<?php echo htmlspecialchars($producto['precio']); ?>" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="categoria_id">Categoría</label>
                <select class="form-control" id="categoria_id" name="categoria_id" required>
                    <option value="">Seleccione una categoría</option>
                    <?php while ($categoria = mysqli_fetch_assoc($result_categorias)): ?>
                        <option value="<?php echo $categoria['id']; ?>" <?php if ($producto['categoria_id'] == $categoria['id']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($categoria['nombre']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" value="<?php echo htmlspecialchars($producto['stock']); ?>" required>
            </div>

            <div class="form-group">
                <label for="imagen">Subir nueva imagen (opcional)</label>
                <input type="file" class="form-control-file" id="imagen" name="imagen">
                <?php if (!empty($producto['imagen_url'])): ?>
                    <p>Imagen actual: <img src="<?php echo $producto['imagen_url']; ?>" alt="Imagen del producto" width="100"></p>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Producto</button>
        </form>
    </div>
</div>

<?php
// Cerrar conexión
mysqli_close($conexion);
?>


</body>
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</html>