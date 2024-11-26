
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

// Consulta para obtener las categorías
$sql_categorias = "SELECT id, nombre FROM categorias";
$resultado_categorias = mysqli_query($conexion, $sql_categorias);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Bakbak+One&display=swap" rel="stylesheet">
	 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Document</title>
</head>
<body>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <h1 class="text-center mt-2 fw-bold">AGREGAR PRODUCTO</h1>
      <form action="insertar_producto.php" method="post" enctype="multipart/form-data" autocomplete="off" class="p-4 border rounded mt-5">
        <div class="mb-3">
          <label for="nombre" class="form-label">Nombre del Producto</label>
          <input type="text" name="nombre" class="form-control" id="nombre" required>
        </div>

        <div class="mb-3">
          <label for="descripcion" class="form-label">Descripción</label>
          <textarea name="descripcion" class="form-control" id="descripcion" required></textarea>
        </div>

        <div class="mb-3">
          <label for="precio" class="form-label">Precio</label>
          <input type="number" step="0.01" name="precio" class="form-control" id="precio" required>
        </div>

        <div class="mb-3">
          <label for="categoria_id" class="form-label">Categoría</label>
          <select name="categoria_id" class="form-select" id="categoria_id" required>
            <option value="">Seleccione una categoría</option>
            <?php
            // Cargar dinámicamente las categorías desde la base de datos
            while ($categoria = mysqli_fetch_assoc($resultado_categorias)) {
                echo "<option value='" . $categoria['id'] . "'>" . $categoria['nombre'] . "</option>";
            }
            ?>
          </select>
        </div>

        <div class="mb-3">
          <label for="stock" class="form-label">Stock</label>
          <input type="number" name="stock" class="form-control" id="stock" required>
        </div>

        <div class="mb-3">
          <label for="imagen" class="form-label">Imagen del Producto</label>
          <input type="file" name="imagen" class="form-control" id="imagen" required>
        </div>

        <button type="submit" class="btn btn-primary">Agregar Producto</button>
      </form>
    </div>
  </div>
</div>

 <!-- jQuery -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

    
</body>
</html>