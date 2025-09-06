const API_KEY = "d2b2038bd7bc5db74623478537729164";
const BASE_URL = "https://api.themoviedb.org/3";
const IMG_URL = "https://image.tmdb.org/t/p/w780";

// Carregar filmes populares ao abrir a home
document.addEventListener("DOMContentLoaded", () => {
  carregarFilmesPopulares();
});

function carregarFilmesPopulares() {
  fetch(`${BASE_URL}/movie/popular?api_key=${API_KEY}&language=pt-BR&page=1`)
    .then((res) => res.json())
    .then((data) => {
      preencherCarrossel(data.results.slice(0, 5)); // carrossel principal com 5 filmes
      preencherCards(data.results.slice(0, 6)); // cards abaixo do carrossel com 6 filmes
    })
    .catch((err) => console.error("Erro ao carregar filmes:", err));
}

function preencherCarrossel(filmes) {
  const carouselInner = document.querySelector(
    "#carouselExampleFade .carousel-inner"
  );
  carouselInner.innerHTML = "";

  filmes.forEach((filme, index) => {
    const item = document.createElement("div");
    item.className = `carousel-item ${index === 0 ? "active" : ""}`;

    // Imagem menor e com altura fixa
    item.innerHTML = `
      <div style="position: relative; height: 500px; overflow: hidden; border-radius: 10px;">
        <img src="${IMG_URL}${filme.backdrop_path}" 
             class="d-block w-100 img-fluid" 
             alt="${filme.title}" 
             style="object-fit: fill; width: 100%; height: 100%;">
        <div style="
          position: absolute;
          bottom: 0;
          width: 100%;
          background: rgba(0, 0, 0, 0.6);
          color: #fff;
          text-align: center;
          padding: 10px 0;
          font-size: 1.5rem;
          leter-spacing:1px;
          font-weight: bold;
        ">
          ${filme.title}
        </div>
      </div>
    `;

    carouselInner.appendChild(item);
  });
}


function preencherCards(filmes) {
  const cardsContainer = document.querySelector(
    ".container .row .col-12 .row.g-3"
  );
  cardsContainer.innerHTML = "";

  filmes.forEach((filme) => {
    const cardDiv = document.createElement("div");
    cardDiv.className = "col-md-4";

    cardDiv.innerHTML = `
  <div style="display: flex; justify-content: center; width: 100%; margin-top:10px;">
    <div class="card text-light border-0 h-100" style="width: 18rem; display: flex; flex-direction: column;">
      <img src="${IMG_URL}${filme.poster_path}" alt="${filme.title}" 
           class="card-img-top img-fluid" 
           style="object-fit: fill; height: 250px;">
      <div class="card-body bg-main d-flex flex-column" style="flex: 1; display: flex; flex-direction: column; justify-content: space-between;">
        <h5 class="card-title" style="min-height: 3em;">${filme.title}</h5>
        
        <div class="my-4">
          <i class="fa-solid fa-star text-warning"></i> 
          <span>${filme.vote_average.toFixed(1)}</span>
          <i class="fa-regular fa-star text-light rate-movie mx-2" 
             style="cursor: pointer;" 
             data-id="${filme.id}"></i>
        </div>

        <button class="neon-btn mt-auto">Ver Mais</button>
      </div>
    </div>
  </div>
`;

    cardsContainer.appendChild(cardDiv);
  });
}
