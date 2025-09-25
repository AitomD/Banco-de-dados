
  // Lê parâmetros da URL
(() => {


  const qs       = new URLSearchParams(location.search);
  const mediaId  = qs.get('id');
  const mediaType= qs.get('type') || 'movie';
  if (!mediaId) return;

  // Estados/elementos
  let notaSelecionada = 0; // avaliarcard.js pode atualizar via window.setNota
  const elLista = document.getElementById('lista-comentarios');
  const elEnviar = document.getElementById('enviar');
  const elComentario = document.getElementById('comentario');

  // Exponho setters opcionalmente (se quiser que outro arquivo mude a nota)
  window.setNota = (n) => { notaSelecionada = Number(n) || 0; };

  function carregarComentarios() {
    if (!elLista) return;
    fetch(`../pages/buscar_avaliacoes.php?id_filmeserie=${encodeURIComponent(mediaId)}`)
      .then(r => r.text())
      .then(html => { elLista.innerHTML = html; })
      .catch(console.error);
  }

  function atualizarEstrelas(n = notaSelecionada) {
    const stars = document.querySelectorAll('.estrela'); // ajuste o seletor conforme seu HTML
    stars.forEach((s, i) => s.classList.toggle('active', i < n));
  }

  if (elEnviar) {
    elEnviar.addEventListener('click', () => {
      const comentario = (elComentario?.value || '').trim();
      if (!notaSelecionada || !comentario) {
        alert('Escolha uma nota e escreva um comentário!');
        return;
      }
      fetch('../pages/salvar_avaliacao.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `id_filmeserie=${encodeURIComponent(mediaId)}&type=${encodeURIComponent(mediaType)}&nota=${encodeURIComponent(notaSelecionada)}&comentario=${encodeURIComponent(comentario)}`
      })
      .then(r => r.text())
      .then(txt => {
        if (txt.includes('logado')) {
          alert('Você precisa estar logado para avaliar!');
          location.href = 'pages/login.php';
          return;
        }
        if (elComentario) elComentario.value = '';
        notaSelecionada = 0;
        atualizarEstrelas(0);
        carregarComentarios();
      })
      .catch(console.error);
    });
  }

  document.addEventListener('DOMContentLoaded', () => {
    if (typeof carregarFilmeSerie === 'function') carregarFilmeSerie();
    carregarComentarios();
    if (typeof verificarFavorito === 'function') verificarFavorito();
  });
})();
