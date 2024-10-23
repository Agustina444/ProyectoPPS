<?php
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "proyecto");

// Verificar la conexión
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Recibir datos del formulario
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$categoria_id = $_POST['categoria_id'];
$stock = $_POST['stock'];
$fecha_agregado = date("Y-m-d H:i:s"); // Fecha y hora actual

// Procesar la imagen
$directorio_subida = "uploads/"; // Carpeta donde se guardarán las imágenes
$nombre_imagen = basename($_FILES['imagen']['name']); // Nombre del archivo
$archivo_subido = $directorio_subida . $nombre_imagen; // Ruta completa del archivo

// Validar que la imagen fue subida correctamente
if (move_uploaded_file($_FILES['imagen']['tmp_name'], $archivo_subido)) {
    // Si la imagen se subió correctamente, guardamos la URL en la base de datos
    $imagen_url = $archivo_subido; // Guardamos la ruta de la imagen como la URL
    
    // Insertar producto en la base de datos
    $sql = "INSERT INTO productos (nombre, descripcion, precio, categoria_id, stock, fecha_agregado, imagen_url) 
            VALUES ('$nombre', '$descripcion', '$precio', '$categoria_id', '$stock', '$fecha_agregado', '$imagen_url')";

    if (mysqli_query($conexion, $sql)) {
        echo "Producto insertado correctamente.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
    }
} else {
    echo "Error al subir la imagen.";
}

// Cerrar la conexión
mysqli_close($conexion);
?>
