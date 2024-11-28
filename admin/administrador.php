<?php
  // Conecta a la BD
  require '../lib/conexion_bd.php';
  // Comienza sesión y verifica si el usuario está logueado
  require '../lib/esta_logueado.php';

  if ( $_SESSION['categoria'] != 1) {
    // Si no es administrador, lo redirige a una página de error
    header("Location: error_page.php");
    exit();
  }

  // Consulta las tablas de clases y usuarios
  $clases   = mysqli_query($conexion, "SELECT * FROM clases");
  $usuarios = mysqli_query($conexion, "SELECT usuario, email, usuario_id FROM usuarios");

  // Elimina a un usuario si esta marcado para eliminar
  if (isset($_GET['usuarioEliminado'])) {
      $eliminar = $_GET['usuarioEliminado'];
      
      mysqli_query($conexion, "DELETE FROM usuarios WHERE usuario_id = '$eliminar'");
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
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="admin.css">
  <title>Clases</title>
</head>

<body id="clases" class="layout-fixed">
  <div class="wrapper">
    <!-- Barra de nav y sidebar -->
    <?php include "sidebar.php" ?>

    <!-- Contenido -->
    <div class="content-wrapper">
      <section class="content">
        <div class="container-fluid">
          <!-- Titulo y boton de agregar clase-->
          <h1 class="font-weight-bold pt-5 text-center">Lista de clases</h1>
          <div class="d-flex justify-content-end">
            <a class="btn btn-success" href="agregaClase.php">Agregar Clase</a>
          </div>

          <!-- Lista de clases -->
          <div class="row"> 
            <?php while ($clase = mysqli_fetch_array($clases)) { ?>
              <!-- Clase -->
              <div class="col-sm-4 col-xl-3"> 
                <div class="card mb-3">
                  <!-- Imagen -->
                  <img class="card-img-top" src="<?php echo '../static/' . $clase['imagen_url']; ?>" alt="Imagen de la clase">
                  
                  <!-- Datos de la clase -->
                  <div class="card-body">
                    <!-- Nombre y horario -->
                    <h5 class="card-title font-weight-bold mb-2"><?php echo $clase['nombre']; ?></h5>
                    <p class="card-text">
                      <?php
                      // Convertir el horario y eliminar los segundos
                        $horario = $clase['horario'];
                        $horarioSinSegundos = date("H:i", strtotime($horario));
                        echo "Horario: " . $horarioSinSegundos;
                        ?>
                    </p>

                    <!-- Botones de la tarjeta -->
                    <div class="d-flex" style="gap: 10px;">
                      <!-- Botón para ver usuarios registrados -->
                      <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#usuariosModal" data-clase-id="<?php echo $clase['clase_id']; ?>" onclick="cargarUsuarios(<?php echo $clase['clase_id']; ?>)">
                        Usuarios
                      </button>
                      <!-- Botón para editar la clase -->
                      <a class="btn btn-primary btn-sm" href="modificaClase.php?clase_id=<?php echo $clase['clase_id']; ?>">
                        <span class="editar">Editar</span>
                      </a>
                      <!-- Botón para eliminar la clase -->
                      <a class="btn btn-danger btn-sm" href="eliminarClase.php?clase_id=<?php echo $clase['clase_id']; ?>" data-clase-id="<?php echo $clase['clase_id']; ?>">Eliminar</a>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </section>
    </div>

    <!-- Modal para mostrar los usuarios que reservaron una clase -->
    <div class="modal fade" id="usuariosModal" tabindex="-1" role="dialog" aria-labelledby="usuariosModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
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

  <script>
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

  <script>
      const currentLocation = location.href;
      const sidebarLinks = document.querySelectorAll('.sidebar-link');
      const sidebarLenght = sidebarLinks.length;
      for(let i = 0; i < sidebarLenght; i++){
          if(sidebarLinks[i].href === currentLocation){
              sidebarLinks[i].className = "nav-link sidebar-link sidebar-link-active"
          }
      }

  </script>

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
