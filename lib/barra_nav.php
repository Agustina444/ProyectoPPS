<?php 
// Comienza la sesión si no esta creada
if(!isset($_SESSION)) session_start();
?>

<style>
    /* Personaliza el color de fondo del dropdown cuando tiene el mouse encima */
    .dropdown-item:hover {
        background-color: #23262a; /* Cambia a un color oscuro */
        color: white;
    }
</style>
<nav class="navbar navbar-expand-sm navbar-dark" style="background-color: black;">
    <a class="navbar-brand ms-2 mb-0 h1" href="/index.php">LEMA Fit</a>
    <!-- Menu hamburgesa -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Items -->
    <div class="collapse navbar-collapse mr-1" id="navbarSupportedContent">
        <div class="navbar-nav ms-auto">
            <!-- Si el usuario esta logueado -->
            <?php if (isset($_SESSION['logueado']) && $_SESSION['logueado']) { ?>
                <a class="nav-link text-light" href="/contacto.php">Contacto</a>
                <a class="nav-link text-light" href="/clases/lista.php">Clases</a>
                <a class="nav-link text-light" href="/tienda/productos.php">Tienda</a>
                <!-- Si el usuario es admin -->
                <?php if (isset($_SESSION['categoria']) && $_SESSION['categoria'] == 1) { ?>
                    <a class="nav-link text-light" href="/admin/administrador.php">Admin</a>
                <?php } ?>
                <!-- Muestra el dropdown de usuario -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $_SESSION['nombre']; ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end bg-dark">
                        <a class="dropdown-item text-light" href="/usuario/perfil.php">Perfil</a>
                        <a class="dropdown-item text-light" href="/lib/cerrar_sesion.php">Cerrar Sesión</a>
                    </div>
                </li>
            <!-- Si el usuario no inicio sesion -->
            <?php } else { ?>
                <a class="nav-link text-light" href="/sede.php">Conocé nuestro gym</a>
                <a class="nav-link text-light" href="/contacto.php">Contacto</a>
                <!-- Muestra el dropdown de invitado-->
                <li class="nav-item dropdown">
                    <a class="nav-link text-light dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Invitado
                    </a>
                    <div class="dropdown-menu dropdown-menu-end bg-dark">
                        <a class="dropdown-item text-light" href="/usuario/login.php">Login</a>
                        <a class="dropdown-item text-light" href="/usuario/registro.php">Registro</a>
                    </div>
                </li>
            <?php } ?>
        </div>
    </div>
</nav>