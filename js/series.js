const API_KEY = "d2b2038bd7bc5db74623478537729164";
const BASE_URL = "https://api.themoviedb.org/3";
const IMG_URL = "https://image.tmdb.org/t/p/w500";

const seriesExibidas = new Set(); // 🔹 controle global de séries já mostradas

document.addEventListener("DOMContentLoaded", () => {
  carregarSeriesPorGenero(10759, "#series-acao");     // Ação & Aventura
  carregarSeriesPorGenero(35, "#series-comedia");     // Comédia
  carregarSeriesPorGenero(18, "#series-drama");       // Drama
  carregarSeriesPorGenero(16, "#series-animacao");    // Animação
});

function carregarSeriesPorGenero(generoId, containerSelector) {
  fetch(`${BASE_URL}/discover/tv?api_key=${API_KEY}&language=pt-BR&with_genres=${generoId}&page=1`)
    .then((res) => res.json())
    .then((data) => {
      const unicas = [];

      for (const serie of data.results) {
        if (!seriesExibidas.has(serie.id)) {
          seriesExibidas.add(serie.id); // 🔹 evita repetir em outras categorias
          unicas.push(serie);
        }
      }

      preencherCardsGenero(unicas.slice(0, 16), containerSelector);
    })
    .catch((err) => console.error("Erro ao carregar séries:", err));
}

function preencherCardsGenero(series, containerSelector) {
  const container = document.querySelector(containerSelector);
  container.innerHTML = "";

  series.forEach((serie) => {
    const col = document.createElement("div");
    col.className = "col";

    col.innerHTML = `
      <div class="card h-100 bg-main text-light border-0">
        <img src="${serie.poster_path ? IMG_URL + serie.poster_path : "https://via.placeholder.com/300x400"}" 
             class="card-img-top" 
             alt="${serie.name}">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title">${serie.name}</h5>
          <p class="card-text">${serie.overview ? serie.overview.substring(0, 100) + "..." : "Sem descrição disponível."}</p>
          <div class="mt-auto">
            <i class="fa-solid fa-star text-warning"></i> ${serie.vote_average.toFixed(1)}
          </div>
        </div>
      </div>
    `;

    container.appendChild(col);
  });
}
