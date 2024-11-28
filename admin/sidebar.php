<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Parte izquierda-->
  <ul class="navbar-nav">
    <!-- Menu hamburguesa -->
    <li class="nav-item">
      <a class="nav-link" id="hamburguesa" data-widget="pushmenu" href="#" role="button">
        <i class="fas fa-bars"></i>
      </a>
    </li>
  </ul>

  <!-- Parte derecha -->
  <ul class="navbar-nav ml-auto">
    <!-- Boton de cerrar sesión -->
    <li class="nav-item">
      <a href="../lib/cerrar_sesion.php">
        <button class="btn btn-danger fw-bold btn-cerrar-sesion mr-2">Cerrar sesión</button>
      </a>
    </li>
  </ul>
</nav>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Logo -->
  <a class="brand-link" href="../index.php">
    <img class="brand-image rounded elevation-3" src="../static/img/gym-logo.jpg" alt="Gym logo">
    <span class="brand-text">LEMA Fit</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Usuario -->
    <div class="user-panel my-2 pb-2 pl-2 d-flex">
      <div class="info">
        <a class="d-block" href=""><?php echo $_SESSION['nombre'] . " Admin"; ?></a>
      </div>
    </div>
    
    <!-- Secciones -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
        <!-- Clases -->
        <li class="nav-item">
          <a href="administrador.php" class="nav-link sidebar-link" >  
            <i class="nav-icon fas fa-solid fa-dumbbell"></i>
            <p>CLASES</p>
          </a>
        </li>

        <!-- Usuarios -->
        <li class="nav-item">
          <a href="usuarios.php" class="nav-link sidebar-link">
            <i class="nav-icon fas fa-user"></i>
            <p>USUARIOS</p>
          </a>
        </li>

        <!-- Productos -->
        <li class="nav-item">
          <a href="ver_productos.php" class="nav-link sidebar-link">
            <i class="nav-icon fas fa-box"></i>
            <p>PRODUCTOS</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>