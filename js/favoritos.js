document.addEventListener("DOMContentLoaded", () => {
  const container = document.getElementById("favoritosContainer");

  // Função para carregar favoritos do banco
  async function carregarFavoritos() {
    try {
      const res = await fetch('includes/favoritar.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'get_favoritos=1' // parâmetro fictício para apenas buscar favoritos
      });
      const data = await res.json();

      container.innerHTML = ''; // limpa container

      if (!data.favoritos || data.favoritos.length === 0) {
        container.innerHTML = `<p class="text-center text-muted" style="color:white;">Nenhum filme favoritado ainda.</p>`;
        return;
      }

      data.favoritos.forEach((fs_api_id) => {
        // Aqui você pode buscar informações do filme via API TMDB
        // Supondo que você tenha uma função fetchFilme(fs_api_id)
        fetchFilme(fs_api_id).then(filme => {
          container.innerHTML += `
            <div class="col">
              <div class="card h-100 shadow-lg border-0 text-light">
                <img src="${filme.poster}" class="card-img-top" alt="${filme.titulo}">
                <div class="card-body d-flex flex-column">
                  <h5 class="card-title movie-title">${filme.titulo}</h5>
                  <p class="card-text movie-synopsis">${filme.sinopse.substring(0, 100)}...</p>
                  <div class="mt-auto d-flex justify-content-between">
                    <a href="avaliar?id=${filme.id}&type=${filme.type}" class="btn btn-primary btn-sm">Ver detalhes</a>
                    <button class="btn btn-danger btn-sm btn-remover" data-id="${filme.id}">Remover</button>
                  </div>
                </div>
              </div>
            </div>
          `;

          // Evento para remover
          container.querySelectorAll(".btn-remover").forEach(btn => {
            btn.addEventListener("click", async () => {
              await fetch('includes/favoritar.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: `fs_api_id=${btn.dataset.id}`
              });
              carregarFavoritos(); // recarrega após remover
            });
          });

        });
      });

    } catch (err) {
      console.error(err);
      container.innerHTML = `<p class="text-center text-muted" style="color:white;">Erro ao carregar favoritos.</p>`;
    }
  }

  // Função fictícia para buscar detalhes do filme via API
  async function fetchFilme(id) {
    const API_KEY = "d2b2038bd7bc5db74623478537729164";
    const res = await fetch(`https://api.themoviedb.org/3/movie/${id}?api_key=${API_KEY}&language=pt-BR`);
    const data = await res.json();
    return {
      id: data.id,
      titulo: data.title,
      sinopse: data.overview,
      poster: data.poster_path ? `https://image.tmdb.org/t/p/w500${data.poster_path}` : 'https://via.placeholder.com/250x375',
      type: 'movie'
    };
  }

  // Carrega os favoritos ao abrir a página
  carregarFavoritos();
});
