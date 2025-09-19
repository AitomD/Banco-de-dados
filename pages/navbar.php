<style>
    /* Em telas menores que 992px (breakpoint lg do Bootstrap) */
    @media (max-width: 991.98px) {

        /* Esconde os botões fora do collapse */
        .navbar>.container-fluid>.auth-links-desktop {
            display: none !important;
        }

        /* Dentro do collapse, mostrar links e botões centralizados */
        #navbarSupportedContent .a-btn,
        #navbarSupportedContent .neon-btn {
            display: inline-block !important;
            width: 100%;
            text-align: center;
            margin: 5px 0;
        }

        #navbarSupportedContent .auth-links-mobile {
            display: flex !important;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            margin-top: 15px;
        }

        #navbarSupportedContent {
            background-color: #021526;
            padding: 15px;
            border-radius: 8px;
        }

        .navbar .container-fluid {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            margin: 0;
        }

        .navbar-toggler {
            margin-left: auto;
            color: white;
        }

        .navbar-collapse {
            margin-top: 15px;
        }

        .navbar {
            height: auto;
            position: relative;
        }
    }

    /* Ícone do botão hamburguer em branco */
    .navbar .navbar-toggler-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='white' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
    }
</style>

<nav class="navbar navbar-expand-lg  position-relative mb-5">
    <div class="container-fluid px-3">
        <!-- Logo -->
        <a class="navbar-brand" href="../pages/home.php">
            <img src="../img/logo2.png" alt="logo" class="me-4">
        </a>

        <!-- Hamburguer -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse justify-content-center p-3" id="navbarSupportedContent">
            <!-- Links centrais -->
            <ul class="navbar-nav d-flex align-items-center gap-2 mx-auto">
                <li class="nav-item mx-2">
                    <a href="../pages/home.php" class="a-btn">HOME</a>
                </li>
                <li class="nav-item mx-2">
                    <a href="../pages/filmes.php" class="a-btn">FILMES</a>
                </li>
                <li class="nav-item mx-2">
                    <a href="../pages/series.php" class="a-btn">SÉRIES</a>
                </li>
            </ul>

            <!-- Auth Links - Versão MOBILE -->
            <div class="auth-links-mobile d-lg-none">
                <?php if (isset($_SESSION['usuario_nome'])): ?>
                    <div class="dropdown text-center">
                        <button class="btn btn-secondary dropdown-toggle w-100" type="button" id="dropdownMenuButtonMobile"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>
                        </button>
                        <ul class="dropdown-menu w-100 text-center" aria-labelledby="dropdownMenuButtonMobile">
                            <li><a class="dropdown-item" href="../pages/fav.php">Favoritos</a></li>
                            <li><a class="dropdown-item" href="../pages/logout.php">Sair</a></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <a href="../pages/login.php" class="text-light a-btn">LOGAR</a>
                    <a href="../pages/cadastro.php">
                        <button type="button" class="neon-btn">CADASTRAR</button>
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Auth Links - Versão DESKTOP -->
        <div class="auth-links-desktop d-none d-lg-flex align-items-center gap-2">
            <?php if (isset($_SESSION['usuario_nome'])): ?>
                <div class="dropdown mt-2">
                    <a class="a-btn dropdown-toggle" type="button" id="dropdownMenuButtonDesktop" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa-solid fa-user-circle fs-5"></i>
                        <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonDesktop">
                        <li><a class="dropdown-item " href="../pages/fav.php">Favoritos</a></li>
                        <li><a class="dropdown-item" href="../pages/logout.php">Sair</a></li>
                    </ul>
                </div>
            <?php else: ?>
                <a href="../pages/login.php" class="text-light a-btn">LOGAR</a>
                <a href="../pages/cadastro.php">
                    <button type="button" class="neon-btn">CADASTRAR</button>
                </a>
            <?php endif; ?>

        </div>
    </div>
</nav>
<script src="../js/dropdown.js"></script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>