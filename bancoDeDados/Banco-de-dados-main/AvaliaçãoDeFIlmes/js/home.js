const API_KEY = "d2b2038bd7bc5db74623478537729164";
const BASE_URL = "https://api.themoviedb.org/3";
const IMG_URL = "https://image.tmdb.org/t/p/w780";

// Carregar filmes populares ao abrir a home
document.addEventListener("DOMContentLoaded", () => {
  carregarFilmesPopulares();
});

function carregarFilmesPopulares() {
  fetch(`${BASE_URL}/movie/popular?api_key=${API_KEY}&language=pt-BR&page=1`)
    .then(res => res.json())
    .then(data => {
      preencherCarrossel(data.results.slice(0, 5)); // carrossel principal com 5 filmes
      preencherCards(data.results.slice(0, 6)); // cards abaixo do carrossel com 6 filmes
    })
    .catch(err => console.error("Erro ao carregar filmes:", err));
}

function preencherCarrossel(filmes) {
  const carouselInner = document.querySelector("#carouselExampleFade .carousel-inner");
  carouselInner.innerHTML = "";

  filmes.forEach((filme, index) => {
    const item = document.createElement("div");
    item.className = `carousel-item ${index === 0 ? "active" : ""}`;
    item.innerHTML = `
      <img src="${IMG_URL}${filme.backdrop_path}" class="d-block w-100 rounded img-fluid" alt="${filme.title}">
    `;
    carouselInner.appendChild(item);
  });

  // Adiciona os títulos abaixo das imagens
  adicionarTitulosCarrossel();
}

// Função para adicionar títulos abaixo de cada slide com escrita branca
function adicionarTitulosCarrossel() {
  const itens = document.querySelectorAll("#carouselExampleFade .carousel-item");

  itens.forEach(item => {
    const titulo = item.querySelector("img").alt;

    const caption = document.createElement("div");

    // Estilo inline para o título
    caption.style.position = "relative";
    caption.style.textAlign = "center";
    caption.style.backgroundColor = "rgba(0,0,0,0.6)"; // fundo semi-transparente
    caption.style.color = "#ffffff"; // texto branco
    caption.style.padding = "10px 0";
    caption.style.marginTop = "5px";
    caption.style.borderRadius = "5px";
    caption.style.fontSize = "1.5rem";

    caption.innerHTML = `<h2>${titulo}</h2>`;

    item.appendChild(caption);
  });
}

function preencherCards(filmes) {
  const cardsContainer = document.querySelector(".container .row .col-12 .row.g-3");
  cardsContainer.innerHTML = "";

  filmes.forEach(filme => {
    const cardDiv = document.createElement("div");
    cardDiv.className = "col-md-4";

    cardDiv.innerHTML = `
      <div class="card text-light border-0">
        <img src="${IMG_URL}${filme.poster_path}" alt="${filme.title}" class="card-img-top img-fluid" style="object-fit: cover; height: 250px;">
        <div class="card-body bg-main">
          <h5 class="card-title">${filme.title}</h5>
          <p class="card-text">${filme.overview.substring(0, 80)}...</p>
          <button class="neon-btn">Assistir</button>
        </div>
      </div>
    `;

    cardsContainer.appendChild(cardDiv);
  });
}
