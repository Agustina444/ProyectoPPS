<!DOCTYPE html>
<html>
    <head>
    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<title>LEMA Fit</title>
    	<link rel="stylesheet" type="text/css" href="./static/css/index.css">
    	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="index.css">
    </head>

    <body style="">
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
                    <img src="./static/img/clases-fitness.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Fitness</h5>
                        <p>Distintas disciplinas orientadas al acondicionamiento físico. GAP, Localizada, Zumba, Spinning, Funcional.</p>
                    </div>
                </div>

                <div class="carousel-item">
                    <img src="./static/img/musculatura.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Musculación</h5>
                        <p>Trabajá la fuerza y resistencia, desarrollando todos los grupos musculares. Prevení lesiones y mejorá tu calidad de vida.</p>
                    </div>
                </div>

                <div class="carousel-item">
                    <img src="./static/img/natacion.jpg" class="d-block w-100" alt="...">
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

        <section id="suscripcion" class="container-fluid">
    <!-- Fila para colocar el título y la tarjeta en la misma fila -->
    <div class="row justify-content-center">
        <!-- Columna para el título -->
        <div class="col-12 text-center">
            <h2>SUSCRIPCION MENSUAL</h2>
        </div>
        
        <!-- Columna para la tarjeta -->
        <div class="col-12 col-md-6 col-lg-4 d-flex justify-content-center">
            <div class="card card-custom" style="width: 18rem;">
                <img src="https://st2.depositphotos.com/5592054/8361/v/450/depositphotos_83612024-stock-illustration-woman-fitness.jpg" class="card-img-top" alt="Imagen de producto">
                <div class="card-body">
                    <h5 class="card-title text-center">Suscripción Mensual</h5>
                    <p class="card-text">$25000 por mes.</p>
                    <a href="https://mpago.la/28h9ssq" class="btn btn-danger">Comprar</a>
                </div>
            </div>
        </div>
    </div>
</section>



<div class="container mt-5">
    <!-- Título sobre los iconos -->
    <h1 class ="nuestras-redes">Nuestras Redes Sociales</h1>

    <!-- Fila de iconos -->
    <div class="row justify-content-center">
      <div class="col-4 text-center">
        <a href="https://www.facebook.com" target="_blank" class="social-icon">
          <i class="fab fa-facebook"></i>
        </a>
      </div>
      <div class="col-4 text-center">
        <a href="https://www.instagram.com" target="_blank" class="social-icon">
          <i class="fab fa-instagram"></i>
        </a>
      </div>
      <div class="col-4 text-center">
        <a href="https://www.youtube.com" target="_blank" class="social-icon">
          <i class="fab fa-youtube"></i>
        </a>
      </div>
    </div>
  </div>

  <div class="container mt-5">
  <h1 class="text-center instalaciones">Nuestras instalaciones</h1>

  <!-- Fila de imágenes -->
  <div class="row">
    <!-- Imagen 1 -->
    <div class="col-md-4 mb-4">
      <img src="https://cdn.shopify.com/s/files/1/0509/9552/7861/files/Equipo_de_gimnasio_para_musculacion.jpg?v=1653463349" alt="Imagen Fitness 1" class="img-fluid rounded">
    </div>

    <!-- Imagen 2 -->
    <div class="col-md-4 mb-4">
      <img src="https://mercadofitness.com/wp-content/uploads/2023/08/WhatsApp-Image-2023-07-24-at-18.06.30-1.jpeg" alt="Imagen Fitness 2" class="img-fluid rounded">
    </div>

    <!-- Imagen 3 -->
    <div class="col-md-4 mb-4">
      <img src="https://laverdadonline.com/wp-content/uploads/2019/01/26-1-zumba-1-1.jpg" alt="Imagen Fitness 3" class="img-fluid rounded">
    </div>

    <!-- Imagen 4 -->
    <div class="col-md-4 mb-4">
      <img src="https://www.multiusos.net/wp-content/uploads/2022/09/REFORMER4-scaled.jpg" alt="Imagen Fitness 4" class="img-fluid rounded">
    </div>

    <!-- Imagen 5 -->
    <div class="col-md-4 mb-4">
      <img src="https://img.freepik.com/fotos-premium/sala-piscina-vacia-clases-natacion-profesional-dia-soleado-verano_1206160-20.jpg?w=740" alt="Imagen Fitness 5" class="img-fluid rounded">
    </div>

    <!-- Imagen 6 -->
    <div class="col-md-4 mb-4">
      <img src="https://mercadofitness.com/wp-content/uploads/2020/02/Golds-Gym-de-Costa-Rica-reformo-las-salas-de-HIIT-en-sus-tres-sedes-1.jpg" alt="Imagen Fitness 6" class="img-fluid rounded">
    </div>
  </div>
</div>



  <div class="container mt-5">
  <!-- Título sobre los iconos -->
  <h1 class="nuestras-redes text-center">CONTACTANOS</h1>

  <!-- Fila de iconos -->
  <div class="row justify-content-center">
    <div class="col-12 mb-3">
      <a href="#" target="_blank" class="social-icon2 d-flex align-items-center">
        <!-- Ícono de WhatsApp y texto al lado -->
        <i class="fab fa-whatsapp"></i>
        <span class="ml-2 text-social">1127871891</span>
      </a>
    </div>
    <div class="col-12 mb-3">
      <a href="#" target="_blank" class="social-icon2 d-flex align-items-center">
        <!-- Ícono de Casa y texto al lado -->
        <i class="fas fa-house"></i>
        <span class="ml-2 text-social">Av. Eva peron 3457 </span>
      </a>
    </div>
    <div class="col-12 mb-3">
      <a href="#" target="_blank" class="social-icon2 d-flex align-items-center">
        <!-- Ícono de Dólar y texto al lado -->
        <i class="fas fa-dollar-sign"></i>
        <span class="ml-2 text-social">Informar pagos : lutinagym@gmail.com</span>
      </a>
    </div>
  </div>
</div>





        <!-- Popperjs -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
        <!-- Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>


 
