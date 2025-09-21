// Variáveis globais
const urlParams = new URLSearchParams(window.location.search);
const id = urlParams.get('id'); // id do filme
const type = urlParams.get('type') || 'movie';

const estrelas = document.querySelectorAll('.estrela');
let notaSelecionada = 0;

// Seleção de estrelas
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

// Função para carregar comentários
function carregarComentarios() {
    fetch(`buscar_avaliacoes.php?id_filmeserie=${id}`)
        .then(res => res.json())
        .then(data => {
            const lista = document.getElementById('lista-comentarios');
            lista.innerHTML = "";

            if (!data || data.length === 0) {
                lista.innerHTML = "<p>Nenhum comentário ainda.</p>";
                return;
            }

            data.forEach(c => {
                const div = document.createElement('div');
                div.className = "col-md-6 col-lg-4";

                div.innerHTML = `
                    <div class="card bg-dark text-white h-100 p-3">
                        <h5>${c.nome}</h5>
                        <p>Nota: ${c.nota}/10</p>
                        <p>${c.comentario}</p>
                        <small>${new Date(c.dt_avaliacao).toLocaleString('pt-BR')}</small>
                    </div>
                `;
                lista.appendChild(div);
            });
        })
        .catch(err => console.error(err));
}

// Enviar avaliação
document.getElementById('enviar').addEventListener('click', () => {
    const comentario = document.getElementById('comentario').value;

    if (!notaSelecionada || comentario.trim() === "") {
        alert("Escolha uma nota e escreva um comentário!");
        return;
    }

    fetch('salvar_avaliacao.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `id_filmeserie=${id}&nota=${notaSelecionada}&comentario=${encodeURIComponent(comentario)}`
    })
    .then(res => res.text())
    .then(resposta => {
        if (resposta.includes("logado")) {
            alert("Você precisa estar logado para avaliar!");
            window.location.href = "login.php";
            return;
        }

        alert(resposta);
        document.getElementById('comentario').value = "";
        notaSelecionada = 0;
        atualizarEstrelas();

        // Atualiza lista de comentários
        carregarComentarios();
    })
    .catch(err => console.error(err));
});

// Botão de favorito
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

function verificarFavorito() {
    const favoritos = JSON.parse(localStorage.getItem("favoritos")) || [];
    const jaExiste = favoritos.some(f => f.id == id && f.type == type);

    if (jaExiste) {
        iconeCoracao.classList.add("fa-solid");
        iconeCoracao.classList.remove("fa-regular");
    }
}

// Inicialização ao carregar página
document.addEventListener('DOMContentLoaded', () => {
    if (typeof carregarFilmeSerie === "function") {
        carregarFilmeSerie(); // seu código existente para carregar filme
    }
    carregarComentarios();
    verificarFavorito();
});
