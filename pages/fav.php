<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();

require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/fav.php';


$id_usuario = $_SESSION['id_usuario'];

$db = new DB();
$conn = $db->getConnection();

$fav = new Fav($conn);
$favoritos = $fav->listarPorUsuario($id_usuario);
?>

<main class="container">
    <div class="container py-4">
        <h1 class="text-center mb-4 text-light fw-bold">Meus Favoritos</h1>

        <div id="favoritosContainer" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            <?php if (empty($favoritos)): ?>
                <p class="text-light">Você ainda não adicionou nenhum favorito.</p>
            <?php else: ?>
                <?php foreach ($favoritos as $f): ?>
                    <div class="col">
                        <div class="card h-100 text-light" data-id="<?= $f['id_filme'] ?>">
                            <img src="<?= $f['poster'] ?: 'https://via.placeholder.com/250x375?text=Sem+Imagem' ?>"
                                class="card-img-top" alt="Poster">

                            <div class="card-body d-flex flex-column justify-content-between">
                                <div class="d-flex flex-column text-center gap-2 mt-3">
                                    <!-- Botão Ver Detalhes com JS -->
                                    <button class="neon-btn ver-detalhes-btn" data-id="<?= $f['id_filme'] ?>">
                                        Ver Detalhes
                                    </button>

                                    <!-- Botão Remover -->
                                    <button class="btn btn-danger w-100 remover" data-id="<?= $f['id_filme'] ?>">
                                        Remover
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

</main>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const apiKey = 'd2b2038bd7bc5db74623478537729164'; 

    document.querySelectorAll('.ver-detalhes-btn').forEach(button => {
        button.addEventListener('click', async () => {
            const id = button.getAttribute('data-id');

            try {
                // Tenta como filme
                const movieRes = await fetch(`https://api.themoviedb.org/3/movie/${id}?api_key=${apiKey}`);
                if (movieRes.ok) {
                    window.location.href = `avaliar?id=${id}&type=movie`;
                    return;
                }

                // Tenta como série
                const tvRes = await fetch(`https://api.themoviedb.org/3/tv/${id}?api_key=${apiKey}`);
                if (tvRes.ok) {
                    window.location.href = `avaliar?id=${id}&type=tv`;
                    return;
                }

                alert("Conteúdo não encontrado.");
            } catch (error) {
                console.error('Erro ao verificar o tipo:', error);
                alert("Erro ao carregar detalhes.");
            }
        });
    });
});
</script>


<script>
    // Remover favorito
    document.querySelectorAll('.remover').forEach(btn => {
        btn.addEventListener('click', () => {
            const id_filme = btn.dataset.id;

            fetch('pages/favoritar.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `id_filme=${encodeURIComponent(id_filme)}&poster=`
            })
                .then(res => res.json())
                .then(data => {
                    if (data.acao === 'removido') {
                        btn.closest('.col').remove();
                    }
                })
                .catch(err => console.error(err));
        });
    });
</script>