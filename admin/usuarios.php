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

  // Consulta para obtener los datos de los usuarios, incluyendo las fechas de inicio, fin y el estado de es_premium
  $usuarios = mysqli_query($conexion, "SELECT usuario, email, usuario_id, fecha_inicio, fecha_fin, es_premium
  FROM usuarios");

  // Consulta para eliminar alguno de sus datos
  if(isset($_GET['claseEliminada'])){     
    $eliminar = $_GET['claseEliminada'];

    mysqli_query($conexion, "DELETE 
                            FROM clases
                            WHERE clase_id = '$eliminar'");
    header("Location: administrador.php");
    exit();
  }

  if(isset($_GET['usuarioEliminado'])){     
    $eliminar = $_GET['usuarioEliminado'];

    mysqli_query($conexion, "DELETE 
                            FROM usuarios
                            WHERE usuario_id = '$eliminar'");
    header("Location: usuarios.php");
    exit();
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Bakbak+One&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="admin.css">
  <link rel="stylesheet" href="usuarios.css">
  <title>Usuarios</title>
</head>

<body class="layout-fixed">
  <div class="wrapper">
    <!-- Barra de nav y sidebar -->
    <?php include "sidebar.php" ?>

    <!-- Contenido -->
    <div class="content-wrapper">
      <section class="content">
        <div class="container-fluid pt-4">
          <!-- Carta -->
          <div class="card">
            <!-- Titulo -->
            <div class="card-header">
              <h3 class="card-title text-center">Lista de Usuarios Registrados</h3>
            </div>

            <!-- Contenido -->
            <div class="card-body">
              <!-- Tabla -->
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Usuario</th>
                    <th scope="col">Email</th>
                    <th scope="col">Fecha Inicio</th>
                    <th scope="col">Fecha Fin</th>
                    <th scope="col">Es Premium</th> <!-- Nueva columna para es_premium -->
                    <th scope="col">Modificar</th>
                    <th scope="col">Eliminar</th>
                  </tr>
                </thead>

                <tbody>
                  <?php while ($usuario = mysqli_fetch_array($usuarios)) { ?>
                    <tr>
                      <td class="fw-bold"><?= $usuario['usuario'] ?></td>
                      <td><?= $usuario['email'] ?></td>
                      <td><?= $usuario['fecha_inicio'] ?></td>
                      <td><?= $usuario['fecha_fin'] ?></td>
                      <td><?= $usuario['es_premium'] == 1 ? 'Sí' : 'No'; ?>
                      </td>
                      <!-- Boton editar usuario -->
                      <td>
                        <form action="modificaUsuario.php" method="get">
                          <button type="submit" class="btn btn-warning">
                            <i class="fas fa-pencil-alt"></i>
                          </button>
                          <input type="hidden" name="usuarioModificado" value="<?= $usuario['usuario_id'] ?>"/>
                        </form>
                      </td>
                      <!-- Boton eliminar usuario -->
                      <td>
                        <form action="" method="get" id="formEliminar<?= $usuario['usuario_id']; ?>">
                          <button type="button" class="btn btn-eliminar" onclick="confirmarEliminacion(<?= $usuario['usuario_id']; ?>)">
                            <i class="fas fa-trash"></i>
                          </button>
                          <input type="hidden" name="usuarioEliminado" value="<?= $usuario['usuario_id'] ?>"/>
                        </form>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>

  <script>
    function confirmarEliminacion(usuarioId) {
      Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esta acción!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          // Enviar el formulario correspondiente
          document.getElementById('formEliminar' + usuarioId).submit();
        }
      })
    }
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