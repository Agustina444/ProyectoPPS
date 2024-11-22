<?php
// Asegúrate de que el script maneje la solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtén el contenido del webhook
    $data = file_get_contents('php://input');

    // Aquí puedes procesar el contenido como necesites
    // Por ejemplo, puedes registrar los datos en un archivo para verlos
    file_put_contents('webhook_log.txt', $data, FILE_APPEND);

    // Envía una respuesta de éxito
    http_response_code(200); // Código de éxito
    echo 'Webhook recibido';
} else {
    // Si no es una solicitud POST
    http_response_code(405); // Método no permitido
    echo 'Método no permitido';
}
?>
