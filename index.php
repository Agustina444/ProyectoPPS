<!DOCTYPE html>
<html>
    <head>
    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<title>LEMA Fit</title>
    	<link rel="stylesheet" type="text/css" href="static/css/index.css">
    	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>
        <nav class="navbar navbar-expand-sm navbar-dark" style="background-color: black;">
            <a class="navbar-brand ml-1 mb-0 h1" href="/index.php" style="margin-left: 50px;">LEMA Fit</a>
            <!-- Menu hamburgesa -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Items -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="navbar-nav ms-auto" style="margin-right: 50px;">
                    <a class="nav-link text-light" href="/sede.php">Conocé nuestro gym</a>
                    <a class="nav-link text-light" href="/clases/lista.php">Clases</a>
                    <a class="nav-link text-light" href="/usuario/registro.php">Registrate</a>
                    <a class="nav-link text-light" href="/usuario/login.php">Inicia Sesión</a>

                </div>
            </div>
        </nav>
        <!-- Barra de navegacion -->
        <?php include 'lib/barra_nav.php'; ?>

    	<header>
    		<div class="contenedor-titulo">
    			<h1> POTENCIAMOS TU <br /> <span class ="bienestar">BIENESTAR </span></h1>
    			<p><a href="/clases/reservar.php"> Comenzá a reservar tus clases </a></p>
    		</div>
    	</header>

    	<h2> TODAS LAS ACTIVIDADES <br /> QUE BUSCAS </h2>
    	<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="/static/img/clases-fitness.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Fitness</h5>
                        <p>Distintas disciplinas orientadas al acondicionamiento físico. GAP, Localizada, Zumba, Spinning, Funcional.</p>
                    </div>
                </div>

                <div class="carousel-item">
                    <img src="/static/img/musculatura.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Musculación</h5>
                        <p>Trabajá la fuerza y resistencia, desarrollando todos los grupos musculares. Prevení lesiones y mejorá tu calidad de vida.</p>
                    </div>
                </div>

                <div class="carousel-item">
                    <img src="/static/img/natacion.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Natación</h5>
                        <p>Disfrutá de todos los beneficios de nadar, mejorá tu aparato respiratorio y cardiovascular. Contamos con piletas cubiertas y al aire libre.</p>
                    </div>
                </div>    
            </div>

            <a class="carousel-control-prev" href="#carouselExampleIndicators" type="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </a>

            <a class="carousel-control-next" href="#carouselExampleIndicators" type="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </a>
        </div>

    	<section id="ingresar">
    		<div class="contenedor">
    			<h2> AUN NO TIENES UNA CUENTA? </h2>
    			<p><a href="/usuario/registro.php"> Regístrate </a></p>
    		</div>
    	</section>

        <!-- Popperjs -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
        <!-- Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>