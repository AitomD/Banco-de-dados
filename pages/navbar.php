<?php
// Início do arquivo: iniciar sessão antes de qualquer saída
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Define variáveis para facilitar o uso
$usuario_logado = $_SESSION['nome_usuario'] ?? null;
?>

<style>
/* ... seu CSS atual ... */
</style>

<nav class="navbar navbar-expand-lg  position-relative mb-5">
    <div class="container-fluid px-3">
        <!-- Logo -->
        <a class="navbar-brand" href="index.php">
            <img src="img/logo2.png" alt="logo" class="me-4">
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
                    <a href="index.php" class="a-btn">HOME</a>
                </li>
                <li class="nav-item mx-2">
                    <a href="filmes" class="a-btn">FILMES</a>
                </li>
                <li class="nav-item mx-2">
                    <a href="series" class="a-btn">SÉRIES</a>
                </li>
            </ul>

            <!-- Auth Links - MOBILE -->
            <div class="auth-links-mobile d-lg-none">
                <?php if ($usuario_logado): ?>
                    <div class="dropdown text-center">
                        <a class="a-btn dropdown-toggle w-100" href="#" role="button"
                           id="dropdownMenuButtonMobile" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= htmlspecialchars($usuario_logado) ?>
                        </a>
                        <ul class="dropdown-menu w-100 text-center" aria-labelledby="dropdownMenuButtonMobile">
                            <li><a class="dropdown-item" href="fav">Favoritos</a></li>
                            <li><a class="dropdown-item" href="index.php?logout=1">Sair</a></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <a href="pages/login.php" class="text-light a-btn">LOGAR</a>
                    <a href="pages/cadastro.php">
                        <button type="button" class="neon-btn">CADASTRAR</button>
                    </a>
                <?php endif; ?>
            </div>

            <!-- Auth Links - DESKTOP -->
            <div class="auth-links-desktop d-none d-lg-flex align-items-center gap-2">
                <?php if ($usuario_logado): ?>
                    <div class="dropdown mt-2">
                        <a class="a-btn dropdown-toggle" type="button" id="dropdownMenuButtonDesktop"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user-circle fs-5"></i>
                            <?= htmlspecialchars($usuario_logado) ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonDesktop">
                            <li><a class="dropdown-item" href="fav">Favoritos</a></li>
                            <li><a class="dropdown-item" href="index.php?logout=1">Sair</a></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <a href="pages/login.php" class="text-light a-btn">LOGAR</a>
                    <a href="pages/cadastro.php">
                        <button type="button" class="neon-btn">CADASTRAR</button>
                    </a>
                <?php endif; ?>
            </div>
        </div>
</nav>

<script src="../js/dropdown.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
