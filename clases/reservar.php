
<!DOCTYPE html>
<html lang="en">
<head>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservar Clase</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
    <title>Document</title>
</head>
<body>
    
</body>
</html>

<?php
// Conecta a la BD
require '../lib/conexion_bd.php';
// Comienza sesión y verifica si el usuario está logueado
require '../lib/esta_logueado.php';

// Suponiendo que el ID del usuario está en la sesión
$usuario_id = $_SESSION['id_usuario'];

if (isset($_GET['clase_id'])) {
    $clase_id = intval($_GET['clase_id']);

    // Verificar si ya existe una reserva para esta clase
    $sql = "
        SELECT * FROM reservas 
        WHERE usuario_id = '$usuario_id'
        AND clase_id = '$clase_id'
    ";
    $verificacion = mysqli_query($conexion, $sql);
    
    if (mysqli_num_rows($verificacion) > 0) {
        echo "<script>
                Swal.fire({
                    title: '¡Atención!',
                    text: 'Ya has reservado esta clase anteriormente.',
                    icon: 'warning',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    window.location.href = 'lista.php'; // Redirigir a la lista de clases
                });
              </script>";
    } else {
        // Insertar la reserva en la base de datos
        $sql = "INSERT INTO reservas (usuario_id, clase_id) VALUES ('$usuario_id', '$clase_id')";
        
        if (mysqli_query($conexion, $sql)) {
            echo "Reserva realizada con éxito.";
        } else {
            echo "Error al realizar la reserva: " . mysqli_error($conexion);
        }
    }
} else {
    echo "No se ha proporcionado un ID de clase.";
}
mysqli_close($conexion);
?>