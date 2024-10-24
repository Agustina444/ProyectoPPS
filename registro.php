<?php session_start();
	include("conexion.php");

	if(isset($_GET['nombre']) && isset($_GET['apellido']) && isset($_GET['email']) && isset($_GET['usuario']) && isset($_GET['contrasenia'])){
		$_SESSION['logueado'] = true;
		$nombre = $_GET['nombre'];  
		$apellido = $_GET['apellido'];  
		$email = $_GET['email'];  
		$usuario = $_GET['usuario'];  
		$contraseniaHash = password_hash($_GET['contrasenia'], PASSWORD_DEFAULT);
		$categoria = '2';

		mysqli_query($conexion, "INSERT INTO usuarios
									(nombre, apellido, email, usuario, contrasenia, categoria_id)
									VALUES ('$nombre', '$apellido', '$email', '$usuario', '$contraseniaHash', 
									'$categoria')");

		//me guardo el ID del usuario
		$consulta = mysqli_query($conexion, "SELECT usuario_id, nombre
												FROM usuarios
												WHERE usuario = '$usuario'");
		
		$datosUsuario = mysqli_fetch_array($consulta);

		$_SESSION['nombre'] = $datosUsuario['nombre'];
		$_SESSION['id_usuario'] =  $datosUsuario['usuario_id'];

		include("mostrarReservas.php"); //es siempre suscriptor
	}	
?>
