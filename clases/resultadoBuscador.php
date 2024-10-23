<?php 

if(isset($_POST['buscar'])){
	$buscar = $_POST['buscar'];
	
	include '../lib/conexion.php';
	$consulta = mysqli_query(
		$conexion,
		"SELECT *
				FROM clases
				WHERE nombre LIKE '%$buscar%'");
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="formularios.css">
	<link href="https://fonts.googleapis.com/css2?family=Bakbak+One&display=swap" rel="stylesheet">
	<title> Resultado de búsqueda </title>
</head>
<body>

	<header>
		<?php include '../base/barra-nav.php'; ?>
	</header>

	<?php if(mysqli_num_rows($consulta)!=0){ ?>
		<p> Resultado de la búsqueda: </p>
		<?php while($recorroClases = mysqli_fetch_array($consulta)){ ?>
			<h3> <?php echo $recorroClases['nombre']." se dicta a las ". $recorroClases['horario']." hs " ?> </h3>
		<?php }
  	} else { ?>
  		<p> Resultado de la búsqueda: <?php echo $buscar ?> no existe </p>
  	<?php } ?>	

</body>
</html>