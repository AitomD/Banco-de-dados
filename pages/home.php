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

  <link rel="shortcut icon" href="../img/logo2.png" type="image/x-icon">

  <link rel="shortcut icon" href="../Icons/home.png" type="image/x-icon">

</head>
<style>
  .input-box {
    position: relative;
    width: 300px;
    margin: auto;
  }

  .input-box i {
    position: absolute;
    top: 50%;
    left: 10px;
    transform: translateY(-50%);
    color: #888;
  }

  .input-box input {
    width: 100%;
    padding: 10px 10px 10px 35px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }
  /* Carrossel principal */
#carouselExampleFade .carousel-item {
  position: relative;
}

#carouselExampleFade .carousel-item img.carousel-img {
  height: 350px; /* Ajusta a altura do carrossel */
  object-fit: cover;
  width: 100%;
}

/* Overlay escuro semi-transparente */
#carouselExampleFade .overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.4); /* escurece a imagem */
  z-index: 1;
  border-radius: 0.25rem; /* se a imagem tiver borda arredondada */
}

/* Título do filme acima do overlay */
.carousel-caption {
  position: absolute;
  z-index: 2;
  bottom: 20%;
  left: 50%;
  transform: translateX(-50%);
  text-align: center;
}

.carousel-caption h2 {
  font-size: 2rem;
  font-weight: bold;
  color: #fff;
  text-shadow: 2px 2px 8px rgba(0,0,0,0.7);
}

</style>

<body>

  <?php include 'navbar.php' ?>

  <!-- Conteudo do HOME -->

  <div class="alto" style="height: 100px;"></div>

  <!-- Carrosel de fotos e notas -->
  
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
      <h4 class="text-light text-center fs-3">A SEGUIR</h4>
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



  <!-- 
  <footer class="footer py-4 end-line">
    <div class="container">
      <div class="d-flex flex-column flex-md-row justify-content-between">

        <div class="mb-3 mb-md-0">
          <h5>Sobre Nós</h5>
          <div class="row">
            <div class="d-inline-flex align-items-center">
              <p class="mb-1 me-3">Aitom Henrique Donatoni </p>
              <a href="#" class="text-light fs-5 me-3"><i class="fab fa-instagram" data-bs-toggle="tooltip"
                  title="Instagram"></i></i></a>
              <a href="#" class="text-light fs-5 me-3"><i class="fab fa-github" data-bs-toggle="tooltip"
                  title="GitHub"></i></a>
            </div>
          </div>
          <div class="row">
            <div class="d-inline-flex align-items-center">
              <p class="mb-1 me-3">Fernando Consolin Rosa</p>
              <a href="#" class="text-light fs-5 me-3"><i class="fab fa-instagram" data-bs-toggle="tooltip"
                  title="Instagram"></i></i></a>
              <a href="#" class="text-light fs-5 me-3"><i class="fab fa-github" data-bs-toggle="tooltip"
                  title="GitHub"></i></a>
            </div>
          </div>
        </div>

        -- Coluna 2 -->
        
    <?php include 'footer.php'; ?>

  <!-- Script para tooltip dos icones footer -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
      tooltipTriggerList.forEach(el => new bootstrap.Tooltip(el));
    });
  </script>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
    crossorigin="anonymous"></script>

    <script src="../js/home.js"></script>
</body>

</html>