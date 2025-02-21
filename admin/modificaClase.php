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

if (isset($_GET['clase_id'])) {
	$consulta = mysqli_query($conexion,"SELECT *
											FROM clases
											WHERE clase_id = ".$_GET['clase_id']);

	$datosClase = mysqli_fetch_array($consulta); //para que me aparezcan en el text los datos "viejos"
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (isset($_POST['nombreClase']) && isset($_POST['horarioClase']) && isset($_POST['idClase'])) {
		$nombre = $_POST['nombreClase'];
		$horario = $_POST['horarioClase'];
		$idClase = $_POST['idClase'];

		// Verificar si se ha subido una nueva imagen
		if (isset($_FILES['imagenClase']) && $_FILES['imagenClase']['error'] == UPLOAD_ERR_OK) {
			$imagenTempPath = $_FILES['imagenClase']['tmp_name'];
			$imagenNombre = time() . '_' . $_FILES['imagenClase']['name'];
			$imagenDestino = '../static/uploads/clases/' . basename($imagenNombre);

			// Intentar mover el archivo
			if (move_uploaded_file($imagenTempPath, $imagenDestino)) {
				// Si la imagen se sube correctamente, actualizar la base de datos
				$consulta = mysqli_query($conexion, "UPDATE clases
					SET nombre = '$nombre', 
						horario = '$horario',
						imagen_url = '$imagenDestino'
					WHERE clase_id = $idClase");
				
				if ($consulta) {
					echo '<script>
						document.addEventListener("DOMContentLoaded", function() {
							Swal.fire({
								title: "Éxito!",
								text: "La clase ha sido editada correctamente.",
								icon: "success",
								confirmButtonText: "Aceptar"
							}).then((result) => {
								if (result.isConfirmed) {
									window.location.href = "administrador.php"; // Redirige a la página que desees
								}
							});
						});
					</script>';
				} else {
					echo "Error en la consulta: " . mysqli_error($conexion);
				}
			} else {
				echo '<script>
					document.addEventListener("DOMContentLoaded", function() {
						Swal.fire({
							title: "Error",
							text: "Error al mover el archivo a la carpeta.",
							icon: "error",
							confirmButtonText: "Aceptar"
						});
					});
				</script>';
			}
		} else {
			// Si no se subió una nueva imagen, solo actualizar nombre y horario
			$consulta = mysqli_query($conexion, "UPDATE clases
				SET nombre = '$nombre', 
					horario = '$horario'
				WHERE clase_id = $idClase");
			
			if ($consulta) {
				echo '<script>
					document.addEventListener("DOMContentLoaded", function() {
						Swal.fire({
							title: "Éxito!",
							text: "La clase ha sido editada correctamente.",
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
				echo "Error en la consulta: " . mysqli_error($conexion);
			}
		}
	} else {
		echo "Por favor, complete todos los campos requeridos.";
	}
}
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
    <link rel="stylesheet" href="modifica_clase.css">
	<title>Editar clase</title>
</head>

<body class="layout-fixed">
  <div class="wrapper">
    <!-- Barra de nav y sidebar -->
    <?php include "sidebar.php" ?>

    <!-- Contenido -->
    <div class="content-wrapper">
	  <section class="content">
	    <div class="container-fluid">
		  <h1 class="text-center font-weight-bold py-5">Modificar Clase</h1>

		  <!-- Formulario -->
		  <form action="" method="post" autocomplete="off" enctype="multipart/form-data" class="mx-auto">
			<div class="mb-3">
				<label for="nombreClase" class="form-label">Nombre Clase</label>
				<input type="text" name="nombreClase" id="nombreClase" class="form-control" value="<?php echo $datosClase['nombre']; ?>" required />
			</div>

			<div class="mb-3">
				<label for="horarioClase" class="form-label">Horario</label>
				<input type="time" name="horarioClase" id="horarioClase" class="form-control" value="<?php echo $datosClase['horario']; ?>" required />
			</div>

			<div class="mb-3">
				<label for="imagenClase" class="form-label">Imagen de la Clase</label>
				<input type="file" name="imagenClase" id="imagenClase" class="form-control" accept="image/*" />
				<small class="form-text text-muted">Selecciona una nueva imagen si deseas actualizarla.</small>
			</div>

			<input type="hidden" name="idClase" value="<?php echo $datosClase['clase_id']; ?>" />

			<div class="d-flex justify-content-center">
				<input type="submit" class="btn btn-primary" value="CONTINUAR" />
			</div>
		  </form>
		</div>
	  </section>
    </div>
  </div>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>