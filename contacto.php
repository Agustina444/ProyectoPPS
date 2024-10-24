<?php
	include("conexion.php");

	if(isset($_GET['nombre']) && isset($_GET['email']) && isset($_GET['msj'])){

		$nombre = $_GET['nombre'];
		$email  = $_GET['email'];
		$msj    = $_GET['msj'];

		$destino="paginaGym@gmail.com";

		$header="De: ". $nombre;
	//	$emailEnviado = mail($destino,$msj,$header);

		$emailEnviado = true;

		if($emailEnviado == true){
			$mensaje = "Su correo se envio con éxito";
			$consulta = mysqli_query($conexion, "INSERT INTO contactos 
												(nombre,email,msj) 
												VALUES ( '$nombre','$email','$msj')");
		}else{
			$mensaje = "Su correo no se pudo enviar";
		}	
	}
	
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="formularios.css">
	<link href="https://fonts.googleapis.com/css2?family=Bakbak+One&display=swap" rel="stylesheet">
	<title> Contacto </title>
</head>
<body>

	<header>
		<div class="menu">	
			<nav>
				<ul>
					<li><a href="pagina.html">INICIO</a></li>
					<li><a href="form_login.php">LOGIN</a></li>
					<li><a href="form_registro">REGISTRARSE</a></li>
				</ul>
			</nav>	
		</div>
	</header>

	<p> <?php  	
 			
			?>
	</p>

	<?php if(isset($emailEnviado) && $emailEnviado==true) {  ?>
			<p> <?php echo $nombre.":  ".$mensaje; ?> </p>
	<?php } else { ?>			
				<div class="contacto">
					<form action="" method="get" autocomplete="off">
						
						<input type="text" placeholder="Nombre"  name="nombre" class="datos" required/>
						<br/><br/>
						<input type="text" placeholder="Email"  name="email" class="datos" required/>
						<br/><br/>
						<textarea name="msj" class="datos">  </textarea>
						<br/><br/>
					
						<input type="submit" class="boton" value="ENVIAR"/>

					</form>
				</div>	
	<?php } ?>
</body>
</html>