<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../estilo/form.css">
    <link rel="stylesheet" href="../estilo/style.css">
  </head>

<body>

<div class="container">
    <div class="right">
        <div class="glass">
            <h2>Faça Login</h2>
            <div class="input-box">
                <i class="fa-solid fa-envelope"></i>
                <input type="text" placeholder="E-mail">
            </div>
            <div class="input-box">
                    <i class="fa fa-lock"></i>
                    <input type="password" placeholder="Senha" id="password">
                    <span class="toggle-password fa-solid fa-eye-slash"></span>
                </div>
            <div class="d-flex justify-content-center">
                <button class="neon-btn fw-bold ">Entrar</button>
            </div>
        </div>
    </div>
</div>

<script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.querySelector('.toggle-password');
            const password = document.querySelector('#password');

            togglePassword.addEventListener('click', function() {
                // Alterna o tipo do input entre 'password' e 'text'
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);

                // Alterna a classe do ícone para mudar entre olho aberto e fechado
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        });
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>