<?php
// 1. Inicia a sessão para poder armazenar os dados do usuário.
session_start();

// 2. Inclui o arquivo de conexão PDO. Certifique-se de que este arquivo
//    cria a variável $pdo com a conexão.
require_once '../includes/db.php';
require_once '../includes/db_procedural.php';

// 3. Recebe os dados do formulário de forma segura.
$nome = $_POST['nome'] ?? '';
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$senha_plain = $_POST['senha'] ?? '';

// 4. Valida se os campos obrigatórios foram preenchidos.
if (empty($nome) || empty($email) || empty($senha_plain)) {
    die("Erro: Todos os campos são obrigatórios.");
}

try {
    // 5. Verifica se o e-mail já está cadastrado.
    $sql_check = "SELECT id_usuario FROM usuario WHERE email = :email";
    $stmt_check = $pdo->prepare($sql_check);
    $stmt_check->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt_check->execute();
    
    if ($stmt_check->rowCount() > 0) {
        die("Erro: Este e-mail já está em uso.");
    }

    // 6. Criptografa a senha para armazenamento seguro.
    $senha_hash = password_hash($senha_plain, PASSWORD_DEFAULT);

    // 7. Prepara e executa a query de inserção.
    $sql_insert = "INSERT INTO usuario (nome, email, senha) VALUES (:nome, :email, :senha)";
    $stmt_insert = $pdo->prepare($sql_insert);
    
    // Vincula os parâmetros à query.
    $stmt_insert->bindParam(':nome', $nome, PDO::PARAM_STR);
    $stmt_insert->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt_insert->bindParam(':senha', $senha_hash, PDO::PARAM_STR);
    
    // Executa a inserção no banco de dados.
    if ($stmt_insert->execute()) {
        // 8. Se a inserção foi um sucesso, obtém o ID do novo usuário e o armazena na sessão.
        $_SESSION['id_usuario'] = $pdo->lastInsertId();
        $_SESSION['nome_usuario'] = $nome;
        
        // 9. Redireciona o usuário para a página inicial.
        header("Location: ../index.php");
        exit;
    } else {
        die("Erro ao cadastrar: Não foi possível executar a operação.");
    }

} catch(PDOException $e) {
    // Lida com erros do banco de dados de forma segura.
    die("Erro no banco de dados: " . $e->getMessage());
}
?>