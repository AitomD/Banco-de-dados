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


    <div class="container my-4">
        <!-- Gênero Ação -->
        <h2 class="mb-3">Ação</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            <div class="col">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/300x400" class="card-img-top" alt="Capa do Filme">
                    <div class="card-body">
                        <h5 class="card-title">Filme de Ação 1</h5>
                        <p class="card-text">Um herói enfrenta grandes desafios para salvar o mundo.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/300x400" class="card-img-top" alt="Capa do Filme">
                    <div class="card-body">
                        <h5 class="card-title">Filme de Ação 2</h5>
                        <p class="card-text">Explosões, perseguições e muita adrenalina.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/300x400" class="card-img-top" alt="Capa do Filme">
                    <div class="card-body">
                        <h5 class="card-title">Filme de Ação 3</h5>
                        <p class="card-text">Uma missão impossível em território inimigo.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gênero Comédia -->
        <h2 class="mt-5 mb-3">Comédia</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            <div class="col">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/300x400" class="card-img-top" alt="Capa do Filme">
                    <div class="card-body">
                        <h5 class="card-title">Comédia 1</h5>
                        <p class="card-text">Situações hilárias em uma aventura inesperada.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/300x400" class="card-img-top" alt="Capa do Filme">
                    <div class="card-body">
                        <h5 class="card-title">Comédia 2</h5>
                        <p class="card-text">Uma turma de amigos apronta todas.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php include 'footer.php';  ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>

    <script src="../js/home.js"></script>
</body>

</html>