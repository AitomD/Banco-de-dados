// Função para carregar comentários
function carregarComentarios() {
  fetch(`pages/buscar_avaliacoes.php?id_filmeserie=${id}`)
    .then((res) => res.text()) // buscar_avaliacoes.php retorna HTML pronto
    .then((html) => {
      document.getElementById("lista-comentarios").innerHTML = html;
    })
    .catch((err) => console.error(err));
}

function atualizarEstrelas() {
  estrelas.forEach((estrela) => {
    if (parseInt(estrela.dataset.valor) <= notaSelecionada) {
      estrela.classList.add("selecionada");
    } else {
      estrela.classList.remove("selecionada");
    }
  });
}


// Variáveis Globais
const estrelas = document.querySelectorAll(".estrela");
let notaSelecionada = 0;


// Atualiza Estrelas Visualmente
function atualizarEstrelas() {
  estrelas.forEach((estrela) => {
    const valor = parseInt(estrela.dataset.valor);
    if (valor <= notaSelecionada) {
      estrela.classList.add("selecionada");
    } else {
      estrela.classList.remove("selecionada");
    }
  });
}



estrelas.forEach((estrela) => {
  estrela.addEventListener("click", () => {
    notaSelecionada = parseInt(estrela.dataset.valor);
    atualizarEstrelas();
  });
});


document.getElementById("enviar").addEventListener("click", () => {
  const comentario = document.getElementById("comentario").value.trim();

  if (!notaSelecionada || comentario === "") {
    alert("Escolha uma nota e escreva um comentário!");
    return;
  }

  const dados = new URLSearchParams();
  dados.append("id_filmeserie", id);
  dados.append("nota", notaSelecionada);
  dados.append("comentario", comentario);

  fetch("pages/salvar_avaliacao.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: dados.toString(),
  })
    .then((res) => res.json())
    .then((resposta) => {
      if (!resposta.logado) {
        alert("Você precisa estar logado para avaliar!");
        window.location.href = "pages/login.php";
        return;
      }

      if (resposta.sucesso) {
        alert("Avaliação enviada com sucesso!");

        // Limpa campos
        document.getElementById("comentario").value = "";
        notaSelecionada = 0;
        atualizarEstrelas();

        carregarComentarios();
      } else {
        alert("Erro ao salvar avaliação. Tente novamente.");
      }
    })
    .catch((err) => {
      console.error("Erro ao enviar avaliação:", err);
      alert("Erro ao enviar avaliação.");
    });
});

// Inicialização ao Carregar Página
document.addEventListener("DOMContentLoaded", () => {
  if (typeof carregarFilmeSerie === "function") {
    carregarFilmeSerie();
  }
  carregarComentarios();
  verificarFavorito();
});

