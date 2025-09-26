(() => {
  const API_KEY = "d2b2038bd7bc5db74623478537729164";
  const BASE_URL = "https://api.themoviedb.org/3";
  const IMG_URL = "https://image.tmdb.org/t/p/w500";

  const seriesExibidas = new Set();

  document.addEventListener("DOMContentLoaded", () => {
    carregarSeriesPorGenero(10759, "#series-acao");
    carregarSeriesPorGenero(35, "#series-comedia");
    carregarSeriesPorGenero(18, "#series-drama");
    carregarSeriesPorGenero(16, "#series-animacao");
  });

  async function carregarSeriesPorGenero(generoId, containerSelector) {
    const unicas = [];
    let page = 1;

    while (unicas.length < 16 && page <= 5) {
      try {
        const res = await fetch(`${BASE_URL}/discover/tv?api_key=${API_KEY}&language=pt-BR&with_genres=${generoId}&sort_by=popularity.desc&page=${page}`);
        const data = await res.json();

        for (const serie of data.results) {
          if (!seriesExibidas.has(serie.id) && unicas.length < 16) {
            seriesExibidas.add(serie.id);
            unicas.push(serie);
          }
        }

        page++;
      } catch (err) {
        console.error("Erro ao carregar séries:", err);
        break;
      }
    }

    preencherCardsSeries(unicas, containerSelector);
  }

  function preencherCardsSeries(series, containerSelector) {
    const container = document.querySelector(containerSelector);
    container.innerHTML = "";

    series.forEach(serie => {
      const col = document.createElement("div");
      col.className = "col";

      col.innerHTML = `
        <div class="card h-100 bg-main text-light border-0">
          <img src="${serie.poster_path ? IMG_URL + serie.poster_path : "https://via.placeholder.com/300x400"}" class="card-img-top" alt="${serie.name}">
          <div class="card-body d-flex flex-column">
            <span class="badge bg-warning mb-2">Série</span>
            <h5 class="card-title">${serie.name}</h5>
            <p class="card-text">${serie.overview ? serie.overview.substring(0, 100) + "..." : "Sem descrição disponível."}</p>
            <div class="mt-auto">
              <i class="fa-solid fa-star text-warning"></i> ${serie.vote_average.toFixed(1)}
            </div>
            <button class="neon-btn avaliar-btn mt-2">Avaliar</button>
          </div>
        </div>
      `;

      container.appendChild(col);

      const botao = col.querySelector('.avaliar-btn');
      botao.addEventListener('click', () => {
        window.location.href = `avaliar?id=${serie.id}&type=tv`;
      });
    });
  }
})();