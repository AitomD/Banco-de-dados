<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliar Filme</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../estilo/style.css">
    <link rel="stylesheet" href="../estilo/form.css">
    <style>
        .avaliar-container {
            display: flex;
            gap: 30px;
            color: white;
            border-radius: 10px;
            padding: 40px;
            max-width: 1000px;
            background-color: #021526;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
            margin-left: auto;
            margin-right: auto;
        }

        /* Imagem do poster */
        .poster {
            width: 150px;
            height: auto;
            border-radius: 5px;
        }

        /* Informações do filme (título, sinopse, estrelas) */
        .info {
            flex: 1;
        }

        /* Estrelas de avaliação */
        .estrela {
            font-size: 40px;
            cursor: pointer;
            color: #123155ff;
            transition: color 0.2s;
        }

        .estrela:hover {
            color: gold;
        }

        .estrela.selecionada {
            color: gold;
        }

        /* Textarea para comentário */
        textarea {
            width: 100%;
            resize: vertical;
            margin-top: 40px;
            padding: 10px;
            border-radius: 5px;
            border: none;
            outline: none;
            font-family: 'Fredoka', sans-serif;
        }
    </style>
</head>

<body>

    <?php include 'navbar.php'; ?>

    <div class="alto" style="height: 189px;"></div>

    <div class="avaliar-container">
        <img class="poster" src="https://via.placeholder.com/150x225" alt="Capa do filme">
        <div class="info">
            <h3 id="titulo-filme">Título do Filme</h3>
            <p id="sinopse">Breve sinopse do filme vai aqui. Resuma em 2-3 linhas.</p>

            <div id="estrelas" class="mb-2">
                <!-- 10 estrelas -->
                <?php for ($i = 1; $i <= 10; $i++): ?>
                    <span class="estrela" data-valor="<?= $i ?>">&#9733;</span>
                <?php endfor; ?>
            </div>

            <textarea id="comentario" rows="4" placeholder="Deixe seu comentário..."></textarea>
            <button class="btn btn-primary mt-2" id="enviar">Enviar Avaliação</button>
        </div>
    </div>

    <div class="alto" style="height: 189px;"></div>

    <?php include 'footer.php'; ?>

    <script>
        // === Preencher filme ou série automaticamente ===
        const API_KEY = "d2b2038bd7bc5db74623478537729164";
        const IMG_URL = "https://image.tmdb.org/t/p/w500";

        const urlParams = new URLSearchParams(window.location.search);
        const id = urlParams.get('id');
        const type = urlParams.get('type') || 'movie'; // 'movie' ou 'tv'

        async function carregarFilmeSerie() {
            if (!id) return;

            try {
                const res = await fetch(`https://api.themoviedb.org/3/${type}/${id}?api_key=${API_KEY}&language=pt-BR`);
                const data = await res.json();

                document.querySelector('.poster').src = data.poster_path ? IMG_URL + data.poster_path : 'https://via.placeholder.com/150x225';
                document.querySelector('.poster').alt = data.title || data.name;
                document.getElementById('titulo-filme').textContent = data.title || data.name;
                document.getElementById('sinopse').textContent = data.overview || 'Sem descrição disponível.';
            } catch (err) {
                console.error('Erro ao carregar detalhes:', err);
            }
        }

        document.addEventListener('DOMContentLoaded', carregarFilmeSerie);

        // === Avaliação por estrelas ===
        const estrelas = document.querySelectorAll('.estrela');
        let notaSelecionada = 0;

        estrelas.forEach(estrela => {
            estrela.addEventListener('click', () => {
                notaSelecionada = parseInt(estrela.dataset.valor);
                atualizarEstrelas();
            });
        });

        function atualizarEstrelas() {
            estrelas.forEach(estrela => {
                if (parseInt(estrela.dataset.valor) <= notaSelecionada) {
                    estrela.classList.add('selecionada');
                } else {
                    estrela.classList.remove('selecionada');
                }
            });
        }

        document.getElementById('enviar').addEventListener('click', () => {
            const comentario = document.getElementById('comentario').value;
            alert(`Avaliação enviada!\nNota: ${notaSelecionada}\nComentário: ${comentario}`);
            // Aqui você pode adicionar código para salvar a avaliação via PHP/DB
        });
    </script>

</body>

</html>
