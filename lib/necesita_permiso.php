<?php session_start();

// Si el usuario no inicio sesión, lo manda al formulario para logearse
if(!isset($_SESSION['logueado']) || !$_SESSION['logueado']){
	header("Location: ../usuario/login.php");
	exit();
}