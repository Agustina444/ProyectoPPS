<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Nitro Gym </title>
	<link rel="stylesheet" type="text/css" href="static/css/index.css">
	<link href="https://fonts.googleapis.com/css2?family=Bakbak+One&display=swap" rel="stylesheet">
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
		</div>
	</section>

	<section id="ingresar">
		<div class="contenedor">
			<h2> AUN NO TIENES UNA CUENTA? </h2>
			<a href="/usuario/registro.php"> Regístrate </a>
		</div>
	</section>

</body>

</html>