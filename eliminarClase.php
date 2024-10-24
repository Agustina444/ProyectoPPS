<?php
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "proyecto");

// Verificar si se ha recibido un ID de clase
if (isset($_GET['clase_id'])) {
    $idClase = intval($_GET['clase_id']);
    
}

    
$consulta = mysqli_query($conexion, "DELETE FROM clases WHERE clase_id = $idClase");

    // Clase eliminada correctamente
    if ($consulta) {
        // Clase eliminada correctamente
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "Clase eliminada!",
                    text: "La clase ha sido eliminada correctamente.",
                    icon: "success",
                    confirmButtonText: "Aceptar"
                }).then(() => {
                    window.location.href = "administrador.php"; // Redirige a la página de administración
                });
            });
        </script>';
    } else {
        // Error al eliminar
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "Error",
                    text: "Hubo un problema al intentar eliminar la clase.",
                    icon: "error",
                    confirmButtonText: "Aceptar"
                });
            });
        </script>';
    }
    


    




  
    


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Clase</title>
    <link href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css" rel="stylesheet">
</head>
<body>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>
