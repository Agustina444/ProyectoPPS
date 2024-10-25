<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-light navbar-white">
  <div class="container">
    <a href="#" class="navbar-brand">
      <span class="brand-text font-weight-light">LEMA Fit</span>
    </a>
    <ul class="navbar-nav">
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../index.php" class="nav-link">Inicio</a>
      </li>
      
    </ul>

    <ul class="navbar-nav ml-auto"> <!-- Asegúrate de que este ul esté alineado a la derecha -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-shopping-cart"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">...</a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">Ver todos los mensajes</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">...</a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">Ver todas las notificaciones</a>
        </div>
      </li>
      <li class="nav-item">
        <a href="../lib/cerrar_sesion.php"><button class="btn btn-danger fw-bold btn-cerrar-sesion ml-5">Cerrar sesión</button></a>
      </li>
    </ul>
  </div>
</nav>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info">
        <a href="#" class="d-block"><?php echo $_SESSION['nombre'] . " Admin"; ?></a>
      </div>
    </div>

    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
        <li class="nav-item has-treeview menu-open">
          <a href="administrador.php" class="nav-link">
            <i class="nav-icon fas fa-solid fa-dumbbell"></i>
            <p class="text-center ml-2">CLASES</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="usuarios.php" class="nav-link">
            <i class="fas fa-user"></i>
            <p class="text-center ml-3">USUARIOS</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="ver_productos.php" class="nav-link">
          <i class="fas fa-box"></i>

            <p class="text-center ml-3">PRODUCTOS</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>
<!-- Bootstrap 4 -->

<!-- AdminLTE App -->



