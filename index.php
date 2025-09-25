<?php
// Inicia buffer e sessão
ob_start();
session_start();

// --- LOGOUT DIRETO ---
if (isset($_GET['logout'])) {
    $_SESSION = [];
    session_destroy();
    header("Location: index.php");
    exit;
}

// Constantes de caminho
define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', __DIR__ . DS);
define('PAGES_PATH', ROOT_PATH . 'pages' . DS);

// --- Resolve página atual com saneamento + whitelist ---
$page = 'home';
if (!empty($_GET['param'])) {
    $param = (string) $_GET['param'];
    $url_parts = explode('/', $param);
    $candidate = preg_replace('/[^a-zA-Z0-9_-]/', '', $url_parts[0]);

    // ajuste aqui a lista de páginas válidas
    $allowed = ['home','filmes','series','avaliar','login','cadastro','fav','perfil'];
    $page = in_array($candidate, $allowed, true) ? $candidate : '404';
}

// Caminho do arquivo da página
$file_path = PAGES_PATH . $page . '.php';
if (!is_file($file_path)) {
    $page = '404';
    $file_path = PAGES_PATH . '404.php';
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= htmlspecialchars(ucfirst($page)) ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet" href="estilo/style.css">
    <link rel="stylesheet" href="estilo/form.css">
    <link rel="stylesheet" href="estilo/local.css">
    <link rel="stylesheet" href="estilo/input.css">
    <link rel="stylesheet" href="estilo/avaliar.css">
    <link rel="shortcut icon" href="img/logo2.png" type="image/x-icon">
</head>
<body>

    <?php include PAGES_PATH . 'navbar.php'; ?>

    <main>
        <?php include $file_path; ?>
    </main>

    <?php include PAGES_PATH . 'footer.php'; ?>

    <!-- JS (sempre por último e com defer) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
            crossorigin="anonymous" defer></script>

    <?php
    // Scripts por página (evita null em elementos que não existem)
    $scriptsByPage = [
        'common'  => ['js/dropdown.js'],                // sempre
        'home'    => ['js/home.js','js/filmes.js','js/series.js'],
        'filmes'  => ['js/filmes.js'],
        'series'  => ['js/series.js'],
        'avaliar' => ['js/avaliar.js','js/avaliarcard.js'],
        // 'login' => ['js/login.js'],
        // 'perfil' => ['js/perfil.js'],
    ];
    $toLoad = array_merge($scriptsByPage['common'], $scriptsByPage[$page] ?? []);
    foreach ($toLoad as $src) {
        echo '<script src="'.htmlspecialchars($src, ENT_QUOTES, 'UTF-8').'" defer></script>' . PHP_EOL;
    }
    ?>

    <script defer>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
          .forEach(el => new bootstrap.Tooltip(el));
    });
    </script>
</body>
</html>
