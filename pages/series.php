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
    <link rel="stylesheet" href="../estilo/form.css">
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="alto" style="height: 100px;"></div>

    <div class="container my-4">
        <!-- Gênero Ação -->
        <h2 class="mb-3 text-light">Ação</h2>
        <div id="acao" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            <!-- Filmes de Ação (16 máx) serão carregados pelo JS -->
        </div>

        <!-- Gênero Comédia -->
        <h2 class="mt-5 mb-3 text-light">Comédia</h2>
        <div id="comedia" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            <!-- Filmes de Comédia (16 máx) serão carregados pelo JS -->
        </div>

        <!-- Gênero Drama -->
        <h2 class="mt-5 mb-3 text-light">Drama</h2>
        <div id="drama" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            <!-- Filmes de Drama (16 máx) serão carregados pelo JS -->
        </div>

        <!-- Gênero Animação -->
        <h2 class="mt-5 mb-3 text-light">Animação</h2>
        <div id="animacao" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            <!-- Filmes de Animação (16 máx) serão carregados pelo JS -->
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>

    <script src="../js/filmes.js"></script>
</body>

</html>
