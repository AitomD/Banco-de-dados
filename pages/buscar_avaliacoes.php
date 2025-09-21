<?php
require_once "../includes/db.php";

$id_filmeserie = $_GET['id_filmeserie'] ?? null;

if (!$id_filmeserie) {
    echo "<p class='text-light'>Nenhuma avaliação encontrada.</p>";
    exit;
}

try {
    $sql = "SELECT a.nota, a.comentario, u.nome_usuario, a.dt_avaliacao
            FROM **avaliacao** a  <-- CORREÇÃO AQUI
            JOIN usuarios u ON u.id_usuario = a.id_usuario
            WHERE a.id_filmeserie = :id_filmeserie
            ORDER BY a.dt_avaliacao DESC";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id_filmeserie", $id_filmeserie, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() === 0) {
        echo "<p class='text-light'>Nenhuma avaliação ainda. Seja o primeiro!</p>";
    } else {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "
            <div class='card bg-dark text-white mb-3 p-3'>
                <h5>{$row['nome_usuario']}</h5>
                <p>Nota: {$row['nota']}/10</p>
                <p>{$row['comentario']}</p>
                <small>" . date("d/m/Y H:i", strtotime($row['dt_avaliacao'])) . "</small>
            </div>
            ";
        }
    }

} catch (PDOException $e) {
    echo "<p class='text-danger'>Erro no banco: " . $e->getMessage() . "</p>";
}
?>