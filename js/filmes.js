(() => {
  const TMDB_API_KEY = "d2b2038bd7bc5db74623478537729164";
  const TMDB_BASE    = "https://api.themoviedb.org/3";
  const IMG_URL      = "https://image.tmdb.org/t/p/w500";
  const seriesExibidas = new Set();

  document.addEventListener("DOMContentLoaded", () => {
    if (!document.querySelector("#series-acao, #series-comedia, #series-drama, #series-animacao")) return;
    carregarSeriesPorGenero(10759, "#series-acao");
    carregarSeriesPorGenero(35,    "#series-comedia");
    carregarSeriesPorGenero(18,    "#series-drama");
    carregarSeriesPorGenero(16,    "#series-animacao");
  });

  async function carregarSeriesPorGenero(generoId, sel) {
    const container = document.querySelector(sel);
    if (!container) return;

    const unicas = [];
    let page = 1;

    while (unicas.length < 16 && page <= 5) {
      try {
        const r = await fetch(`${TMDB_BASE}/discover/tv?api_key=${TMDB_API_KEY}&language=pt-BR&with_genres=${generoId}&sort_by=popularity.desc&page=${page}`);
        if (!r.ok) break;
        const data = await r.json();
        if (!data || !Array.isArray(data.results)) break;

        for (const s of data.results) {
          if (!seriesExibidas.has(s.id) && unicas.length < 16) {
            seriesExibidas.add(s.id);
            unicas.push(s);
          }
        }
        page++;
      } catch (e) {
        console.error("Erro ao carregar séries:", e);
        break;
      }
    }
    preencherCardsSeries(unicas, container);
  }

  function preencherCardsSeries(series, container) {
    if (!container) return;
    container.innerHTML = "";
    series.forEach(s => {
      const col = document.createElement("div");
      col.className = "col";
      col.innerHTML = `
        <div class="card h-100 bg-main text-light border-0">
          <img src="${s.poster_path ? IMG_URL + s.poster_path : "https://via.placeholder.com/300x400"}" class="card-img-top" alt="${s.name}">
          <div class="card-body d-flex flex-column">
            <span class="badge bg-warning mb-2">Série</span>
            <h5 class="card-title">${s.name}</h5>
            <p class="card-text">${s.overview ? s.overview.substring(0,100)+"..." : "Sem descrição disponível."}</p>
            <div class="mt-auto"><i class="fa-solid fa-star text-warning"></i> ${Number(s.vote_average||0).toFixed(1)}</div>
            <button class="neon-btn avaliar-btn mt-2">Avaliar</button>
          </div>
        </div>`;
      const btn = col.querySelector(".avaliar-btn");
      if (btn) btn.addEventListener("click", () => location.href = `avaliar?id=${s.id}&type=tv`);
      container.appendChild(col);
    });
  }
})();
