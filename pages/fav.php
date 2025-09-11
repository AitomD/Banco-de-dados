<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Meus Favoritos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../estilo/style.css">
  <link rel="stylesheet" href="../estilo/form.css">
</head>
<body>

    <?php include 'navbar.php'; ?>

    
  <div class="container py-4">
    <h1 class="text-center mb-4">🎬 Meus Favoritos</h1>

    <div id="favoritosContainer" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
      <!-- Filmes favoritos vão aparecer aqui -->
    </div>
  </div>

  <?php include 'footer.php'; ?>

  <script src="../js/favoritos.js"></script>
</body>
</html>
