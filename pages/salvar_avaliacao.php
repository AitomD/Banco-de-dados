<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    echo "Você precisa estar logado para avaliar!";
    exit;
}

require_once '../includes/db.php'; // carrega a classe DB

// Cria a instância e abre a conexão
$database = new DB();
$conn = $database->getConnection();

// Pega os dados do POST
$id_usuario    = $_SESSION['id_usuario'];
$id_filmeserie = $_POST['id_filmeserie'] ?? null;
$nota          = $_POST['nota'] ?? null;
$comentario    = trim($_POST['comentario'] ?? "");

// Validação básica
if ($id_usuario && $id_filmeserie && $nota && !empty($comentario)) {
    try {
        // Verifica se o usuário já avaliou este filme
        $checkSql = "SELECT COUNT(*) FROM avaliacao WHERE id_usuario = :id_usuario AND id_filmeserie = :id_filmeserie";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $checkStmt->bindParam(':id_filmeserie', $id_filmeserie, PDO::PARAM_INT);
        $checkStmt->execute();

        if ($checkStmt->fetchColumn() > 0) {
            echo "Você já avaliou esse filme!";
            exit;
        }

        // Insere a avaliação
        $sql = "INSERT INTO avaliacao (id_usuario, id_filmeserie, nota, comentario, dt_avaliacao) 
                VALUES (:id_usuario, :id_filmeserie, :nota, :comentario, NOW())";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->bindParam(':id_filmeserie', $id_filmeserie, PDO::PARAM_INT);
        $stmt->bindParam(':nota', $nota, PDO::PARAM_INT);
        $stmt->bindParam(':comentario', $comentario, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "Avaliação enviada com sucesso!";
        } else {
            echo "Erro ao enviar avaliação!";
        }
    } catch (PDOException $e) {
        echo "Erro no banco: " . $e->getMessage();
    }
} else {
    echo "Preencha todos os campos antes de enviar!";
}
