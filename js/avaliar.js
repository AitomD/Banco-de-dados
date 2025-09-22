// Função para carregar comentários
function carregarComentarios() {
    fetch(`../pages/buscar_avaliacoes.php?id_filmeserie=${id}`)
        .then(res => res.text()) // buscar_avaliacoes.php retorna HTML pronto
        .then(html => {
            document.getElementById('lista-comentarios').innerHTML = html;
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

    fetch('../pages/salvar_avaliacao.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `id_filmeserie=${id}&nota=${notaSelecionada}&comentario=${encodeURIComponent(comentario)}`
    })
    .then(res => res.text())
    .then(resposta => {
        if (resposta.includes("logado")) {
            alert("Você precisa estar logado para avaliar!");
            window.location.href = "pages/login.php";
            return;
        }

        // Limpa os campos
        document.getElementById('comentario').value = "";
        notaSelecionada = 0;
        atualizarEstrelas();

        // Atualiza lista de comentários logo após salvar
        carregarComentarios();
    })
    .catch(err => console.error(err));
});

// Inicialização ao carregar página
document.addEventListener('DOMContentLoaded', () => {
    if (typeof carregarFilmeSerie === "function") {
        carregarFilmeSerie();
    }
    carregarComentarios();
    verificarFavorito();
});
