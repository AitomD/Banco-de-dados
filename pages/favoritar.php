<?php
if (session_status() === PHP_SESSION_NONE) session_start();

require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/fav.php';

if (!isset($_SESSION['id_usuario'])) {
    echo json_encode(["status"=>"erro","msg"=>"Você precisa estar logado!"]);
    exit;
}

$id_usuario = $_SESSION['id_usuario'];
$id_filme   = $_POST['id_filme'] ?? null;
$poster     = $_POST['poster'] ?? '';

if (!$id_filme) {
    echo json_encode(["status"=>"erro","msg"=>"ID do filme não enviado!"]);
    exit;
}

$db = new DB();
$conn = $db->getConnection();

$fav = new Fav($conn);
$fav->id_usuario = $id_usuario;
$fav->id_filme   = $id_filme;
$fav->poster     = $poster;

if ($fav->existe()) {
    $fav->remove();
    $acao = "removido";
} else {
    $fav->add();
    $acao = "adicionado";
}

echo json_encode([
    "status" => "ok",
    "acao"   => $acao,
    "id_filme" => $id_filme,
    "poster"   => $poster
]);
