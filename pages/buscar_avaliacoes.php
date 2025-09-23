<?php
require_once __DIR__ . "/../includes/db.php";
require_once __DIR__ . "/../includes/db_procedural.php";

$id_filmeserie = intval($_GET['id_filmeserie'] ?? 0);

if ($id_filmeserie === 0) {
    echo "<p class='text-light'>Nenhuma avaliação encontrada.</p>";
    exit;
}

try {
    $sql = "SELECT a.nota, a.comentario, u.nome, a.dt_avaliacao
            FROM avaliacao a
            JOIN usuario u ON u.id_usuario = a.id_usuario
            WHERE a.id_filmeserie = :id_filmeserie
            ORDER BY a.dt_avaliacao DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id_filmeserie", $id_filmeserie, PDO::PARAM_INT);
    $stmt->execute();

 if ($stmt->rowCount() === 0) {
    echo "<p style='color:white;'>Nenhuma avaliação ainda. Seja o primeiro!</p>";
} else {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Converte a nota em estrelas
        $nota = intval($row['nota']); // garante que seja inteiro
        $maxEstrelas = 10;
        $estrelas = '';
        for ($i = 1; $i <= $maxEstrelas; $i++) {
            $estrelas .= $i <= $nota ? '★' : '☆';
        }

        echo "
        <div style='background-color:#021526; color:white; padding:15px; margin-bottom:15px; border-radius:12px; font-family:Fredoka, sans-serif;'>
            <h5 style='margin:0 0 5px 0;'>{$row['nome']}</h5>
            <p style='margin:0 0 5px 0; color:#FFD700; font-size:1.5rem;'>{$estrelas}</p>
            <p style='margin:0 0 5px 0;'>{$row['comentario']}</p>
            <small>" . date("d/m/Y H:i", strtotime($row['dt_avaliacao'])) . "</small>
        </div>
        ";
    }
}




} catch (PDOException $e) {
    echo "<p class='text-danger'>Erro no banco: " . $e->getMessage() . "</p>";
}
