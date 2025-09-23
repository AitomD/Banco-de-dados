<?php
require_once '../includes/db.php';  // Conexão com o banco

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
        // Verifica se o email já existe
        $check = $this->conn->prepare("SELECT id_usuario FROM usuario WHERE email = :email LIMIT 1");
        $check->bindParam(':email', $this->email);
        $check->execute();

        if ($check->rowCount() > 0) {
            return false; // Email já cadastrado
        }

        // Insere o usuário
        $stmt = $this->conn->prepare(
            "INSERT INTO usuario (nome, email, senha) VALUES (:nome, :email, :senha)"
        );
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':senha', password_hash($this->senha, PASSWORD_BCRYPT));

        if ($stmt->execute()) {
            // Pega o ID do usuário cadastrado
            $userId = $this->conn->lastInsertId();

            // Inicia sessão se ainda não estiver iniciada
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            // Define variáveis de sessão para manter logado
            $_SESSION['id_usuario'] = $userId;
            $_SESSION['nome_usuario'] = $this->nome;

            return true;
        }

        return false;
    }

    // Login do usuário
    public function login() {
        $stmt = $this->conn->prepare(
            "SELECT id_usuario, nome, senha FROM usuario WHERE email = :email LIMIT 1"
        );
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($this->senha, $user['senha'])) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['id_usuario'] = $user['id_usuario'];
                $_SESSION['nome_usuario'] = $user['nome'];
                return true;
            }
        }

        return false;
    }
}
?>
