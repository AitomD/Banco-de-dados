<?php
session_start(); // deve estar no topo, sem espaços antes

require_once '../includes/db.php';
require_once '../includes/log.php';

$nome     = trim($_POST['nome'] ?? '');
$email    = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$senha    = trim($_POST['senha'] ?? '');
$telefone = trim($_POST['telefone'] ?? '');

if (empty($nome) || empty($email) || empty($senha) || empty($telefone)) {
    die("Todos os campos são obrigatórios!");
}

$db = new DB();
$pdo = $db->getConnection();

$user = new User($pdo);
$user->nome     = $nome;
$user->email    = $email;
$user->senha    = $senha;
$user->telefone = $telefone;

if ($user->register()) {
    // Redireciona para a página inicial do site
    header("Location: ../index.php");
    exit;
} else {
    die("Erro ao cadastrar usuário! Verifique se o email já está em uso ou se o telefone é válido.");
}

