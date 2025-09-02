const API_KEY = "d2b2038bd7bc5db74623478537729164";
const BASE_URL = "https://api.themoviedb.org/3";
const IMG_URL = "https://image.tmdb.org/t/p/w500";

const filmesExibidos = new Set(); // 🔹 controle global para evitar repetição

document.addEventListener("DOMContentLoaded", () => {
  carregarFilmesPorGenero(28, "#acao");      // Ação
  carregarFilmesPorGenero(35, "#comedia");   // Comédia
  carregarFilmesPorGenero(18, "#drama");     // Drama
  carregarFilmesPorGenero(16, "#animacao");  // Animação
});

async function carregarFilmesPorGenero(generoId, containerSelector) {
  const unicos = [];
  let page = 1;

  // tenta buscar até 5 páginas ou até ter 16 filmes únicos
  while (unicos.length < 16 && page <= 5) {
    try {
      const res = await fetch(`${BASE_URL}/discover/movie?api_key=${API_KEY}&language=pt-BR&with_genres=${generoId}&certification_country=BR&certification.lte=14&page=${page}`);
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

  preencherCardsGenero(unicos, containerSelector);
}

function preencherCardsGenero(filmes, containerSelector) {
  const container = document.querySelector(containerSelector);
  container.innerHTML = "";

  filmes.forEach(filme => {
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
