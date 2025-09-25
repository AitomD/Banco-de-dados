(() => {
  const TMDB_API_KEY = "d2b2038bd7bc5db74623478537729164";
  const TMDB_BASE    = "https://api.themoviedb.org/3";
  const IMG_URL      = "https://image.tmdb.org/t/p/w780";

  document.addEventListener("DOMContentLoaded", () => {
    carregarFilmesPopulares();
  });

  function carregarFilmesPopulares() {
    fetch(`${TMDB_BASE}/movie/popular?api_key=${TMDB_API_KEY}&language=pt-BR&page=1`)
      .then(r => r.json())
      .then(data => {
        if (!data || !Array.isArray(data.results)) return;
        preencherCarrossel(data.results.slice(0, 5));
        preencherCards(data.results.slice(0, 9));
      })
      .catch(err => console.error("Erro ao carregar filmes:", err));
  }

  function preencherCarrossel(filmes) {
    const carouselInner = document.querySelector("#carouselExampleFade .carousel-inner");
    if (!carouselInner) return;
    carouselInner.innerHTML = "";
    filmes.forEach((f, i) => {
      const item = document.createElement("div");
      item.className = `carousel-item ${i === 0 ? "active" : ""}`;
      item.innerHTML = `
        <div style="position: relative; height: 500px; overflow: hidden; border-radius: 10px;">
          <img src="${IMG_URL}${f.backdrop_path}" class="d-block w-100 img-fluid" alt="${f.title}"
               style="object-fit: fill; width:100%; height:100%;">
          <div style="position:absolute; bottom:0; width:100%; background:rgba(0,0,0,.6); color:#fff; text-align:center; padding:10px 0; font-size:1.5rem; font-weight:bold;">
            ${f.title}
          </div>
        </div>`;
      carouselInner.appendChild(item);
    });
  }

  function preencherCards(filmes) {
    const cardsContainer = document.querySelector(".container .row.g-3");
    if (!cardsContainer) return;
    cardsContainer.innerHTML = "";
    filmes.forEach(f => {
      const el = document.createElement("div");
      el.className = "col-md-4";
      el.innerHTML = `
        <div style="display:flex; justify-content:center; width:100%; margin-top:10px;">
          <div class="card text-light border-0 h-100" style="width:18rem; display:flex; flex-direction:column;">
            <img src="${IMG_URL}${f.poster_path}" alt="${f.title}" class="card-img-top img-fluid" style="object-fit:fill; height:250px;">
            <div class="card-body bg-main d-flex flex-column" style="flex:1;">
              <h5 class="card-title" style="min-height:3em;">${f.title}</h5>
              <div class="my-4"><i class="fa-solid fa-star text-warning"></i> <span>${Number(f.vote_average||0).toFixed(1)}</span></div>
              <button class="neon-btn mt-auto">Avaliar</button>
            </div>
          </div>
        </div>`;
      el.querySelector("button").onclick = () => location.href = `avaliar?id=${f.id}&type=movie`;
      cardsContainer.appendChild(el);
    });
    const verMais = document.createElement("div");
    verMais.className = "col-12 text-center mt-4";
    verMais.innerHTML = `<a class="a-btn my-5" href="filmes">Ver Todos os Filmes</a>`;
    cardsContainer.appendChild(verMais);
  }
})();
