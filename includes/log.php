<?php
require_once 'db.php'; // Incluir a classe DB para usar a conexão com o banco

class User {
    private $conn;

    public $nome;
    public $email;
    public $senha;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Cadastro do usuário e login automático
    public function register() {
        $query = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':senha', password_hash($this->senha, PASSWORD_BCRYPT));

        if ($stmt->execute()) {
            // Pega o ID do usuário recém-criado
            $userId = $this->conn->lastInsertId();

            // Inicia a sessão se ainda não estiver iniciada
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            // Define as variáveis de sessão
            $_SESSION['id_usuario'] = $userId;
            $_SESSION['nome_usuario'] = $this->nome;

            return true; // Cadastro e login automático bem-sucedidos
        }

        return false; // Falha no cadastro
    }

    // Login do usuário e criação da sessão
    public function login() {
        $query = "SELECT id, nome, senha FROM usuarios WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($this->senha, $user['senha'])) {
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }

                $_SESSION['id_usuario'] = $user['id'];
                $_SESSION['nome_usuario'] = $user['nome'];

                return true;
            }
        }

        return false;
    }
}
?>
