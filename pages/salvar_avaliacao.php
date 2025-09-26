<?php
session_start();
header('Content-Type: application/json');

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    echo json_encode([
        "logado" => false,
        "mensagem" => "Você precisa estar logado para avaliar!"
    ]);
    exit;
}

require_once __DIR__ . '/../includes/db.php';

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
        // Verifica se já existe avaliação
        $checkSql = "SELECT COUNT(*) FROM avaliacao WHERE id_usuario = :id_usuario AND id_filmeserie = :id_filmeserie";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $checkStmt->bindParam(':id_filmeserie', $id_filmeserie, PDO::PARAM_INT);
        $checkStmt->execute();

        if ($checkStmt->fetchColumn() > 0) {
            echo json_encode([
                "logado" => true,
                "sucesso" => false,
                "mensagem" => "Você já avaliou esse filme!"
            ]);
            exit;
        }

        // Insere avaliação
        $sql = "INSERT INTO avaliacao (id_usuario, id_filmeserie, nota, comentario, dt_avaliacao) 
                VALUES (:id_usuario, :id_filmeserie, :nota, :comentario, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->bindParam(':id_filmeserie', $id_filmeserie, PDO::PARAM_INT);
        $stmt->bindParam(':nota', $nota, PDO::PARAM_INT);
        $stmt->bindParam(':comentario', $comentario, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo json_encode([
                "logado" => true,
                "sucesso" => true,
                "mensagem" => "Avaliação enviada com sucesso!"
            ]);
        } else {
            echo json_encode([
                "logado" => true,
                "sucesso" => false,
                "mensagem" => "Erro ao enviar avaliação!"
            ]);
        }
    } catch (PDOException $e) {
        echo json_encode([
            "logado" => true,
            "sucesso" => false,
            "mensagem" => "Erro no banco: " . $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        "logado" => true,
        "sucesso" => false,
        "mensagem" => "Preencha todos os campos antes de enviar!"
    ]);
}
