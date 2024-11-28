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

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);
    $precio = mysqli_real_escape_string($conexion, $_POST['precio']);
    $categoria_id = mysqli_real_escape_string($conexion, $_POST['categoria_id']);
    $stock = mysqli_real_escape_string($conexion, $_POST['stock']);

    // Manejo de la imagen
    $target_dir = "../static/uploads";
    $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Verificar si el archivo es una imagen
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["imagen"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "El archivo no es una imagen.";
            $uploadOk = 0;
        }
    }

    // Verificar si el archivo ya existe
    if (file_exists($target_file)) {
        echo "Lo siento, el archivo ya existe.";
        $uploadOk = 0;
    }

    // Verificar el tamaño del archivo
    if ($_FILES["imagen"]["size"] > 500000) {
        echo "Lo siento, tu archivo es demasiado grande.";
        $uploadOk = 0;
    }

    // Permitir solo ciertos formatos
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Lo siento, solo se permiten archivos JPG, JPEG, PNG y GIF.";
        $uploadOk = 0;
    }

    // Verificar si $uploadOk es 0 (no subió el archivo)
    if ($uploadOk == 0) {
        echo "Lo siento, tu archivo no fue subido.";
    // Si todo está bien, intenta subir el archivo
    } else {
        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
            $imagen_url = $target_file;

            // Insertar producto en la base de datos
            $sql = "INSERT INTO productos (nombre, descripcion, precio, categoria_id, stock, fecha_agregado, imagen_url)
                    VALUES ('$nombre', '$descripcion', '$precio', '$categoria_id', '$stock', NOW(), '$imagen_url')";

            if (mysqli_query($conexion, $sql)) {
                echo "Nuevo producto insertado correctamente";
                header("Location: ver_productos.php"); // Redirigir después de la inserción
                exit;
            } else {
                echo "Error al insertar producto: " . mysqli_error($conexion);
            }
        } else {
            echo "Lo siento, hubo un error al subir tu archivo.";
        }
    }
}

// Consultar las categorías para mostrarlas en el formulario
$sql_categorias = "SELECT * FROM categorias";
$result_categorias = mysqli_query($conexion, $sql_categorias);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css2?family=Bakbak+One&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="insertar_producto.css">
    <title>Nuevo producto</title>
</head>


<body class="layout-fixed">
  <div class="wrapper">
    <!-- Barra de nav y sidebar -->
    <?php include "sidebar.php" ?>

    <!-- Contenido -->
    <div class="content-wrapper">
        <div class="container py-5">
            <h1 class="text-center font-weight-bold mb-4">Nuevo Producto</h1>
            <form action="insertar_producto.php" method="POST" enctype="multipart/form-data" class="mx-auto p-4 border rounded shadow mt-5 bg-light">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del Producto</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea name="descripcion" class="form-control textarea2" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="precio" class="form-label">Precio</label>
                    <input type="number" step="0.01" name="precio" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="categoria_id" class="form-label">Categoría</label>
                    <select name="categoria_id" class="form-control" required>
                        <option value="" disabled selected>Selecciona una categoría</option>
                        <?php while($categoria = mysqli_fetch_assoc($result_categorias)): ?>
                            <option value="<?= $categoria['id']; ?>"><?= $categoria['nombre']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" name="stock" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="imagen" class="form-label">Imagen del Producto</label>
                    <input type="file" name="imagen" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Insertar Producto</button>
            </form>
        </div>
    </div>
</div>
<?php mysqli_close($conexion); ?>
</body>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</html>