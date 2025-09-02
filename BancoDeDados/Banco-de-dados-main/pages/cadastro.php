<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../estilo/form.css">
    <link rel="stylesheet" href="../estilo/style.css">
</head>

<!-- Conteudo princiapl -->

<body>
    <!-- FORMULÁRIO DE CADASTRO -->
    <div style="height:80px;">
        <a href="/pages/home.php" class="ms-5">
            <img src="../img/logo2.png" alt="" style="height:150px;">
        </a>
    </div>

    <div class="container">
        <div class="right">
            <div class="glass">
                <h2 class="fw-bold mb-3">Crie sua conta</h2>
                <form action="salvar_cadastro.php" method="POST">
                    <div class="input-box">
                        <i class="fa-solid fa-font"></i>
                        <input type="text" name="nome" placeholder="Nome" required>
                    </div>

                    <div class="input-box">
                        <i class="fa fa-lock"></i>
                        <input type="password" name="senha" placeholder="Senha" id="password" required>
                        <span class="toggle-password fa-solid fa-eye-slash"></span>
                    </div>

                    <div class="input-box">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" name="email" placeholder="E-mail" required>
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="neon-btn fw-bold mt-2">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const togglePassword = document.querySelector('.toggle-password');
            const password = document.querySelector('#password');

            togglePassword.addEventListener('click', function () {
                // Alterna o tipo do input entre 'password' e 'text'
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);

                // Alterna a classe do ícone para mudar entre olho aberto e fechado
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
</body>

</html>