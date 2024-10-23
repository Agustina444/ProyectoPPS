<?php
// Elimina la sesion y lo redirige a la pagina principal
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
$_SESSION = [];
session_destroy();
header("Location: ../index.php");
exit();