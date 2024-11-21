<?php 
// Comienza la sesión si no esta creada
if(!isset($_SESSION)) session_start();
?>

<nav class="navbar navbar-expand-sm navbar-dark" style="background-color: black;">
    <a class="navbar-brand ml-1 mb-0 h1" href="index.php">LEMA Fit</a>
    <!-- Menu hamburgesa -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Items -->
    <div class="collapse navbar-collapse mr-1" id="navbarSupportedContent">
        <div class="navbar-nav ml-auto">
            <a class="nav-link text-light" href="/index.php">Inicio</a>
            <a class="nav-link text-light" href="contacto.php">Contacto</a>
            <a class="nav-link text-light" href="/clases/lista.php">Clases</a>
            <a class="nav-link text-light" href="/tienda/productos.php">Tienda</a>
            <?php if (isset($_SESSION['logueado']) && $_SESSION['logueado']) { // Si el usuario esta logueado ?>
                <?php if (isset($_SESSION['categoria']) && $_SESSION['categoria'] == 1) { // Es admin ?>
                    <a class="nav-link text-light" href="/admin/administrador.php">Admin</a>
                <?php } ?>
                <a class="nav-link text-light" href="/lib/cerrar_sesion.php">Cerrar Sesión</a>
            <?php } else { // No inicio sesión ?>
                <a class="nav-link text-light" href="/usuario/login.php">Login</a>
                <a class="nav-link text-light" href="/usuario/registro.php">Registro</a>
            <?php } ?>
            <!-- perfil todo
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                Dropdown
                </a>
                <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled">Disabled</a>
            </li>
            -->
        </div>
    </div>
</nav>