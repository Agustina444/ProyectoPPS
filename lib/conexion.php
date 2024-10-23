<?php 
$conexion=mysqli_connect("localhost", "root", "", "proyecto");

if (!$conexion) {
	die("Conexión fallida: " . mysqli_connect_error());
}