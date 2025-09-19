document.addEventListener("DOMContentLoaded", () => {
  const container = document.getElementById("favoritosContainer");
  const favoritos = JSON.parse(localStorage.getItem("favoritos")) || [];

  if (favoritos.length === 0) {
    container.innerHTML = `<p class="text-center text-muted" style="color:white;">Nenhum filme favoritado ainda.</p>`;
    return;
  }

  favoritos.forEach((filme) => {
    container.innerHTML += `
  <div class="col">
    <div class="card h-100 shadow-lg border-0 text-light">
      <img src="${filme.poster}" class="card-img-top" alt="${filme.titulo}">
      <div class="card-body d-flex flex-column">
        <!-- Título com ellipsis -->
        <h5 class="card-title movie-title">${filme.titulo}</h5>

        <!-- Sinopse branca com estilo moderno -->
        <p class="card-text movie-synopsis">
          ${filme.sinopse.substring(0, 100)}...
        </p>

        <!-- Botões -->
        <div class="mt-auto d-flex justify-content-between">
          <a href="avaliar.php?id=${filme.id}&type=${filme.type}" 
             class="btn btn-primary btn-sm rounded-pill">
            Ver detalhes
          </a>
          <button class="btn btn-danger btn-sm rounded-pill btn-remover" 
                  data-id="${filme.id}" data-type="${filme.type}">
            Remover
          </button>
        </div>
      </div>
    </div>
  </div>
`;
  });

  // Função de remover favorito
  document.querySelectorAll(".btn-remover").forEach((botao) => {
    botao.addEventListener("click", () => {
      const id = botao.getAttribute("data-id");
      const type = botao.getAttribute("data-type");

      let novosFavoritos = favoritos.filter(
        (f) => !(f.id == id && f.type == type)
      );
      localStorage.setItem("favoritos", JSON.stringify(novosFavoritos));
      location.reload(); // Recarrega a página para atualizar
    });
  });
});
