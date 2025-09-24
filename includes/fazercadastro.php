<?php
// Inicia a sessão apenas se não estiver ativa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/log.php';

// Se o usuário já estiver logado, redireciona para index.php
if (isset($_SESSION['id_usuario'])) {
    header("Location: ../index.php");
    exit;
}

$erro = "";

// Se o formulário de cadastro foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome     = trim($_POST['nome'] ?? '');
    $email    = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha    = trim($_POST['senha'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');

    if (empty($nome) || empty($email) || empty($senha) || empty($telefone)) {
        $erro = "Todos os campos são obrigatórios!";
    } else {
        $db = new DB();
        $pdo = $db->getConnection();

        $user = new User($pdo);
        $user->nome     = $nome;
        $user->email    = $email;
        $user->senha    = $senha;
        $user->telefone = $telefone;

        if ($user->register()) {
            // Cadastro realizado → redireciona para a página inicial
            header("Location: ../index.php");
            exit;
        } else {
            $erro = "Erro ao cadastrar. Verifique se o email já está em uso ou se o telefone é válido.";
        }
    }
}

// Se chegou aqui, exibe o formulário de cadastro
