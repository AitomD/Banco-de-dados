(() => {
  const API_KEY = "d2b2038bd7bc5db74623478537729164";
  const BASE_URL = "https://api.themoviedb.org/3";
  const IMG_URL = "https://image.tmdb.org/t/p/w500";

  const filmesExibidos = new Set();

  document.addEventListener("DOMContentLoaded", () => {
    carregarFilmesPorGenero(28, "#acao");
    carregarFilmesPorGenero(35, "#comedia");
    carregarFilmesPorGenero(18, "#drama");
    carregarFilmesPorGenero(16, "#animacao");
  });

  async function carregarFilmesPorGenero(generoId, containerSelector) {
    const unicos = [];
    let page = 1;

    while (unicos.length < 16 && page <= 5) {
      try {
        const res = await fetch(`${BASE_URL}/discover/movie?api_key=${API_KEY}&language=pt-BR&with_genres=${generoId}&sort_by=popularity.desc&page=${page}`);
        const data = await res.json();

        for (const filme of data.results) {
          if (!filmesExibidos.has(filme.id) && unicos.length < 16) {
            filmesExibidos.add(filme.id);
            unicos.push(filme);
          }
        }
        page++;
      } catch (err) {
        console.error("Erro ao carregar filmes:", err);
        break;
      }
    }

    preencherCardsFilmes(unicos, containerSelector);
  }

  function preencherCardsFilmes(filmes, containerSelector) {
    const container = document.querySelector(containerSelector);
    container.innerHTML = "";

    filmes.forEach(filme => {
      const modelo = document.getElementById('card-modelo');
      const col = modelo.cloneNode(true);
      col.classList.remove('d-none');
      col.id = '';
      col.querySelector('.poster').src = filme.poster_path ? IMG_URL + filme.poster_path : 'https://via.placeholder.com/300x400';
      col.querySelector('.poster').alt = filme.title;
      col.querySelector('.titulo').textContent = filme.title;
      col.querySelector('.descricao').textContent = filme.overview ? filme.overview.substring(0, 100) + '...' : 'Sem descrição disponível.';
      col.querySelector('.nota').textContent = filme.vote_average.toFixed(1);

      container.appendChild(col);

      const botao = col.querySelector('.avaliar-btn');
      // Alterado: redireciona para avaliar.php
      botao.addEventListener('click', () => {
        window.location.href = 'avaliar.php';
      });
    });
  }
})();
