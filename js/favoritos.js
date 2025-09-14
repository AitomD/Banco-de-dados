document.addEventListener("DOMContentLoaded", () => {
  const container = document.getElementById("favoritosContainer");
  const favoritos = JSON.parse(localStorage.getItem("favoritos")) || [];

  if (favoritos.length === 0) {
    container.innerHTML = `<p class="text-center text-muted">Nenhum filme favoritado ainda.</p>`;
    return;
  }

  favoritos.forEach(filme => {
    container.innerHTML += `
      <div class="col">
        <div class="card h-100 shadow bg-dark text-light">
          <img src="${filme.poster}" class="card-img-top" alt="${filme.titulo}">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">${filme.titulo}</h5>
            <p class="card-text small text-muted">${filme.sinopse.substring(0, 100)}...</p>
            <div class="mt-auto d-flex justify-content-between">
              <a href="avaliar.php?id=${filme.id}&type=${filme.type}" class="btn btn-primary btn-sm">Ver detalhes</a>
              <button class="btn btn-danger btn-sm btn-remover" data-id="${filme.id}" data-type="${filme.type}">
                ❌ Remover
              </button>
            </div>
          </div>
        </div>
      </div>
    `;
  });

  // Função de remover favorito
  document.querySelectorAll(".btn-remover").forEach(botao => {
    botao.addEventListener("click", () => {
      const id = botao.getAttribute("data-id");
      const type = botao.getAttribute("data-type");

      let novosFavoritos = favoritos.filter(f => !(f.id == id && f.type == type));
      localStorage.setItem("favoritos", JSON.stringify(novosFavoritos));
      location.reload(); // Recarrega a página para atualizar
    });
  });
});
