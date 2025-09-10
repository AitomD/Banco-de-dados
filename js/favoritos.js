// Lista fake de filmes favoritos
let favoritos = [
  { id: 1, titulo: "Clube da Luta", poster: "/a26cQPRhJPX6GbWfQbvZdrrp9j9.jpg" },
  { id: 2, titulo: "Batman Begins", poster: "/b1L7qevxiVpkVFq4dmdQfJGwXau.jpg" },
  { id: 3, titulo: "Vingadores", poster: "/RYMX2wcKCBAr24UyPD7xwmjaTn.jpg" },
  { id: 4, titulo: "Interestelar", poster: "/gEU2QniE6E77NI6lCU6MxlNBvIx.jpg" }
];

// Renderizar favoritos
function mostrarFavoritos() {
  const container = document.getElementById("favoritosContainer");
  container.innerHTML = "";

  if (favoritos.length === 0) {
    container.innerHTML = `<p class="text-center">Você ainda não favoritou nenhum filme.</p>`;
    return;
  }

  favoritos.forEach(filme => {
    container.innerHTML += `
      <div class="col">
        <div class="card bg-secondary text-light h-100 shadow border-0">
          <img src="https://image.tmdb.org/t/p/w500${filme.poster}" class="card-img-top" alt="${filme.titulo}">
          <div class="card-body d-flex flex-column justify-content-between">
            <h6 class="card-title text-center">${filme.titulo}</h6>
          </div>
          <div class="card-footer bg-dark text-center border-0">
            <button class="btn btn-danger btn-sm w-100" onclick="removerFavorito(${filme.id})">
              ❌ Remover dos Favoritos
            </button>
          </div>
        </div>
      </div>
    `;
  });
}

// Função para remover um favorito
function removerFavorito(id) {
  favoritos = favoritos.filter(f => f.id !== id);
  mostrarFavoritos();
}

// Chama ao carregar
document.addEventListener("DOMContentLoaded", mostrarFavoritos);
