const API_KEY = "d2b2038bd7bc5db74623478537729164";
const IMG_URL = "https://image.tmdb.org/t/p/w500";

const urlParams = new URLSearchParams(window.location.search);
const id = urlParams.get('id');
const type = urlParams.get('type') || 'movie';

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

document.addEventListener('DOMContentLoaded', carregarFilmeSerie);

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

// Enviar avaliação para o PHP
document.getElementById('enviar').addEventListener('click', () => {
    const comentario = document.getElementById('comentario').value;
    const id_filmeserie = id;

    fetch('salvar_avaliacao.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `id_filmeserie=${id_filmeserie}&nota=${notaSelecionada}&comentario=${encodeURIComponent(comentario)}`
    })
    .then(res => res.text())
    .then(resposta => {
        if (resposta.includes("logado")) {
            alert("Você precisa estar logado para avaliar!");
            window.location.href = "login.php";
            return;
        }

        if (resposta.includes("Preencha todos os campos")) {
            alert("Escolha uma nota e escreva um comentário!");
            return;
        }

        alert(resposta);
        document.getElementById('comentario').value = "";
        notaSelecionada = 0;
        atualizarEstrelas();
    })
    .catch(err => console.error(err));
});