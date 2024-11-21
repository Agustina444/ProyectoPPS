<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="static/css/index.css">
	<link href="https://fonts.googleapis.com/css2?family=Bakbak+One&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
	<title>LEMA Fit</title>
</head>

<body>
	
	<header>
		<?php include 'lib/barra_nav.php'; ?>
		<div class="contenedor-titulo">
			<h1> POTENCIAMOS TU <br /> BIENESTAR </h1>
			<a href="/clases/reservar.php"> Comenzá a reservar tus clases </a>
		</div>
	</header>

	<section id="actividades">
		<div class="contenedor">
			<br><br>
			<h2> TODAS LAS ACTIVIDADES <br /> QUE BUSCAS </h2>
			<div class="contenedorActividades">
				<div class="clases">
					<img src="/static/img/fitness.jpg">
					<h3> Fitness </h3>
					<p> Distintas disciplinas orientadas al acondicionamiento físico. GAP, Localizada, Zumba, Spinning,
						Funcional. </p>
				</div>
				<div class="clases">
					<img src="/static/img/musculacion.jpg">
					<h3> Musculación</h3>
					<p>Trabajá la fuerza y resistencia, desarrollando todos los grupos musculares. Prevení lesiones y
						mejorá tu calidad de vida. </p>
				</div>
				<div class="clases">
					<img src="/static/img/natacion.png">
					<h3> Natación </h3>
					<p> Disfrutá de todos los beneficios de nadar, mejorá tu aparato respiratorio y cardiovascular.
						Contamos con piletas cubiertas y al aire libre.</p>
				</div>
				<div class="clases">
					<img src="/static/img/yoga.jpg">
					<h3> Cuerpo y mente </h3>
					<p> Respirá, relajá tu mente y mejorá tu movilidad articular. Pilates, yoga y stretching,
						actividades orientadas a encontrar tu bienestar integral.</p>
				</div>
			</div>
			<br><br>
		</div>
	</section>

	<section id="ingresar">
		<div class="contenedor">
			<h2> AUN NO TIENES UNA CUENTA? </h2>
			<a href="/usuario/registro.php"> Regístrate </a>
		</div>
	</section>
		
	<!-- jQuery -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>