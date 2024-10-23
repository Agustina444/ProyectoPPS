<?php 
    if(!isset($_SESSION)){ 
        session_start(); 
    } 

  include '../lib/conexion.php';
  include '../lib/necesita_permiso.php';

	//consulta para ver datos de esas 2 tablas
	$clases = mysqli_query($conexion, " SELECT * 
											FROM clases");

	$usuarios = mysqli_query($conexion, "SELECT usuario, email, usuario_id
											FROM usuarios");

	//consulta para eliminar alguno de sus datos
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
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Document</title>

    
 	
</head>
<body>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
<!-- Sidebar -->
<div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="admin-lte/dist/assets/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="administrador.php" class="d-block"> <?php echo $_SESSION['nombre'] . " Admin" ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="administrador.php" class="nav-link active">
              <i class="nav-icon fas fa-solid fa-dumbbell"></i>
              <p class="text-center ml-2"></p>
                CLASES  </a>      
          </li>
          <li class="nav-item">
            <a href="usuarios.php" class="nav-link active">
            <i class="fas fa-user"></i>
            <p class="text-center ml-3">USUARIOS</p></a>
            </li>           
</ul>

</nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

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
        <div class="card-header">
          <h3 class="card-title">Lista de Usuarios Registrados</h3>
        </div>
        <div class="card-body">
          <!-- Aquí va la tabla que has proporcionado -->
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">User</th>
                <th scope="col">Email</th>
                <th scope="col">Modificar</th>
                <th scope="col">Eliminar</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($recorroUsuarios = mysqli_fetch_array($usuarios)){ ?>
                <tr>
                  <th scope="row"><?php echo $recorroUsuarios['usuario_id'] ?></th>
                  <td class="fw-bold"><?php echo $recorroUsuarios['usuario'] ?> </td>
                  <td><?php echo $recorroUsuarios['email'] ?> </td>
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


<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    
</body>
</html>