<?php
session_start();
require_once '../includes/fazercadastro.php'; // Incluir a classe User para login

$error = "";

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Conecta ao banco de dados
    $db = new DB();
    $user = new User($db->getConnection());

    $user->email = $email;
    $user->senha = $senha;

    $loggedUser = $user->login();
    if ($loggedUser) {
        // Salva corretamente a sessão com id_usuario
        $_SESSION['id_usuario'] = $loggedUser['id_usuario'];
        $_SESSION['usuario_nome'] = $loggedUser['nome'];
        header('Location: home.php');
        exit();
    } else {
        $error = "Credenciais inválidas!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../estilo/form.css">
    <link rel="stylesheet" href="../estilo/style.css">
    <link rel="shortcut icon" href="../Icons/login.png" type="image/x-icon">
</head>

<body>
    <div style="height:80px;">
        <a href="../pages/home.php" class="ms-5">
            <img src="../img/logo2.png" alt="" style="height:150px;">
        </a>
    </div>

    <div class="container">
        <div class="right">
            <div class="glass">
                <h2>Faça Login</h2>
                <form method="POST" action="login.php">
                    <div class="input-box">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="text" name="email" placeholder="E-mail" required>
                    </div>

                    <div class="input-box">
                        <i class="fa fa-lock"></i>
                        <input type="password" name="senha" placeholder="Senha" id="password" required>
                        <span class="toggle-password fa-solid fa-eye-slash"></span>
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="neon-btn fw-bold">Entrar</button>
                    </div>
                </form>

                <?php if (!empty($error)) { ?>
                    <p style='color: red; text-align: center;'><?= $error ?></p>
                <?php } ?>

                <!-- Botão de cadastro -->
                <div class="d-flex justify-content-center mt-3">
                    <a href="cadastro.php" class="neon-btn fw-bold">Criar conta</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const togglePassword = document.querySelector('.toggle-password');
            const password = document.querySelector('#password');

            togglePassword.addEventListener('click', function () {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
