<?php 
    if(!isset($_SESSION)){ 
        session_start(); 
    } 

	include("conexion.php");

	//si no esta loggeado, volver
	if(!isset($_SESSION['logueado'])){  
		header("Location: form_login.php");
		exit;
	}

	//consulta para ver datos de esas 2 tablas
	$clases = mysqli_query($conexion, " SELECT * 
											FROM clases");

	$usuarios = mysqli_query($conexion, "SELECT usuario, email, usuario_id
											FROM usuarios");

	//consulta para eliminar alguno de sus datos
	

	if(isset($_GET['usuarioEliminado'])){     
		$eliminar = $_GET['usuarioEliminado'];

		mysqli_query($conexion, "DELETE 
									FROM usuarios
									WHERE usuario_id = '$eliminar'");
		header("Location: administrador.php");
		exit();
	}

 
?>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<link href="https://fonts.googleapis.com/css2?family=Bakbak+One&display=swap" rel="stylesheet">
	 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="custom.css">
   <link rel="stylesheet" href="administrador.css">
 	
 	<title></title>
 </head>
 <body>

<!-- Modal para mostrar usuarios registrados -->
<div class="modal fade" id="usuariosModal" tabindex="-1" role="dialog" aria-labelledby="usuariosModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bg-dark text-light"> 
      <div class="modal-header border-0">
        <h5 class="modal-title font-weight-bold" id="usuariosModalLabel">Usuarios Registrados</h5> 
        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="usuariosList"></div>
      </div>
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>




 <style>
  h1{
    font-family: 'Roboto', sans-serif;
  }
 </style>


<?php include "sidebar.php" ?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
         
        </div>
        <div class="col-sm-6">
        
         
        </div>
      </div>
    </div>
  </div>

  <div class="content">
    <a href="agregaClase.php">
    
      <button class="btn btn-success btn-clase">Agregar Clase</button>
    </a>
    <div class="container-fluid">
      <div class="row"> <!-- Fila para contener las tarjetas -->
        <?php while ($recorroClases = mysqli_fetch_array($clases)) { ?>
          <div class="col-md-3"> <!-- Columna de tamaño 4, para que se ajusten 3 tarjetas por fila -->
            <div class="card mb-3">
              <img src="<?php echo $recorroClases['imagen_url']; ?>" class="card-img-top" alt="Imagen de la clase">
              <div class="card-body">
                <h5 class="card-title font-weight-bold"><?php echo $recorroClases['nombre']; ?></h5>
                <p class="card-text">
                  <?php 
                  // Convertir el horario y eliminar los segundos
                  $horario = $recorroClases['horario']; 
                  $horarioSinSegundos = date("H:i", strtotime($horario));
                  echo "Horario: " . $horarioSinSegundos;
                  ?>
                </p>
                <div class="d-flex justify-content-end mt-3" style="gap: 10px;">
  <!-- Botón para ver usuarios registrados -->
  <button class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#usuariosModal" data-clase-id="<?php echo $recorroClases['clase_id']; ?>" onclick="cargarUsuarios(<?php echo $recorroClases['clase_id']; ?>)">
    Usuarios
  </button>
  <!-- Botón para editar la clase -->
  <a href="modificaclase.php?clase_id=<?php echo $recorroClases['clase_id']; ?>" class="btn btn-outline-primary btn-sm">
    <i class="fas fa-edit"></i> Editar
  </a>
  <!-- Botón para eliminar la clase -->
  <a href="eliminarClase.php?clase_id=<?php echo $recorroClases['clase_id']; ?>" class="btn btn-outline-danger btn-sm eliminarBtn" data-clase-id="<?php echo $recorroClases['clase_id']; ?>">Eliminar</a>
</div>

              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>


<script>
function cargarUsuarios(clase_id) {
  // Realiza una solicitud AJAX para obtener los usuarios registrados
  $.ajax({
    url: 'obtener_usuarios.php', // Cambia esto a la ruta de tu archivo PHP
    type: 'GET',
    data: { clase_id: clase_id },
    success: function(data) {
      // Actualiza el contenido del modal con la lista de usuarios
      $('#usuariosList').html(data);
    },
    error: function() {
      $('#usuariosList').html('<p>Error al cargar usuarios.</p>');
    }
  });
}
</script>



'<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Seleccionar todos los enlaces con la clase "eliminarBtn"
        const eliminarBtns = document.querySelectorAll(".eliminarBtn");

        eliminarBtns.forEach(function(btn) {
            btn.addEventListener("click", function(event) {
                event.preventDefault(); // Evitar la redirección automática del enlace

                const idClase = this.getAttribute("data-clase-id");

                Swal.fire({
                    title: "¿Estás seguro?",
                    text: "¿Deseas eliminar esta clase?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Confirmar",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirigir a la página de eliminación solo si se confirma
                        window.location.href = "eliminarClase.php?clase_id=" + idClase;
                    }
                });
            });
        });
    });
</script>

	
  <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

 </body>

 
 </html>
