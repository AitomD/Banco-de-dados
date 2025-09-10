<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Star</title>
    <link rel="shortcut icon" href="starlogo.png" type="image/x-icon">
    <link rel="stylesheet" href="estilo/style.css">
    <link rel="stylesheet" href="estilo/form.css">
    <link rel="stylesheet" href="estilo/avaliar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
    </style>

</head>

<body>

    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid mx-5">
            <a class="navbar-brand" href="../pages/home.php">
                <img src="../img/logo2.png" alt="logo" class="me-4">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

   
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid mx-5">
            <a class="navbar-brand" href="../pages/home.php">
                <img src="../img/logo2.png" alt="logo" class="me-4">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                <ul class="navbar-nav d-flex align-items-center gap-2">
                    <li class="nav-item mx-2">
                        <a href="../pages/home.php" class="a-btn">HOME</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a href="../pages/filmes.php" class="a-btn">FILMES</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a href="../pages/series.php" class="a-btn">SÉRIES</a>
                    </li>
                    <li class="nav-item mx-5">
                        <div class="input-box d-flex align-items-center">
                            <input class="form-control-sm" type="search" placeholder="Pesquisar..." aria-label="Search"
                                style="height: 40px; width: 500px; border-radius: 8px" />
                            <i class="fa-solid fa-magnifying-glass me-1"></i>
                        </div>
                    </li>
                </ul>
            </div>

            <?php if ($isLoggedIn): ?>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo htmlspecialchars($usuarioNome); ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="../pages/perfil.php">Perfil</a></li>
                        <li><a class="dropdown-item" href="../logout.php">Sair</a></li>
                    </ul>
                </div>
            <?php else: ?>
                <a href="../pages/cadastro.php" class="text-light mx-4 a-btn">LOGAR</a>
                <a href="../pages/login.php">
                    <button type="button" class="neon-btn text-end">CADASTRAR</button>
                </a>
            <?php endif; ?>
        </div>
    </nav>

    <main>

        <?php
        
        if (isset($_GET['param'])) {
            $param = $_GET['param'];
            //separar o parametor por /
            $p = explode("/", $param);
            //print_r($_GET);
        }
        $page = $p[0] ?? "home";
        $ofertas = $p[1] ?? "filmes";

        if ($page == "filmes") {
            $pagina = "/pages/{$filmes}.php";
        } else {
            $pagina = "/pages/{$page}.php";
        }
        //verificar se a página existe
        if (file_exists($pagina)) {
            include $pagina;
        } else {
            include "/pages/erro.php";
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

</body>

</html>