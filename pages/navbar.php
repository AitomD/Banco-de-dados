<style>
/* Em telas menores que 992px (breakpoint lg do Bootstrap) */
@media (max-width: 991.98px) {
    /* Esconde os botões fora do collapse */
    .navbar > .container-fluid > .auth-links {
        display: none !important;
    }

    /* Garante que dentro do collapse apareçam */
    #navbarSupportedContent .a-btn,
    #navbarSupportedContent .neon-btn {
        display: inline-block !important;
        width: 100%;
        text-align: center;
        margin: 5px 0;
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
    }

    .navbar-collapse {
        margin-top: 15px;
    }
}
</style>

<nav class="navbar navbar-expand-lg">
    <div class="container-fluid mx-5">
        <!-- Logo -->
        <a class="navbar-brand" href="../pages/home.php">
            <img src="../img/logo2.png" alt="logo" class="me-4">
        </a>

        <!-- Hamburguer -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
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

            <!-- Botões Login e Cadastro (separados) -->
            <div class="auth-links d-flex align-items-center gap-2">
                <a href="login.php" class="text-light a-btn">LOGAR</a>
                <a href="cadastro.php">
                    <button type="button" class="neon-btn">CADASTRAR</button>
                </a>
            </div>
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
