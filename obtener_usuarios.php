<?php
session_start();

$conexion = mysqli_connect("localhost", "root", "", "proyecto");

if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}

if (isset($_GET['clase_id'])) {
    $clase_id = intval($_GET['clase_id']);
    
    // Consulta para obtener los usuarios registrados en la clase
    $sql = "
        SELECT usuarios.nombre, usuarios.apellido, usuarios.email 
        FROM reservas 
        JOIN usuarios ON reservas.usuario_id = usuarios.usuario_id 
        WHERE reservas.clase_id = '$clase_id'
    ";
    $result = mysqli_query($conexion, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        echo "<ul class='list-group'>";
        while ($usuario = mysqli_fetch_assoc($result)) {
            echo "<li class='list-group-item bg-dark text-light font-weight-bold'>" . $usuario['nombre'] . " " . $usuario['apellido'] .  "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p class='text-light font-weight-bold'>No hay usuarios registrados para esta clase.</p>";
    }
    
}

mysqli_close($conexion);
?>
