<?php
// Comienza la sesión si no esta creada
if(!isset($_SESSION)) session_start();

// Si el usuario no inicio sesión, lo manda al formulario para logearse
if(!isset($_SESSION['logueado']) || !$_SESSION['logueado']){
	header("Location: ../usuario/login.php");
	exit();
}

session_regenerate_id(true);