<?php
require_once '../includes/db.php';  // Inclui o arquivo que contém a classe DB para conexão com o banco

class User {
    private $conn;
    
    public $nome;
    public $email;
    public $senha;

    // Construtor da classe que recebe a conexão do banco de dados
    public function __construct($db) {
        $this->conn = $db;
    }

    // Cadastro do usuário
    public function register() {
        $query = "INSERT INTO usuario (nome, email, senha) VALUES (:nome, :email, :senha)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':senha', password_hash($this->senha, PASSWORD_BCRYPT));
        return $stmt->execute();
    }

    // Login do usuário
    public function login() {
        $query = "SELECT id_usuario, nome, senha FROM usuario WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();
    
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($this->senha, $user['senha'])) {
                return $user;  // Contém 'id', 'nome', e 'senha'
            }
        }
    
        return false;
    }
}
?>
