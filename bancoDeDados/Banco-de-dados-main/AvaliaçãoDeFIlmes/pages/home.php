<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../estilo/style.css">
  <link rel="stylesheet" href="../estilo/form.css">
</head>

<body>


  <?php include 'navbar.php'; ?>


  <div class="alto" style="height: 100px;"></div>

  <!-- Carrosel de fotos e notas -->
  <div class="carrossel-wrapper">
    <div class="carrossel-container">
      <div class="carrossel-item">
        <img src="../img/batman.jpg" alt="">
        <i class="fa-solid fa-star icone-sobre-imagem"></i>
        <h4 class="nota-item">4.5</h4>
      </div>
      <div class="carrossel-item">
        <img src="../img/coringa.jpg" alt="">
        <i class="fa-solid fa-star icone-sobre-imagem"></i>
        <h4 class="nota-item">5.5</h4>
      </div>
      <div class="carrossel-item">
        <img src="../img/batman.jpg" alt="">
        <i class="fa-solid fa-star icone-sobre-imagem"></i>
        <h4 class="nota-item">6.7</h4>
      </div>
      <div class="carrossel-item">
        <img src="../img/coringa.jpg" alt="">
        <i class="fa-solid fa-star icone-sobre-imagem"></i>
        <h4 class="nota-item">8.2</h4>

      </div>
      <div class="carrossel-item">
        <img src="../img/batman.jpg" alt="">
        <i class="fa-solid fa-star icone-sobre-imagem"></i>
        <h4 class="nota-item">4.9</h4>

      </div>
      <div class="carrossel-item">
        <img src="../img/coringa.jpg" alt="">
        <i class="fa-solid fa-star icone-sobre-imagem"></i>
        <h4 class="nota-item">4.4</h4>

      </div>
      <div class="carrossel-item">
        <img src="../img/batman.jpg" alt="">
        <i class="fa-solid fa-star icone-sobre-imagem"></i>
        <h4 class="nota-item">7.4</h4>

      </div>
      <div class="carrossel-item">
        <img src="../img/coringa.jpg" alt="">
        <i class="fa-solid fa-star icone-sobre-imagem"></i>
        <h4 class="nota-item">8.1</h4>

      </div>
    </div>
  </div>

  <div class="alt" style="height: 70px;";></div>

<div class="container my-4">
  <div class="row">
    <!-- Carrossel principal -->
    <div class="col-12 mb-4">
      <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="../img/banner.png" class="d-block w-100 rounded img-fluid" 
                 alt="Filme 1" style="height: 400px; object-fit: cover;">
            <div class="carousel-caption d-none d-md-block">
              <h2>Filme 1</h2>
            </div>
          </div>
          <div class="carousel-item">
            <img src="../img/banner1.jpeg" class="d-block w-100 rounded img-fluid" 
                 alt="Filme 2" style="height: 400px; object-fit: cover;">
            <div class="carousel-caption d-none d-md-block">
              <h2>Filme 2</h2>
            </div>
          </div>
          <div class="carousel-item">
            <img src="../img/banner.png" class="d-block w-100 rounded img-fluid" 
                 alt="Filme 3" style="height: 400px; object-fit: cover;">
            <div class="carousel-caption d-none d-md-block">
              <h2>Filme 3</h2>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
          <span class="carousel-control-prev-icon"></span>
          <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
          <span class="carousel-control-next-icon"></span>
          <span class="visually-hidden">Próximo</span>
        </button>
      </div>
    </div>

    <!-- Cards abaixo -->
    <div class="col-12">
      <h4 class="textlightblue">A seguir</h4>
      <hr class="font-lightblue my-2">
      <div class="row g-3">
        <!-- Card 1 -->
        <div class="col-md-4">
          <div class="card text-light border-0">
            <img src="../img/banner.png" alt="..." class="card-img-top img-fluid" style="object-fit: cover; height: 250px;">
            <div class="card-body bg-main">
              <h5 class="card-title">FILME EXEMPLO 1</h5>
              <p class="card-text">Descrição do filme 1.</p>
              <button class="neon-btn">Assistir</button>
            </div>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="col-md-4">
          <div class="card text-light border-0">
            <img src="../img/banner.png" alt="..." class="card-img-top img-fluid" style="object-fit: cover; height: 250px;">
            <div class="card-body bg-main">
              <h5 class="card-title">FILME EXEMPLO 2</h5>
              <p class="card-text">Descrição do filme 2.</p>
              <button class="neon-btn">Assistir</button>
            </div>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="col-md-4">
          <div class="card text-light border-0">
            <img src="../img/banner.png" alt="..." class="card-img-top img-fluid" style="object-fit: cover; height: 250px;">
            <div class="card-body bg-main">
              <h5 class="card-title">FILME EXEMPLO 3</h5>
              <p class="card-text">Descrição do filme 3.</p>
              <button class="neon-btn">Assistir</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php include 'footer.php'; ?>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
    crossorigin="anonymous"></script>

    <script src="../js/home.js"></script>
</body>

</html>