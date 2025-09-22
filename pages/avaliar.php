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

    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');
    const type = urlParams.get('type') || 'movie';

    // -------------------- Carregar detalhes do filme --------------------
    async function carregarFilmeSerie() {
        if (!id) return;

        try {
            const res = await fetch(`https://api.themoviedb.org/3/${type}/${id}?api_key=${API_KEY}&language=pt-BR`);
            const data = await res.json();

            document.querySelector('.poster').src = data.poster_path ? IMG_URL + data.poster_path : 'https://via.placeholder.com/250x375';
            document.querySelector('.poster').alt = data.title || data.name;
            document.getElementById('titulo-filme').textContent = data.title || data.name;
            document.getElementById('sinopse').textContent = data.overview || 'Sem descrição disponível.';

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

            verificarFavorito(data);

        } catch (err) {
            console.error('Erro ao carregar detalhes:', err);
            document.querySelector('.avaliar-container').style.display = 'none';
        }
    }

    // -------------------- Avaliações --------------------
    const estrelas = document.querySelectorAll('.estrela');
    let notaSelecionada = 0;

    estrelas.forEach(estrela => {
        estrela.addEventListener('click', () => {
            notaSelecionada = parseInt(estrela.dataset.valor);
            atualizarEstrelas();
        });
    });

    function atualizarEstrelas() {
        estrelas.forEach(estrela => {
            if (parseInt(estrela.dataset.valor) <= notaSelecionada) {
                estrela.classList.add('selecionada');
            } else {
                estrela.classList.remove('selecionada');
            }
        });
    }

    // -------------------- Favoritos --------------------
    const btnCoracao = document.getElementById("btn-coracao");
    const iconeCoracao = document.getElementById("icone-coracao");

    btnCoracao.addEventListener("click", () => {
        const titulo = document.getElementById("titulo-filme").textContent;
        const sinopse = document.getElementById("sinopse").textContent;
        const poster = document.querySelector(".poster").src;

        const filme = { id: id, type: type, titulo: titulo, sinopse: sinopse, poster: poster };
        let favoritos = JSON.parse(localStorage.getItem("favoritos")) || [];
        const jaExiste = favoritos.some(f => f.id == filme.id && f.type == filme.type);

        if (!jaExiste) {
            favoritos.push(filme);
            localStorage.setItem("favoritos", JSON.stringify(favoritos));
            alert("Adicionado aos favoritos!");
            iconeCoracao.classList.add("fa-solid");
            iconeCoracao.classList.remove("fa-regular");
        } else {
            favoritos = favoritos.filter(f => !(f.id == filme.id && f.type == filme.type));
            localStorage.setItem("favoritos", JSON.stringify(favoritos));
            alert("Removido dos favoritos!");
            iconeCoracao.classList.remove("fa-solid");
            iconeCoracao.classList.add("fa-regular");
        }
    });

    function verificarFavorito(data) {
        const favoritos = JSON.parse(localStorage.getItem("favoritos")) || [];
        const jaExiste = favoritos.some(f => f.id == id && f.type == type);

        if (jaExiste) {
            iconeCoracao.classList.add("fa-solid");
            iconeCoracao.classList.remove("fa-regular");
        }
    }

    // -------------------- Carregar avaliações --------------------
    async function carregarAvaliacoes() {
        const lista = document.getElementById('lista-comentarios'); // <-- corrigido
        try {
            const res = await fetch(`pages/buscar_avaliacoes.php?id_filmeserie=${id}`);
            lista.innerHTML = await res.text();
        } catch (err) {
            lista.innerHTML = "<p class='text-light'>Erro ao carregar avaliações.</p>";
            console.error(err);
        }
    }

    // -------------------- Enviar avaliação --------------------
    document.getElementById('enviar').addEventListener('click', () => {
        const comentario = document.getElementById('comentario').value;
        const id_filmeserie = id;

        if (!notaSelecionada || !comentario.trim()) {
            alert("Escolha uma nota e escreva um comentário!");
            return;
        }

        fetch('pages/salvar_avaliacao.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `id_filmeserie=${id_filmeserie}&nota=${notaSelecionada}&comentario=${encodeURIComponent(comentario)}`
        })
            .then(res => res.text())
            .then(resposta => {
                if (resposta.includes("logado")) {
                    alert("Você precisa estar logado para avaliar!");
                    window.location.href = "pages/login.php";
                    return;
                }

                alert(resposta);

                if (!resposta.includes("Você já avaliou")) {
                    document.getElementById('comentario').value = "";
                    notaSelecionada = 0;
                    atualizarEstrelas();
                    carregarAvaliacoes(); // atualiza imediatamente
                }
            })
            .catch(err => console.error(err));
    });

    // -------------------- DOMContentLoaded --------------------
    document.addEventListener('DOMContentLoaded', () => {
        carregarFilmeSerie();
        carregarAvaliacoes(); // carrega comentários dos outros usuários ao abrir
    });
</script>