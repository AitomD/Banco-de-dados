const API_KEY = "d2b2038bd7bc5db74623478537729164";
const BASE_URL = "https://api.themoviedb.org/3";
const IMG_URL = "https://image.tmdb.org/t/p/w500";

document.addEventListener("DOMContentLoaded", () => {
  carregarFilmesPorGenero(28, "#acao");     // Ação
  carregarFilmesPorGenero(35, "#comedia"); // Comédia
});

function carregarFilmesPorGenero(generoId, containerSelector) {
  fetch(`${BASE_URL}/discover/movie?api_key=${API_KEY}&language=pt-BR&with_genres=${generoId}&page=1`)
    .then((res) => res.json())
    .then((data) => {
      preencherCardsGenero(data.results.slice(0, 16), containerSelector); // pega 16 filmes
    })
    .catch((err) => console.error("Erro ao carregar filmes:", err));
}

function preencherCardsGenero(filmes, containerSelector) {
  const container = document.querySelector(containerSelector);
  container.innerHTML = "";

  filmes.forEach((filme) => {
    const col = document.createElement("div");
    col.className = "col";

    col.innerHTML = `
      <div class="card h-100 bg-main text-light border-0">
        <img src="${filme.poster_path ? IMG_URL + filme.poster_path : "https://via.placeholder.com/300x400"}" 
             class="card-img-top" 
             alt="${filme.title}">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title">${filme.title}</h5>
          <p class="card-text">${filme.overview ? filme.overview.substring(0, 100) + "..." : "Sem descrição disponível."}</p>
          <div class="mt-auto">
            <i class="fa-solid fa-star text-warning"></i> ${filme.vote_average.toFixed(1)}
          </div>
        </div>
      </div>
    `;

    container.appendChild(col);
  });
}
