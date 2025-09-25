<main class="container">

    <div class="alto" style="height: 189px;"></div>

    <div class="avaliar-container">
        <img class="poster" src="https://via.placeholder.com/250x375" alt="Capa do filme">

        <div class="info-container">
            <h3 id="titulo-filme" class="text-light">Título do Filme</h3>
            <p id="sinopse" class="text-light">Breve sinopse do filme vai aqui. Resuma em 2-3 linhas.</p>

            <div class="trailer-container">
                <h4 class="text-center text-light">Trailer</h4>
                <iframe id="trailer-video" src="" frameborder="0" allow="autoplay; encrypted-media"
                    allowfullscreen></iframe>
            </div>

            <div class="mt-4">
                <h4 class="text-light">Sua Avaliação</h4>
                <div id="estrelas" class="mb-2">
                    <?php for ($i = 1; $i <= 10; $i++): ?>
                        <span class="estrela" data-valor="<?= $i ?>">&#9733;</span>
                    <?php endfor; ?>
                </div>

                <textarea id="comentario" rows="4" placeholder="Deixe seu comentário..."></textarea>
                <div class="d-flex justify-content-center mt-3 flex-column flex-sm-row">
                    <button class="neon-btn flex-fill" id="enviar">
                        Enviar Avaliação
                    </button>
                    <button class="neon-btn ms-sm-3 mt-3 mt-sm-0 flex-fill" id="btn-coracao">
                        <i id="icone-coracao" class="fa-regular fa-heart"></i>
                    </button>
                </div>
            </div>

        </div>
    </div>
    <div class="container mt-4">
        <h4 class="text-light text-center">Avaliações dos Usuários</h4>
        <div id="lista-comentarios" class="row g-4 justify-content-center">
            <!-- Comentários carregados via buscar_avaliacoes.php -->
        </div>
    </div>

    <div class="alto" style="height: 100px;"></div>
</main>

<script>
const API_KEY = "d2b2038bd7bc5db74623478537729164";
const IMG_URL = "https://image.tmdb.org/t/p/w500";
const BASE    = document.querySelector('meta[name="base-url"]')?.content || '/banco/';

const urlParams = new URLSearchParams(window.location.search);
const id = urlParams.get('id');
const type = urlParams.get('type') || 'movie';

let tituloFilme = '';
let posterFilme = '';
let sinopseFilme = '';

// -------------------- Carregar detalhes do filme --------------------
async function carregarFilmeSerie() {
    if (!id) return;

    try {
        const res = await fetch(`https://api.themoviedb.org/3/${type}/${id}?api_key=${API_KEY}&language=pt-BR`);
        const data = await res.json();

        posterFilme = data.poster_path ? IMG_URL + data.poster_path : 'https://via.placeholder.com/250x375';
        tituloFilme = data.title || data.name;
        sinopseFilme = data.overview || 'Sem descrição disponível.';

        document.querySelector('.poster').src = posterFilme;
        document.querySelector('.poster').alt = tituloFilme;
        document.getElementById('titulo-filme').textContent = tituloFilme;
        document.getElementById('sinopse').textContent = sinopseFilme;

        // Carrega trailer
        const videosRes = await fetch(`https://api.themoviedb.org/3/${type}/${id}/videos?api_key=${API_KEY}&language=pt-BR`);
        const videosData = await videosRes.json();
        const trailer = videosData.results.find(video => video.site === 'YouTube' && video.type === 'Trailer');
        const trailerIframe = document.getElementById('trailer-video');
        const trailerContainer = document.querySelector('.trailer-container');

        if (trailer) {
            trailerIframe.src = `https://www.youtube.com/embed/${trailer.key}?autoplay=1&rel=0`;
            trailerContainer.style.display = 'block';
        } else {
            trailerContainer.style.display = 'none';
        }

        verificarFavorito();

    } catch (err) {
        console.error('Erro ao carregar detalhes:', err);
        document.querySelector('.avaliar-container').style.display = 'none';
    }
}

// -------------------- Favoritos --------------------
const btnCoracao = document.getElementById("btn-coracao");
const iconeCoracao = document.getElementById("icone-coracao");

btnCoracao.addEventListener("click", () => {
    fetch(`${BASE}pages/favoritar.php`, {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `id_filme=${encodeURIComponent(id)}&type=${encodeURIComponent(type)}&titulo=${encodeURIComponent(tituloFilme)}&poster=${encodeURIComponent(posterFilme)}&sinopse=${encodeURIComponent(sinopseFilme)}`
    })
    .then(res => res.json())
    .then(data => {
        // Atualiza localStorage
        let favoritosAtual = JSON.parse(localStorage.getItem('favoritos')) || [];

        if(data.acao === "adicionado") {
            // adiciona se não existir
            if(!favoritosAtual.find(f => f.id == id && f.type == type)){
                favoritosAtual.push({
                    id: id,
                    type: type,
                    titulo: tituloFilme,
                    poster: posterFilme,
                    sinopse: sinopseFilme
                });
            }
            iconeCoracao.classList.add("fa-solid");
            iconeCoracao.classList.remove("fa-regular");
        } else if(data.acao === "removido") {
            favoritosAtual = favoritosAtual.filter(f => f.id != id || f.type != type);
            iconeCoracao.classList.remove("fa-solid");
            iconeCoracao.classList.add("fa-regular");
        }

        localStorage.setItem('favoritos', JSON.stringify(favoritosAtual));
    })
    .catch(err => console.error(err));
});

function verificarFavorito() {
    const favoritosAtual = JSON.parse(localStorage.getItem('favoritos')) || [];
    const existe = favoritosAtual.find(f => f.id == id && f.type == type);
    if(existe) {
        iconeCoracao.classList.add("fa-solid");
        iconeCoracao.classList.remove("fa-regular");
    } else {
        iconeCoracao.classList.remove("fa-solid");
        iconeCoracao.classList.add("fa-regular");
    }
}

// -------------------- Inicialização --------------------
document.addEventListener('DOMContentLoaded', () => {
    carregarFilmeSerie();
});
</script>


