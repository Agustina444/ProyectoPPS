<?php 
  // Conecta a la BD
  require '../lib/conexion_bd.php';
  // Comienza sesión y verifica si el usuario está logueado
  require '../lib/esta_logueado.php';

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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Bakbak+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="/static/css/custom.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Document</title>
</head>
<body>

<?php include "sidebar.php"; ?>

<div class="content-wrapper">
  <!-- Cabecera del contenido -->
  <section class="content-header">
    <div class="container-fluid">
    </div>
  </section>

  <!-- Contenido principal -->
  <section class="content">
    <div class="container-fluid">
      <!-- Tarjeta que envuelve la tabla -->
      <div class="card">
        <div class="card-header" style = "margin-top:50px">
          <h3 class="card-title text-center" >Lista de Usuarios Registrados</h3>
        </div>
        <div class="card-body">
          <!-- Aquí va la tabla que has proporcionado -->
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">User</th>
                <th scope="col">Email</th>
                <th scope="col">Fecha Inicio</th>
                <th scope="col">Fecha Fin</th>
                <th scope="col">Es Premium</th> <!-- Nueva columna para es_premium -->
                <th scope="col">Modificar</th>
                <th scope="col">Eliminar</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($recorroUsuarios = mysqli_fetch_array($usuarios)) { ?>
                <tr>
                  <th scope="row"><?php echo $recorroUsuarios['usuario_id'] ?></th>
                  <td class="fw-bold"><?php echo $recorroUsuarios['usuario'] ?></td>
                  <td><?php echo $recorroUsuarios['email'] ?></td>
                  <td><?php echo $recorroUsuarios['fecha_inicio'] ?></td>
                  <td><?php echo $recorroUsuarios['fecha_fin'] ?></td>
                  <td>
                    <!-- Mostrar si el usuario es premium o no -->
                    <?php echo $recorroUsuarios['es_premium'] == 1 ? 'Sí' : 'No'; ?>
                  </td>
                  <td>
                    <form action="modificaUsuario.php" method="get">
                      <button type="submit" class="btn btn-warning">
                        <i class="fas fa-pencil-alt"></i>
                      </button>
                      <input type="hidden" name="usuarioModificado" value="<?php echo $recorroUsuarios['usuario_id'] ?>"/>
                    </form>
                  </td>
                  <td>
                    <form action="" method="get" id="formEliminar<?php echo $recorroUsuarios['usuario_id']; ?>">
                      <button type="button" class="btn btn-danger" onclick="confirmarEliminacion(<?php echo $recorroUsuarios['usuario_id']; ?>)">
                        <i class="fas fa-trash"></i>
                      </button>
                      <input type="hidden" name="usuarioEliminado" value="<?php echo $recorroUsuarios['usuario_id'] ?>"/>
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

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    
</body>
</html>

</html>