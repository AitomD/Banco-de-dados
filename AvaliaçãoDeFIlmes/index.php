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
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" al
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                <ul class="navbar-nav d-flex align-items-center gap-2">
                    <li class="nav-item mx-2">
                        <a href="pages/home.php"><button class="neon-btn">HOME</button></a>
                    </li>
                    <li class="nav-item mx-2">
                        <a href="#"><button class="neon-btn">SUPORTE</button></a>
                    </li>

                    <!-- Dropdown SÉRIES -->
                    <li class="nav-item dropdown mx-2">
                        <button class="neon-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            SÉRIES
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item active" href="#">Ação</a></li>
                            <li><a class="dropdown-item" href="#">Comédia</a></li>
                            <li><a class="dropdown-item" href="#">Drama</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Mais</a></li>
                        </ul>
                    </li>

                    <!-- Dropdown FILMES -->
                    <li class="nav-item dropdown mx-2   ">
                        <button class="neon-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            FILMES
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item active" href="#">Ação</a></li>
                            <li><a class="dropdown-item" href="#">Comédia</a></li>
                            <li><a class="dropdown-item" href="#">Drama</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Mais</a></li>
                        </ul>
                    </li>

                    <!-- Search -->
                    <li class="nav-item mx-5">
                        <div class="input-box d-flex align-items-center">
                            <input class="form-control-sm " type="search" placeholder="Pesquisar..." aria-label="Search"
                                style="height: 40px; width: 500px; border-radius: 8px" />
                            <i class="fa-solid fa-magnifying-glass me-1 "></i>
                        </div>
                    </li>
                </ul>
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


    <footer class="footer py-4 fixed-bottom">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between">

                <!-- Coluna 1 -->
                <div class="mb-3 mb-md-0">
                    <h5>Sobre Nós</h5>
                    <div class="row">
                        <div class="d-inline-flex align-items-center">
                            <p class="mb-1 me-3">Aitom Henrique Donatoni </p>
                            <a href="#" class="text-light fs-5 me-3"><i class="fab fa-instagram" data-bs-toggle="tooltip" title="Instagram"></i></i></a>
                            <a href="#" class="text-light fs-5 me-3"><i class="fab fa-github" data-bs-toggle="tooltip" title="GitHub"></i></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="d-inline-flex align-items-center">
                            <p class="mb-1 me-3">Fernando Consolin Rosa</p>
                            <a href="#" class="text-light fs-5 me-3"><i class="fab fa-instagram" data-bs-toggle="tooltip" title="Instagram"></i></i></a>
                            <a href="#" class="text-light fs-5 me-3"><i class="fab fa-github" data-bs-toggle="tooltip" title="GitHub"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Coluna 2 -->
                <div>
                    <h5>Contato</h5>
                    <ul class="list-unstyled mb-0">
                        <li>Email: contato@exemplo.com</li>
                        <li>Telefone: (11) 1234-5678</li>
                        <li>Endereço: Rua Exemplo, 123</li>
                    </ul>
                </div>

            </div>
        </div>
    </footer>

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

</body>

</html>