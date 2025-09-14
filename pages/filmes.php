<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filmes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../estilo/style.css">
    <link rel="stylesheet" href="../estilo/local.css">
    <link rel="shortcut icon" href="../Icons/fs.png" type="image/x-icon">
</head>
<body>

    <?php include 'navbar.php'; ?>

    <div class="alto" style="height: 100px;"></div>

    <div class="container my-4">

        <!-- Card modelo escondido -->
        <div id="card-modelo" class="col d-none">
            <div class="card h-100 bg-main text-light border-0">
                <img src="" class="card-img-top poster" alt="Poster">
                <div class="card-body d-flex flex-column">
                    <span class="badge bg-primary mb-2">Filme</span>
                    <h5 class="card-title titulo">Título</h5>
                    <p class="card-text descricao">Descrição</p>

                    <div class="mt-auto d-flex flex-column">
                        <div>
                            <i class="fa-solid fa-star text-warning"></i>
                            <span class="nota">0.0</span>
                        </div>

                        <!-- Botão Avaliar já no HTML -->
                        <button class="btn btn-outline-warning btn-sm mt-2 avaliar-btn">
                            <i class="fa-solid fa-star"></i> Avaliar
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fim card modelo -->
        <div class="alto" style="height: 10px;"></div>

        <!-- Gênero Ação -->
        <h2 class="mb-3 text-light text-center ">Ação</h2>
        <div id="acao" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4"></div>

        <!-- Gênero Comédia -->
        <div class="alto" style="height: 10px;"></div>
        <h2 class="mb-3 text-light text-center">Comédia</h2>
        <div id="comedia" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 mt-5"></div>

        <!-- Gênero Drama -->
        <div class="alto" style="height: 10px;"></div>   
        <h2 class="mb-3 text-light text-center">Drama</h2>
        <div id="drama" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 mt-5"></div>

        <!-- Gênero Animação -->
        <div class="alto" style="height: 10px;"></div>   
        <h2 class="mb-3 text-light text-center">Animação</h2>
        <div id="animacao" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 mt-5"></div>
    </div>

    <!-- Modal de Avaliação -->
<div class="modal fade" id="modalFilme" tabindex="-1" aria-labelledby="modalFilmeLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-main bg-dark">
      <div class="modal-header">
        <h5 class="modal-title" id="modalFilmeLabel">Título do Filme</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body d-flex gap-3">
        <img src="" id="modalPoster" class="img-fluid" style="max-width: 200px;" alt="Poster">
        <div>
          <p id="modalSinopse">Sinopse completa do filme...</p>
          <p>Nota atual: <span id="modalNota">0.0</span> <i class="fa-solid fa-star text-warning"></i></p>
          <div id="avaliacaoEstrelas" class="mt-3">
            <span class="estrela btn btn-outline-warning btn-sm me-1" data-valor="1">★</span>
            <span class="estrela btn btn-outline-warning btn-sm me-1" data-valor="2">★</span>
            <span class="estrela btn btn-outline-warning btn-sm me-1" data-valor="3">★</span>
            <span class="estrela btn btn-outline-warning btn-sm me-1" data-valor="4">★</span>
            <span class="estrela btn btn-outline-warning btn-sm" data-valor="5">★</span>
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

    <script src="../js/filmes.js"></script>
</body>

</html>
