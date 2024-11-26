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

// Verificar si se ha pasado un ID de producto
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Eliminar el producto de la base de datos
    $sql = "DELETE FROM productos WHERE id = $id";
    
    if (mysqli_query($conexion, $sql)) {
        echo "Producto eliminado correctamente.";
        header("Location: ver_productos.php"); // Redireccionar después de eliminar
        exit;
    } else {
        echo "Error eliminando producto: " . mysqli_error($conexion);
    }
} else {
    echo "ID de producto no especificado.";
}

// Cerrar conexión
mysqli_close($conexion);
?>
