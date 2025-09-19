<?php
session_start();
?>

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
    <link rel="stylesheet" href="../estilo/local.css">
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
        height: 350px;
        /* Ajusta a altura do carrossel */
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
        background-color: rgba(0, 0, 0, 0.4);
        /* escurece a imagem */
        z-index: 1;
        border-radius: 0.25rem;
        /* se a imagem tiver borda arredondada */
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
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
    }

    /* sombra forte no carrossel */
</style>

<?php include 'navbar.php' ?>

<main>
    <?php
    if (isset($_GET['param'])) {
        $param = $_GET['param'];
        // separa o parâmetro por "/"
        $p = explode("/", $param);
    } else {
        $p = [];
    }

    // página padrão
    $page = $p[0] ?? "home";

    // monta o caminho do arquivo
    $pagina = "pages/{$page}.php";

    // verifica se o arquivo existe
    if (file_exists($pagina)) {
        include $pagina;
    } else {
        include "pages/404.php";
    }
    ?>
</main>

<?php include 'footer.php'; ?>

<!-- Script para tooltip dos icones footer -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        tooltipTriggerList.forEach(el => new bootstrap.Tooltip(el));
    });
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
    crossorigin="anonymous"></script>

<script src="../js/home.js"></script>
<script src="../js/filmes.js"></script>
<script src="../js/series.js"></script>
<script src="../js/favoritos.js"></script>
</body>

</html>