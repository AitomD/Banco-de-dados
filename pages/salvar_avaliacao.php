<?php
session_start();
require_once "../includes/db.php"; // ajuste o caminho para o seu arquivo de conexão

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    echo "logado"; 
    exit;
}

$id_usuario = $_SESSION['usuario_id'];
$id_filmeserie = $_POST['id_filmeserie'] ?? null;
$nota = $_POST['nota'] ?? null;
$comentario = $_POST['comentario'] ?? null;

// Validação dos campos
if (empty($id_filmeserie) || empty($nota) || empty($comentario)) {
    echo "Preencha todos os campos";
    exit;
}

try {
    // Prepara a query para salvar a avaliação
    $sql = "INSERT INTO avaliacoes (id_usuario, id_filmeserie, nota, comentario) 
            VALUES (:id_usuario, :id_filmeserie, :nota, :comentario)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
    $stmt->bindParam(":id_filmeserie", $id_filmeserie, PDO::PARAM_INT);
    $stmt->bindParam(":nota", $nota, PDO::PARAM_INT);
    $stmt->bindParam(":comentario", $comentario, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo "Avaliação salva com sucesso!";
    } else {
        echo "Erro ao salvar a avaliação.";
    }

} catch (PDOException $e) {
    echo "Erro no banco de dados: " . $e->getMessage();
}
