<?php
// Inicia a sessão na primeira linha
session_start();

// Define constantes para os caminhos, melhorando a organização
define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', __DIR__ . DS);
define('PAGES_PATH', ROOT_PATH . 'pages' . DS);

// Inclusão da barra de navegação antes do HTML, se necessário
include PAGES_PATH . 'navbar.php';
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
    <link rel="stylesheet" href="estilo/style.css">
    <link rel="stylesheet" href="estilo/form.css">
    <link rel="stylesheet" href="estilo/local.css">
    <link rel="stylesheet" href="estilo/input.css">
    <link rel="stylesheet" href="estilo/avaliar.css">
    <link rel="shortcut icon" href="img/logo2.png" type="image/x-icon">
</head>

<body>
    <main>
        <?php
        // Roteamento mais robusto
        $page = 'home'; // Página padrão
        
        // Verifica o parâmetro da URL
        if (isset($_GET['param'])) {
            // Limpa e sanitiza o parâmetro para evitar ataques
            $param = htmlspecialchars($_GET['param']);
            // Explode o parâmetro para pegar o nome da página
            $url_parts = explode('/', $param);
            $page = $url_parts[0];
        }

        // Constrói o caminho completo para o arquivo da página
        $file_path = PAGES_PATH . $page . '.php';

        // Verifica se a página existe e inclui
        if (file_exists($file_path) && is_file($file_path)) {
            include $file_path;
        } else {
            // Inclui a página de erro 404 se a página não for encontrada
            include PAGES_PATH . '404.php';
        }
        ?>
    </main>

    <?php
    // Inclui o rodapé
    include PAGES_PATH . 'footer.php';
    ?>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            tooltipTriggerList.forEach(el => new bootstrap.Tooltip(el));
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
        </script>
    <script src="js/home.js"></script>
    <script src="js/filmes.js"></script>
    <script src="js/series.js"></script>
    <script src="js/avaliarcard.js"></script>
    <script src="js/avaliar.js"></script>
    <script src="js/dropdown.js"></script>
    <script src="js/favoritos.js"></script>
</body>

</html>