<?php session_start(); ?>
<link rel="stylesheet" href="/static/css/barra_nav.css">
<nav>
    <ul>
        <li><a href="/index.php">INICIO</a></li>
        <li><a href="/contacto.php">CONTACTO</a></li>
        <li><a href="/sedes.php">SEDES</a></li>
        <li><a href="/tienda/productos.php">TIENDA</a></li>
        <?php if (isset($_SESSION['logueado']) && $_SESSION['logueado']) { ?>
            <li><a href="/clases/reservar.php">RESERVAR</a></li>
            <li><a href="/tienda/productos.php">TIENDA</a></li>
            <li><a href="/lib/cerrar_sesion.php">CERRAR SESIÓN</a></li>
            <li><a href="/usuario/perfil"></a></li>
        <?php } else { ?>
            <li><a href="/usuario/login.php">INGRESAR</a></li>
            <li><a href="/usuario/registro.php">REGISTRO</a></li>
        <?php } ?>
    </ul>
</nav>
