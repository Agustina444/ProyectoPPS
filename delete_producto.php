<?php
// Conectar a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "proyecto");

if (!isset($_SESSION)) { 
    session_start(); 
}

if (!isset($_SESSION['logueado'])) {  
    header("Location: form_login.php");
    exit;
}

if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
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
