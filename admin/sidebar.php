<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-light navbar-white">
  <div class="container">
    <a href="administrador.php" class="navbar-brand">
      <span class="brand-text font-weight-light">Lutina Gym</span>
    </a>
    <ul class="navbar-nav">
      <li class="nav-item d-none d-sm-inline-block">
        <a href="administrador.php" class="nav-link">Inicio</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contacto</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown4" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Ayuda
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown4">
          <a class="dropdown-item" href="#">FAQ</a>
          <a class="dropdown-item" href="#">Support</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Contact</a>
        </div>
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
            <div class="media">
              <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">...</a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">...</a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a href="/lib/cerrar_sesion.php"><button class="btn btn-danger fw-bold btn-cerrar-sesion ml-5">Cerrar sesión</button></a>
      </li>
    </ul>
  </div>
</nav>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="admin-lte/dist/assets/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?php echo $_SESSION['nombre'] . " Admin"; ?></a>
      </div>
    </div>

    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
        <li class="nav-item has-treeview menu-open">
          <a href="#" class="nav-link">
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
      </ul>
    </nav>
  </div>
</aside>
<!-- Bootstrap 4 -->

<!-- AdminLTE App -->



