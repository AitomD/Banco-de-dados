<?php
// Evita notice de session já ativa
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/db.php';
$database = new DB();
$conn = $database->getConnection();

$id_filmeserie = intval($_GET['id_filmeserie'] ?? 0);

$sql = "SELECT a.nota, a.comentario, a.dt_avaliacao, u.nome AS usuario
        FROM avaliacao a
        JOIN usuario u ON a.id_usuario = u.id_usuario
        WHERE a.id_filmeserie = :id_filmeserie
        ORDER BY a.dt_avaliacao DESC";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_filmeserie', $id_filmeserie, PDO::PARAM_INT);
$stmt->execute();
$avaliacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($avaliacoes) == 0) {
    echo "<p class='text-light text-center'>Nenhuma avaliação ainda.</p>";
    exit;
}

// Grid centralizada
echo '<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4 justify-content-center">';

foreach ($avaliacoes as $a) {
    $nota = intval($a['nota']);
    echo '<div class="col">';
    echo '<div class="card h-100 bg-main text-light border-0" style="box-shadow:0 4px 12px rgba(0,0,0,0.5);">';

    echo '<div class="card-body d-flex flex-column">';
    // Header
    echo '<div class="d-flex justify-content-between mb-2">';
    echo '<strong>' . htmlspecialchars($a['usuario']) . '</strong>';
    echo '<span class="text-muted" style="font-size:12px;">' . date('d/m/Y', strtotime($a['dt_avaliacao'])) . '</span>';
    echo '</div>';

    // Estrelas
    echo '<div class="mb-2">';
    for ($i = 1; $i <= 10; $i++) {
        if ($i <= $nota) {
            echo '<i class="fa-solid fa-star text-warning"></i> ';
        } else {
            echo '<i class="fa-regular fa-star text-warning"></i> ';
        }
    }
    echo '</div>';

    // Comentário
    echo '<div class="flex-grow-1 text-light" style="font-family:Fredoka,sans-serif; font-size:14px; line-height:1.4; overflow:auto; max-height:120px;">';
    echo nl2br(htmlspecialchars($a['comentario']));
    echo '</div>';

    echo '</div>'; // fim card-body
    echo '</div>'; // fim card
    echo '</div>'; // fim col
}

echo '</div>'; // fim row
?>
