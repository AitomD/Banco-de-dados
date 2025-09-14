<?php

// A lógica de login/usuário pode vir aqui antes
// por exemplo, para verificar se $isLoggedIn está definido
$isLoggedIn = false; // Exemplo: Defina como true após o login
$usuarioNome = "Nome do Usuário"; // Exemplo: Obtenha do banco de dados

// Lógica de roteamento
$page = 'home'; // Página padrão caso nenhum parâmetro seja passado

if (isset($_GET['param'])) {
    $param = explode("/", $_GET['param']);
    $page = $param[0] ?? 'home';
}

// Caminho para a página a ser incluída
$path = __DIR__ . "/pages/{$page}.php";

// Verifica se o arquivo da página existe e não é a página de erro
if (file_exists($path) && $page !== '404') {
    include $path;
} else {
    // Se a página não existir ou for a 404, inclui a página de erro
    include __DIR__ . "../pages/404.php";
}

?>
