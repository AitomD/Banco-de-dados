<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Star</title>
    <link rel="shortcut icon" href="starlogo.png" type="image/x-icon">
    <link rel="stylesheet" href="estilo/style.css">
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
    <nav class="navbar navbar-expand-lg ">
        <div class="container-fluid mx-5">
            <a class="navbar-brand " href="pages/home.php"><img src="img/logo2.png" alt="logo" class="me-4"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item  mx-2">
                        <a class="nav-link" aria-current="page" href="#">HOME</a>
                    </li>
                    <li class="nav-item  mx-2">
                        <a class="nav-link" aria-current="page" href="#">SÉRIES</a>
                    </li>
                    <li class="nav-item  mx-2">
                        <a class="nav-link" aria-current="page" href="#">FILMES</a>
                    </li>
                </ul>
                <div class="input-box">
                    <input class="form-control me-2 w-100" type="search" placeholder="Search" aria-label="Search" />
                    <a href=""><i class="fa-solid fa-magnifying-glass"></i></a>
                </div>



                <!-- Teste de botoes com links para paginas de cadastro e login-->

                <a href="pages/cadastro.php" target="_blank">
                    <button type="button" class=" neon-btn mx-4 text-end">CADASTRAR</button>
                </a>
                <a href="pages/login.php" target="_blank">
                    <button type="button" class=" neon-btn mx-4 text-end">LOGAR</button>
                </a>
            </div>
        </div>
    </nav>


    <footer class="footer fixed-bottom">
        <a href="https://github.com/AitomD/Banco-de-dados">
            <img src="img/github.png" alt="Repositório" style="width: 40px; padding: 5px">
        </a>
        <p>Desenvolvido por Aitom Donatoni e Fernando Consolin</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>

</body>

</html>