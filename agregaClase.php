<?php session_start();
	include("conexion.php");

	//si no esta loggeado, volver
	if(!isset($_SESSION['logueado'])){  
		header("Location: form_login.php");
		exit;
	}
	
	if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}

// Verificar si el formulario se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreClase = $_POST['nombreClase'];
    $horarioClase = $_POST['horarioClase'];
    $imagenUrl = '';

    // Validar que los campos obligatorios no estén vacíos
    if (empty($nombreClase) || empty($horarioClase)) {
        echo "El nombre de la clase y el horario son obligatorios.";
        exit;
    }

    // Verificar si se ha subido un archivo
    if (isset($_FILES['imagenClase']) && $_FILES['imagenClase']['error'] === UPLOAD_ERR_OK) {
        $nombreArchivo = $_FILES['imagenClase']['name'];
        $tipoArchivo = $_FILES['imagenClase']['type'];
        $rutaTemporal = $_FILES['imagenClase']['tmp_name'];
        $directorioDestino = 'uploads/clases/';
        $rutaDestino = $directorioDestino . basename($nombreArchivo);

        // Verificar el tipo de archivo (solo imágenes)
        $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];
        $extensionArchivo = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));

        if (in_array($extensionArchivo, $extensionesPermitidas)) {
            // Mover el archivo a la carpeta de destino
            if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
                $imagenUrl = $rutaDestino;
            } else {
                echo "Error al subir la imagen.";
                exit;
            }
        } else {
            echo "Tipo de archivo no permitido. Solo se permiten JPG, JPEG, PNG y GIF.";
            exit;
        }
    }

    // Preparar la consulta para insertar los datos en la base de datos
    $stmt = $conexion->prepare("INSERT INTO clases (nombre, horario, imagen_url) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombreClase, $horarioClase, $imagenUrl);

    // Ejecutar la consulta
    if ($stmt->execute()) {
      echo '<script>
      document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
          title: "Éxito!",
          text: "La clase ha sido agregada.",
          icon: "success",
          confirmButtonText: "Aceptar"
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = "administrador.php";
          }
        });
      });
    </script>';
        
    } else {
        echo "Error al agregar la clase: " . $stmt->error;
    }

    // Cerrar la conexión
    $stmt->close();
    mysqli_close($conexion);
}
?>

<style>

h1{
  font-family: 'Roboto', sans-serif;
}


</style>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css2?family=Bakbak+One&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Bakbak+One&display=swap" rel="stylesheet">
	 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="custom.css">
   <link rel="stylesheet" href="agregaclase.css">
	
	<title> Nueva Clase </title>
</head>
<body>

<style>
input[type="file"] {
    height:50px;
}
</style>
	
	
	<?php include "sidebar.php" ?>


	
  
  
  <div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <h1 class="text-center mt-4 fw-bold text-primary">AGREGAR CLASE</h1>
      <form action="" method="post" enctype="multipart/form-data" autocomplete="off" class="p-4 border rounded shadow mt-5 bg-light">
        <div class="mb-3">
          <label for="nombreClase" class="form-label">Nombre Clase</label>
          <input type="text" name="nombreClase" class="form-control" id="nombreClase" placeholder="Ingresa el nombre de la clase" required>
        </div>

        <div class="mb-3">
          <label for="horarioClase" class="form-label">Horario</label>
          <input type="time" name="horarioClase" class="form-control" id="horarioClase" required>
        </div>

        <div class="mb-3">
          <label for="imagenClase" class="form-label">Imagen de la Clase</label>
          <input type="file" name="imagenClase" class="form-control " id="imagenClase" accept="image/*" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Agregar Clase</button>
      </form>
    </div>
  </div>
</div>





 <!-- jQuery -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

</body>
</html>

