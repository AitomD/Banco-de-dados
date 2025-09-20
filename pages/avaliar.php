<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliar Filme</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="../estilo/style.css">
    <link rel="stylesheet" href="../estilo/form.css">
    <link rel="stylesheet" href="../estilo/local.css">
    <style>
        /* Estilos originais mantidos */
        .avaliar-container {
            display: flex;
            gap: 40px;
            max-width: 1200px;
            margin: 40px auto;
            background-color: #021526;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
        }

        .poster {
            width: 500px;
            height: auto;
            border-radius: 5px;
        }

        .info-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .trailer-container {
            width: 100%;
            margin-top: 20px;
        }

        #trailer-video {
            width: 100%;
            height: 400px;
        }

        .estrela {
            font-size: 40px;
            cursor: pointer;
            color: #123155ff;
            transition: color 0.2s;
        }

        .estrela:hover,
        .estrela.selecionada {
            color: gold;
        }

        textarea {
            width: 100%;
            resize: vertical;
            padding: 10px;
            border-radius: 5px;
            border: none;
            outline: none;
            font-family: 'Fredoka', sans-serif;
            background-color: #123155ff;
            color: white;
        }

        /* Novo estilo azul neon para botões */
        .neon-btn {
            background: #37c6ff;
            color: white;
            border: none;
            padding: 5px 8px;
            font-size: 14px;
            border-radius: 8px;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: bold;
            text-decoration: none;
            box-shadow:
              0 0 5px #37c6ff,
              0 0 5px #37c6ff,
              0 0 5px #37c6ff,
              0 0 10px #37c6ff;
            transition: all 0.3s ease;
        }

        .neon-btn:hover {
            box-shadow:
              0 0 5px #37c6ff,
              0 0 10px #37c6ff,
              0 0 10px #37c6ff,
              0 0 15px #37c6ff;
            transform: scale(0.9);
        }

        @media (max-width: 768px) {
            .avaliar-container {
                flex-direction: column;
                align-items: center;
                padding: 20px;
                gap: 20px;
            }

            .poster {
                width: 100%;
                max-width: 300px;
                height: auto;
            }

            .info-container {
                width: 100%;
            }

            #trailer-video {
                height: 220px;
            }

            textarea {
                font-size: 14px;
            }

            .estrela {
                font-size: 28px;
            }

            .neon-btn {
                width: 100%;
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            .poster {
                max-width: 220px;
            }

            #trailer-video {
                height: 180px;
            }

            h3,
            h4 {
                font-size: 1.1rem;
                text-align: center;
            }

            p#sinopse {
                font-size: 0.9rem;
                text-align: justify;
            }
        }
    </style>
</head>

<body>


<div class="alto" style="height: 189px;"></div>

<div class="avaliar-container">
    <img class="poster" src="https://via.placeholder.com/250x375" alt="Capa do filme">

    <div class="info-container">
        <h3 id="titulo-filme">Título do Filme</h3>
        <p id="sinopse">Breve sinopse do filme vai aqui. Resuma em 2-3 linhas.</p>

        <div class="trailer-container">
            <h4 class="text-center">Trailer</h4>
            <iframe id="trailer-video" src="" frameborder="0" allow="autoplay; encrypted-media"
                allowfullscreen></iframe>
        </div>

        <div class="mt-4">
            <h4>Sua Avaliação</h4>
            <div id="estrelas" class="mb-2">
                <?php for ($i = 1; $i <= 10; $i++): ?>
                    <span class="estrela" data-valor="<?= $i ?>">&#9733;</span>
                <?php endfor; ?>
            </div>

            <textarea id="comentario" rows="4" placeholder="Deixe seu comentário..."></textarea>
            <button class="neon-btn mt-3" id="enviar">Enviar Avaliação</button>
            <button class="neon-btn ms-3" id="btn-coracao">
                <i id="icone-coracao" class="fa-regular fa-heart"></i>
            </button>
        </div>
    </div>
</div>

<div class="alto" style="height: 100px;"></div>


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

// -------------------- Função para carregar avaliações --------------------
async function carregarAvaliacoes() {
    const lista = document.getElementById('lista-avaliacoes');
    try {
        const res = await fetch(`buscar_avaliacoes.php?id_filmeserie=${id}`);
        lista.innerHTML = await res.text();
    } catch (err) {
        lista.innerHTML = "<p>Erro ao carregar avaliações.</p>";
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

    fetch('salvar_avaliacao.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `id_filmeserie=${id_filmeserie}&nota=${notaSelecionada}&comentario=${encodeURIComponent(comentario)}`
    })
    .then(res => res.text())
    .then(resposta => {
        alert(resposta);
        if (!resposta.includes("Você já avaliou")) {
            document.getElementById('comentario').value = "";
            notaSelecionada = 0;
            atualizarEstrelas();
            carregarAvaliacoes(); // Atualiza a lista de avaliações
        }
    })
    .catch(err => console.error(err));
});

// -------------------- DOMContentLoaded --------------------
document.addEventListener('DOMContentLoaded', () => {
    carregarFilmeSerie();
    carregarAvaliacoes(); // Carrega avaliações ao abrir a página
});
</script>
