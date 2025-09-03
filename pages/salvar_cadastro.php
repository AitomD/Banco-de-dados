<?php
// 1. Conexão com o banco de dados
$host = 'localhost';
$usuario = 'root'; // ou outro usuário do MySQL
$senha = '';       // sua senha do MySQL
$banco = 'cadastro-login'; // substitua pelo nome real do seu banco

$conn = new mysqli($host, $usuario, $senha, $banco);

// Verifica conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// 2. Receber os dados do formulário via POST
$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$senha_plain = $_POST['senha'] ?? '';

// 3. Validar os campos (simples)
if (empty($nome) || empty($email) || empty($senha_plain)) {
    die("Todos os campos são obrigatórios.");
}

// 4. Criptografar a senha
$senha_hash = password_hash($senha_plain, PASSWORD_DEFAULT);

// 5. Preparar e executar o INSERT
$sql = "INSERT INTO usuario (nome, email, senha) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Erro ao preparar statement: " . $conn->error);
}

$stmt->bind_param("sss", $nome, $email, $senha_hash);

if ($stmt->execute()) {
    // Redirecionar ou mostrar mensagem
    echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href='home.php';</script>";
} else {
    echo "Erro ao cadastrar: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>